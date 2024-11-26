<div class="sidebar" data-color="orange">
    <div class="logo">
        {{-- <a href="http://www.creative-tim.com" class="simple-text logo-mini">CT</a>
        <a href="http://www.creative-tim.com" class="simple-text logo-normal">Creative Tim</a> --}}
        <img src="{{ asset('../assets/img/Logo DLH4.png') }}">
    </div>
    <div class="sidebar-wrapper" id="sidebar-wrapper">
        <ul class="nav">
            <li>
                <a href="/">
                    <i class="now-ui-icons design_app"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li>
                <a href="javascript:void(0)" onclick="toggleSubmenu('airSubmenu')">
                    <i class="now-ui-icons ui-1_bell-53"></i>
                    <p>Data Kualitas Air</p>
                </a>
                <ul id="airSubmenu" style="display: none; padding-left: 20px;">
                    <li><a class="submenu-sidebar" href="/uji_air_internal" :active="request()->is('airInternal')"><p>Data Uji Internal Baru</p></a></li>
                    <li><a class="submenu-sidebar" href="/arsip_uji_air" :active="request()->is('arsipAirInternal')"><p>Arsip Uji Air Internal</p></a></li>
                    <li><a class="submenu-sidebar" href="/uji_air_eksternal" :active="request()->is('airEksternal')"><p>Data Uji Eksternal</p></a></li>
                    {{-- <li><a class="submenu-sidebar"
                         href="/data_partikulat" :active="request()->is('dataPartikulats')"><p>Data Partikulat Mobile</p></a></li> --}}
                </ul>
            </li>

            <li>
                <a href="javascript:void(0)" onclick="toggleSubmenu('udaraSubmenu')">
                    <i class="now-ui-icons ui-1_bell-53"></i>
                    <p>Data Kualitas Udara</p>
                </a>
                <ul id="udaraSubmenu" style="display: none; padding-left: 20px;">
                    <li><a class="submenu-sidebar" href="/data_spkua" :active="request()->is('dataSpkuas')"><p>Data SPKUA</p></a></li>
                    <li><a class="submenu-sidebar" href="/data_klhk" :active="request()->is('dataKlhks')"><p>Data KLHK</p></a></li>
                    <li><a class="submenu-sidebar" href="/data_passive" :active="request()->is('dataPassives')"><p>Data Passive Sample</p></a></li>
                    <li><a class="submenu-sidebar" href="/data_partikulat" :active="request()->is('dataPartikulats')"><p>Data Partikulat Mobile</p></a></li>
                </ul>
            </li>

            <li>
                <a href="/maps">
                    <i class="now-ui-icons location_map-big"></i>
                    <p>Maps</p>
                </a>
            </li>
            <li>
                <a href="/berita_acara">
                    <i class="now-ui-icons text_caps-small"></i>
                    <p>Berita Acara</p>
                </a>
            </li>
            {{-- <li class="active-pro">
                <a href="./upgrade.html">
                    <i class="now-ui-icons arrows-1_cloud-download-93"></i>
                    <p>Upgrade to PRO</p>
                </a>
            </li> --}}
        </ul>
    </div>
</div>
