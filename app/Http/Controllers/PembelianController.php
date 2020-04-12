<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Relasi;
use App\Lokasi;
use App\Barang;
use App\Pembelian;
use App\PembelianDetail;
use App\SerialNumber;
use App\Stock;
use App\StockDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PembelianController extends Controller
{

    public function arsip(Request $request){
        $q = $request->query('q');
        $pembelians = Pembelian::where('number', 'like', '%' . $q . '%' )
            ->orderBy('trans_date', 'ASC')
            ->paginate(10);
        $pembelians->appends($request->only('q'));
        return view('app.transaksi.pembelian.pembelian-arsip', ['pembelians'=>$pembelians]);
    }

    public function index(Request $request){
        $relations = Relasi::all();
        $locations = Lokasi::all();

        $q = $request->query('pembelian');
        $details = PembelianDetail::where('pembelian_id', $q)->orderBy('created_at', 'ASC')->get();

        $pembelian = new Pembelian();
        if($q!=""){
            $pembelian = Pembelian::find($q);
        }else{
            $pembelian->status = "";
        }

        if($pembelian->id == ""){
            $preffix = 'PB-' . date('mY');
            $counter = Pembelian::where('preffix', $preffix)->max('counter') + 1;
            $number = $preffix ."-". sprintf("%05s", abs($counter));
            $pembelian->number = $number;
        }

        return view('app.transaksi.pembelian.pembelian', ['relations'=>$relations, 'locations'=>$locations, 'details'=>$details, 'pembelian'=>$pembelian]);
    }

    public function save(Request $request){
        $relations = Relasi::all();
        $locations = Lokasi::all();
        $pembelian = new Pembelian();
        $pembelian_detail = new PembelianDetail();
        $request->flash();
        $message = "Data gagal tersimpan";
        $status = "failed";
        $id = $request->input('pembelian_id');
        $type_input = $request->input('type_input');

        if($type_input=="detail"){
            $validator = Validator::make($request->all(), [
                'lokasi_id' => 'required',
                'relasi_id' => 'required',
                'note' => 'required',
                'trans_date' => 'required',
                'barang_id' => 'required',
                'qty' => 'required',
                'price' => 'required',
            ]);

            $attr = array(
                'lokasi_id' => 'Lokasi',
                'relasi_id' => 'Supplier',
                'note' => 'Note',
                'trans_date' => 'Tanggal Pembelian',
                'pembelian_id' => '',
                'barang_id' => 'Barang',
                'qty' => 'Qty',
                'price' => 'Price',   
            );
        }else if($type_input=="main"){
            $validator = Validator::make($request->all(), [
                'lokasi_id' => 'required',
                'relasi_id' => 'required',
                'note' => 'required',
                'trans_date' => 'required',
            ]);

            $attr = array(
                'lokasi_id' => 'Lokasi',
                'relasi_id' => 'Supplier',
                'note' => 'Note',
                'trans_date' => 'Tanggal Pembelian',
            );
        }
        
        $validator->setAttributeNames($attr);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        /* disini save main dulu */
        try{
            DB::beginTransaction();
            if($id != ""){
                /* update datanya */
                $pembelian = Pembelian::find($id);
            }

            /* get request datanya */
            $pembelian->lokasi_id = $request->input('lokasi_id');
            $pembelian->relasi_id = $request->input('relasi_id');
            $pembelian->user_id = auth()->user()->id;
            $pembelian->supplier_inv_number = '';
            $pembelian->supplier_do_number = '';
            $pembelian->note = $request->input('note');
            $pembelian->trans_date = $request->input('trans_date');
            $pembelian->due_date = $request->input('due_date');
            $pembelian->subtotal = 0;
            $pembelian->discount_amount = 0;
            $pembelian->discount_percent = 0;
            $pembelian->tax_amount = 0;
            $pembelian->tax_percent = 0;
            $pembelian->status = $request->input('status');

            if($id != ""){                
                $pembelian->update();
            }else{
                /* generate nomor otomatis */
                $preffix = 'PB-' . date('mY');
                $counter = Pembelian::where('preffix', $preffix)->max('counter') + 1;
                $number = $preffix ."-". sprintf("%05s", abs($counter));
                $pembelian->number = $number;
                $pembelian->counter = $counter;
                $pembelian->preffix = $preffix;
                $pembelian->save();
            }

            /* insert items */
            if($request->input('barang_id')!=""){
                $pembelian_detail->pembelian_id = $pembelian->id;
                $pembelian_detail->barang_id = $request->input('barang_id');
                $pembelian_detail->qty = $request->input('qty');
                $pembelian_detail->price = $request->input('price');
                $pembelian_detail->subtotal = ($pembelian_detail->qty * $pembelian_detail->price);
                $pembelian_detail->discount_amount = 0;
                $pembelian_detail->discount_percent = 0;

                $barang = Barang::find($pembelian_detail->barang_id);
                $pembelian_detail->used_sn = $barang->use_sn;
                $pembelian_detail->save();
            }

            if($pembelian->status == "APPROVED"){
                $lists = PembelianDetail::where('pembelian_id', $pembelian->id)->get();
                foreach($lists as $key => $d){
                    $stock = new Stock();
                    $stock->trans_date = $pembelian->trans_date;
                    $stock->lokasi_id = $pembelian->lokasi_id;
                    $stock->barang_id = $d->barang_id;
                    $stock->type = "pembelian";
                    $stock->ref_main_id = $pembelian->id;
                    $stock->ref_detail_id = $d->id;
                    $stock->qty = $d->qty;
                    $stock->in_out = 1;
                    $stock->save();

                    /* simpan detail stock disini */
                    if($d->used_sn==1){
                        $serial_numbers = SerialNumber::where('ref_id',$d->id)->get();
                        foreach($serial_numbers as $key => $sn){
                            $stock_detail = new StockDetail();
                            $stock_detail->trans_date = $pembelian->trans_date;
                            $stock_detail->lokasi_id = $pembelian->lokasi_id;
                            $stock_detail->barang_id = $d->barang_id;
                            $stock_detail->stock_id = $stock->id;
                            $stock_detail->serial_number = $sn->serial_number;
                            $stock_detail->in_out = 1;
                            $stock_detail->save();
                        }
                    }
                }
            }

            DB::commit();

            $message = "Data berhasil tersimpan";
            $status = "success";

            /* jika item sn maka redirect ke input SN */
            if($request->input('barang_id')!=""){
                if($barang->use_sn==1){
                    return redirect()->route('beli.serialnumber', ['detail'=>$pembelian_detail]);
                }else{
                    return redirect()->route('beli.index', ['pembelian'=>$pembelian]);
                }
            }else{
                return redirect()->route('beli.index', ['pembelian'=>$pembelian]);
            }
        }catch(\Exception $e){
            return $e;
            DB::rollback();
            $message = "Data gagal tersimpan<br/>" . $e->getMessage();
            $status = "failed";
        }
    }

    public function delete_detail(Request $request){
        $detail_id = $request->input('del_item_id');
        $pembelian_id = $request->input('pembelian_id');

        try{
            DB::beginTransaction();
            $pembelian_detail = PembelianDetail::find($detail_id);

            /* delete sn */
            if($pembelian_detail->used_sn==1){
                $sn = SerialNumber::where('ref_id', $pembelian_detail->id)->delete();
            }

            /* delete detail */
            $pembelian_detail->delete();
            DB::commit();

            $message = "Data telah terhapus";
            $status = "success";
        }catch(\Exception $e){
            DB::rollback();
            $message = "Data gagal terhapus<br/>" . $e->getMessage();
            $status = "failed";
        }

        $pembelian = Pembelian::find($pembelian_id);
        return redirect()->route('beli.index', ['pembelian'=>$pembelian])
            ->with('status', $status)
            ->with('msg', $message);
    }

    public function serialnumber(Request $request){
        $q = $request->query('detail');
        $pembelian_detail = PembelianDetail::find($q);
        $count_serial_number = 0;
        $serial_numbers ="";

        if($pembelian_detail->used_sn==1){
            //$count_serial_number = $pembelian_detail->loadCount('serial_number');
            $serial_numbers = SerialNumber::where("ref_id", $pembelian_detail->id)->get();
        }
        return view('app.transaksi.pembelian.pembelian-insert-sn', ['detail'=>$pembelian_detail, 'count'=>$count_serial_number, 'serial_numbers'=>$serial_numbers]);
    }

    public function serialnumbershow($id, Request $request){
        //$q = $request->query('detail');
        $pembelian_detail = PembelianDetail::find($id);
        $count_serial_number = 0;
        $serial_numbers = SerialNumber::where('ref_id', $pembelian_detail->id)->orderBy('created_at', 'ASC')->get();
        return view('app.transaksi.pembelian.pembelian-update-sn', ['detail'=>$pembelian_detail, 'serial_numbers'=>$serial_numbers]);
    }

    public function serialnumberupdate($id, Request $request){
        $pembelian_detail = PembelianDetail::find($id);
        $count_serial_number = 0;
         try{
            DB::beginTransaction();
            $sn = $request->input("serial_number");
            $serial_number = new SerialNumber();
            $serial_number->serial_number = $sn;
            $serial_number->in_out = 1;
            $serial_number->ref_type = 'pembelian';
            $serial_number->ref_id = $pembelian_detail->id;
            $serial_number->save();

            /* update qty di detail */
            $pembelian_detail->qty = SerialNumber::where('ref_id', $pembelian_detail->id)->count();
            $pembelian_detail->update();
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
            $message = "Data gagal tersimpan<br/>" . $e->getMessage();
            $status = "failed";
        }

        return redirect()->route('beli.serialnumber.show', $pembelian_detail->id);
        //return view('app.transaksi.pembelian.pembelian-update-sn', ['detail'=>$pembelian_detail, 'serial_numbers'=>$serial_numbers]);
    }

    public function serialnumberdelete(Request $request){
        $id = $request->input('sn_id');
        $serial_number = SerialNumber::find($id);
        $pembelian_detail = PembelianDetail::find($serial_number->ref_id);

        $count_serial_number = 0;
         try{
            DB::beginTransaction();
            $serial_number->delete();
            /* update qty di detail */
            $pembelian_detail->qty = SerialNumber::where('ref_id', $pembelian_detail->id)->count();
            $pembelian_detail->update();
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
            $message = "Data gagal tersimpan<br/>" . $e->getMessage();
            $status = "failed";
        }

        return redirect()->route('beli.serialnumber.show', $pembelian_detail->id);
        //return view('app.transaksi.pembelian.pembelian-update-sn', ['detail'=>$pembelian_detail, 'serial_numbers'=>$serial_numbers]);
    }

    public function saveserialnumber(Request $request){
        $q = $request->query('detail');
        $pembelian_detail = PembelianDetail::find($q);
        $pembelian = Pembelian::find($pembelian_detail->pembelian_id);
        $message = "";
        $status = "";
        /* save serial number here */
        try{
            DB::beginTransaction();
            for($i = 0; $i<$pembelian_detail->qty; $i++){
                $sn = $request->input("serial_number_" . $i);
                $serial_number = new SerialNumber();
                $serial_number->serial_number = $sn;
                $serial_number->in_out = 1;
                $serial_number->ref_type = 'pembelian';
                $serial_number->ref_id = $pembelian_detail->id;
                $serial_number->save();
            }
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
            $message = "Data gagal tersimpan<br/>" . $e->getMessage();
            $status = "failed";
        }

        return redirect()->route('beli.index', ['pembelian'=>$pembelian]);
    }

    public function detail_serialnumber(Request $request){
        $q = $request->query('id');

        $pembelian_detail = PembelianDetail::find($q);
        $result = "<strong>Item : " . $pembelian_detail->barang->code . "/" . $pembelian_detail->barang->name . "</strong>";

        $serial_number = SerialNumber::where('ref_id', $q)->get();
        $result = $result . "<table class=\"table table-striped\">";
        foreach($serial_number as $key => $sn){
            $result = $result . "<tr><td> " . ($key + 1) . ". " . $sn->serial_number . "</td></tr>";
        }
        $result = $result . "</table>";
        return $result;
    }

    public function search_item(Request $request){
        $q = $request->query('q');
        return Barang::where('name', 'like', '%' . $q . '%' )
            ->orWhere('code', 'like', '%' . $q . '%' )
            ->orWhere('barcode', 'like', '%' . $q . '%' )->get();
    }
}
