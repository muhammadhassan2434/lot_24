<div class="left side-menu">
    <button type="button" class="button-menu-mobile button-menu-mobile-topbar open-left waves-effect">
        <i class="ion-close"></i>
    </button>

    <!-- LOGO -->
    <div class="topbar-left">
        <div class="text-center">
            <!--<a href="index.html" class="logo"><i class="mdi mdi-assistant"></i>Zoter</a>-->
            <a href="{{ route('admindashboard.index')}}" class="logo">
                <span class="text-light" style="font-size: 20px;">LOT24</span>
            </a>
        </div>
    </div>

    <div class="sidebar-inner niceScrollleft">

        <div id="sidebar-menu">
            <ul>
                <li class="menu-title">Main</li>

                <li>
                    <a href="{{route('admindashboard.index')}}" class="waves-effect">
                        <i class="mdi mdi-airplay"></i>
                        <span> Dashboard </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('category.index')}}" class="waves-effect">
                        <i class="fa-solid fa-list"></i>
                        <span> Category </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('subcategory.index')}}" class="waves-effect">
                        <i class="fa-solid fa-layer-group"></i>
                        <span> SubCategory </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('country.index')}}" class="waves-effect">
                        <i class="fa-solid fa-globe"></i>
                        <span> Country </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('brand.index')}}" class="waves-effect">
                        <i class="fa-brands fa-web-awesome"></i>
                        <span> Brands</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('user.index')}}" class="waves-effect">
                        <i class="fa-solid fa-user"></i>
                        <span> Users</span>
                    </a>
                </li>
                {{-- <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-layers"></i> <span> Advanced UI </span> <span class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                    <ul class="list-unstyled">
                        <li><a href="advanced-highlight.html">Highlight</a></li>
                        <li><a href="advanced-rating.html">Rating</a></li>
                        <li><a href="advanced-alertify.html">Alertify</a></li>
                        <li><a href="advanced-rangeslider.html">Range Slider</a></li>
                    </ul>
                </li> --}}

            </ul>
        </div>
        <div class="clearfix"></div>
    </div> <!-- end sidebarinner -->
</div>
