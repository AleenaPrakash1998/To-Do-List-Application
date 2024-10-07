<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme position-fixed h-100 top-0 left-0">
    <div class="app-brand demo">
        <a href=
{{--               "{{ route('vendor-products.index') }}" --}}
           class="app-brand-link">
              <span class="app-brand-logo demo">

              </span>
            <div class="d-flex justify-content-center align-items-center border rounded px-3 py-2">
                <h3 class="text-uppercase">To-Do List</h3>
            </div>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <li class="menu-item  open">
            <ul class="menu-sub">
                <li class="menu-item {{ Request::is('tasks*') ? 'active' : '' }}">
                    <a href="{{ route('tasks.index') }}"
                       class="menu-link {{ Request::is('tasks*') ? 'active' : '' }}">
                        <div data-i18n="Without menu"><span class="me-2"><i class='bx bxl-product-hunt'></i></span>Products
                        </div>
                    </a>
                </li>
                <li class="menu-item {{ Request::is('customer-carts*') ? 'active' : '' }}">
                    <a href="{{route('customer-carts.index')}}"
                       class="menu-link {{ Request::is('customer-carts*') ? 'active' : '' }}">
                        <div data-i18n="Without navbar"><span class="me-2"><i class='bx bx-cart'></i></span>Cart
                        </div>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
    <div style="height: 292px;width: 195px;margin-left: 4pc">
        <img style="height: 100%;width: 100%" class="object-fit-cover"
             src="{{asset('assets/img/backgrounds/sidebar-image.png')}}"/>
    </div>
</aside>


<style>
    .menu-item > .menu-link.active {
        background-color: #C39F7433 !important;
    }

</style>
