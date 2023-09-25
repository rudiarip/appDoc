<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="#" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="./logo/logo.png" alt="logo" width="40">
            </span>
            <span class="app-brand-text text-uppercase demo menu-text fw-bolder ms-2">App Doc</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Pasien</span>
        </li>
        <!-- Components -->
        <!-- Cards -->
        <li class="menu-item">
            {{-- {{ route('patient.index') }}# --}}
            <a href="" class="menu-link">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <div data-i18n="Basic">pasien</div>
            </a>
        </li>
        <li class="menu-item">
            {{-- {{ route('patient.add') }} --}}
            <a href="" class="menu-link">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <div data-i18n="Basic">add new</div>
            </a>
        </li>

    </ul>
</aside>
