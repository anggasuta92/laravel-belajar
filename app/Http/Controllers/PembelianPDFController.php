<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Relasi;
use App\Lokasi;
use App\Barang;
use App\Pembelian;
use App\PembelianDetail;
use App\SerialNumber;
use Illuminate\Support\Facades\DB;
use PDF;

class PembelianPDFController extends Controller
{
    public function pdf(Request $request){
        $id = $request->query('id');
        $pembelian = Pembelian::find($id);
        $details = PembelianDetail::where('pembelian_id', $pembelian->id)->orderBy('created_at','ASC')->get();

        $pdf = PDF::loadview('app.pdf.pembelian-pdf', ['pembelian'=>$pembelian, 'details'=>$details]);
        $pdf->setPaper('A4', 'potrait');
    	return $pdf->stream('pembelianPDF.pdf');
    }

    public function raw(Request $request){
        $id = $request->query('id');
        $pembelian = Pembelian::find($id);

        // $pdf = PDF::loadview('app.pdf.pembelian-pdf', ['pembelian'=>$pembelian]);
        // return $pdf->stream('pembelianPDF.pdf');
        $details = PembelianDetail::where('pembelian_id', $pembelian->id)->orderBy('created_at','ASC')->get();
        return view('app.pdf.pembelian-pdf', ['pembelian'=>$pembelian, 'details'=>$details]);
    }
}
