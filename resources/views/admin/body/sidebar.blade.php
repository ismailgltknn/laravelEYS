<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <div id="sidebar-menu">
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>
                <li>
                    <a href="{{ route('dashboard')}}" class="waves-effect">
                        <i class="ri-dashboard-line"></i>
                        <span>Anasayfa</span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-hotel-fill"></i>
                        <span>Tedarik Yönetimi</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('supplier.all')}}">Tedarikçiler</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-shield-user-fill"></i>
                        <span>Müşteri Yönetimi</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('customer.all')}}">Müşteriler</a></li>
                        <li><a href="{{ route('credit.customer')}}">Müşteri Kredi</a></li>
                        <li><a href="{{ route('paid.customer')}}">Müşteri Ödeme</a></li>
                        <li><a href="{{ route('customer.wise.report')}}">Kredi / Ödeme Bazlı Rapor</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-delete-back-fill"></i>
                        <span>Birim Yönetimi</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('unit.all')}}">Birimler</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-apps-2-fill"></i>
                        <span>Kategori Yönetimi</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('category.all')}}">Kategoriler</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-file-list-fill"></i>
                        <span>Ürün Yönetimi</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('product.all')}}">Ürünler</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-compass-2-fill"></i>
                        <span>Satın Alma Yönetimi</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('purchase.all')}}">Satın Alma</a></li>
                        <li><a href="{{ route('purchase.pending')}}">Satın Alma Onay</a></li>
                        <li><a href="{{ route('daily.purchase.report')}}">Günlük Satın Alma Raporu</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-article-fill"></i>
                        <span>Fatura Yönetimi</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('invoice.all')}}">Fatura Listesi</a></li>
                        <li><a href="{{ route('invoice.pending.list')}}">Fatura Onay</a></li>
                        <li><a href="{{ route('print.invoice.list')}}">Fatura Listesi Çıktı</a></li>
                        <li><a href="{{ route('daily.invoice.report')}}">Günlük Fatura Raporu</a></li>
                    </ul>
                </li>
                <li class="menu-title">Stok</li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-archive-fill"></i>
                        <span>Stok Yönetimi</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('stock.report')}}">Stok Raporu</a></li>
                        <li><a href="{{ route('stock.supplier.wise')}}">Tedarikçi / Ürün Bazlı Rapor</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-profile-line"></i>
                        <span>Destek</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="#">Coming Soon...</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>