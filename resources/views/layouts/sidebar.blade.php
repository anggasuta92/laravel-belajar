            <aside class="main-sidebar">
                <section class="sidebar">
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="{{ asset('assets/dist/img/user2-160x160.jpg' ) }}" class="img-circle" alt="User Image">
                        </div>
                        <div class="pull-left info">
                            <p>{{ Auth::user()->name }}</p>
                            <!-- <a href="#"><i class="glyphicon glyphicon-envelope"></i> {{ Auth::user()->email }}</a> -->
                            <a href="#"><i class="digital-clock" id="digital-clock"></i></a>
                        </div>
                    </div>
                    <ul class="sidebar-menu" data-widget="tree">
                        <li class="header">Main Menu</li>
                        <li>
                            <a href="{{ route('home') }}">
                                <i class="glyphicon glyphicon-home"></i> <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="{{ $uri_segment==="lokasi" ? "active" : "" }}">
                            <a href="{{ route('lokasi.index') }}">
                                <i class="glyphicon glyphicon-pushpin"></i> <span>Master Lokasi</span>
                            </a>
                        </li>
                        <!-- <li class="active treeview"> -->
                        <li class="treeview  {{ $menu_master_active ? "active":"" }} ">
                            <a href="#">
                                <i class="glyphicon glyphicon-briefcase"></i> <span>Master Barang</span>
                            </a>
                            <ul class="treeview-menu">
                                <li class="{{ $uri_segment==="kategori" ? "active" : "" }}"><a href="{{ route('kategori.index') }}"><i class="glyphicon glyphicon-minus"></i>Kategori Barang</a></li>
                                <li class="{{ $uri_segment==="satuan" ? "active" : "" }}"><a href="{{ route('satuan.index') }}"><i class="glyphicon glyphicon-minus"></i>Satuan</a></li>
                                <li class="{{ $uri_segment==="brand" ? "active" : "" }}"><a href="{{ route('brand.index') }}"><i class="glyphicon glyphicon-minus"></i>Brand/Merk</a></li>
                                <li class="{{ $uri_segment==="barang" ? "active" : "" }}"><a href="{{ route('barang.index') }}"><i class="glyphicon glyphicon-minus"></i>Barang</a></li>
                            </ul>
                        </li>
                        <li class="{{ $uri_segment==="relasi" ? "active" : "" }}">
                            <a href="{{ route('relasi.index') }}">
                                <i class="fa fa-users"></i> <span>Master Relasi</span>
                            </a>
                        </li>

                        <li class="treeview {{ $menu_transaksi_active ? "active":"" }} ">
                            <a href="#">
                                <i class="glyphicon glyphicon-shopping-cart"></i> <span>Transaksi</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li class="treeview">
                                    <a href="#"><i class="fa fa-circle-o"></i> Pembelian
                                        <span class="pull-right-container">
                                            <i class="fa fa-angle-left pull-right"></i>
                                        </span>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li><a href="{{ route('beli.index') }}"><i class="glyphicon glyphicon-minus"></i>Entry Pembelian</a></li>
                                        <li><a href="{{ route('beli.arsip') }}"><i class="glyphicon glyphicon-minus"></i>Arsip</a></li>
                                    </ul>
                                </li>
                                <li class="treeview">
                                    <a href="#"><i class="fa fa-circle-o"></i> Penjualan
                                        <span class="pull-right-container">
                                            <i class="fa fa-angle-left pull-right"></i>
                                        </span>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li><a href="{{ route('jual.open.sesi') }}"><i class="glyphicon glyphicon-minus"></i>Opening Shift</a></li>
                                        <li><a href="{{ route('jual.index') }}"><i class="glyphicon glyphicon-minus"></i>Penjualan</a></li>
                                        <li><a href="{{ route('beli.index') }}"><i class="glyphicon glyphicon-minus"></i>Closing Shift</a></li>
                                        <li><a href="{{ route('beli.arsip') }}"><i class="glyphicon glyphicon-minus"></i>Arsip</a></li>
                                    </ul>
                                </li>
                                <li class="treeview">
                                    <a href="#"><i class="fa fa-circle-o"></i> Penyesuaian Stock
                                        <span class="pull-right-container">
                                            <i class="fa fa-angle-left pull-right"></i>
                                        </span>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li><a href="{{ route('beli.index') }}"><i class="glyphicon glyphicon-minus"></i>Penyesuaian Stock</a></li>
                                        <li><a href="{{ route('beli.arsip') }}"><i class="glyphicon glyphicon-minus"></i>Arsip</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>

                        <li class="treeview">
                            <a href="#">
                                <i class="glyphicon glyphicon-list-alt"></i> <span>Laporan</span>
                            </a>
                            <ul class="treeview-menu">
                                <li class="treeview">
                                    <a href="#"><i class="fa fa-circle-o"></i>Laporan Pembelian
                                        <span class="pull-right-container">
                                            <i class="fa fa-angle-left pull-right"></i>
                                        </span>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li><a href=""><i class="glyphicon glyphicon-minus"></i>Rekapitulasi Pembelian</a></li>
                                        <li><a href=""><i class="glyphicon glyphicon-minus"></i>Rekapitulasi Pembelian</a></li>
                                    </ul>
                                </li>
                                <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
                            </ul>

                            <ul class="treeview-menu">
                                <li><a href="#"><i class="glyphicon glyphicon-minus"></i>Pembelian</a></li>
                                <li><a href="#"><i class="glyphicon glyphicon-minus"></i>Penjualan - Detail</a></li>
                                <li><a href="#"><i class="glyphicon glyphicon-minus"></i>Penjualan - Rekapitulasi</a></li>
                                <li><a href="#"><i class="glyphicon glyphicon-minus"></i>Penyesuaian</a></li>
                                <li><a href="#"><i class="glyphicon glyphicon-minus"></i>Stok Barang</a></li>
                                <li><a href="#"><i class="glyphicon glyphicon-minus"></i>Mutasi SN / IMEI</a></li>
                            </ul>
                        </li>
                    </ul>
                </section>
            </aside>