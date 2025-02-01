<div class="left side-menu">
    <button type="button" class="button-menu-mobile button-menu-mobile-topbar open-left waves-effect">
        <i class="ion-close"></i>
    </button>

    <!-- LOGO -->
    <div class="topbar-left">
        <div class="text-center">
            <!--<a href="index.html" class="logo"><i class="mdi mdi-assistant"></i>Zoter</a>-->
            <a href="{{ route('admindashboard.index') }}" class="logo">
                <span class="text-light" style="font-size: 20px;">LOT24</span>
            </a>
        </div>
    </div>

    <div class="sidebar-inner niceScrollleft">

        <div id="sidebar-menu">
            <ul>
                <li class="menu-title">Main</li>

                <li>
                    <a href="{{ route('admindashboard.index') }}" class="waves-effect">
                        <i class="mdi mdi-airplay"></i>
                        <span> Dashboard </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('category.index') }}" class="waves-effect">
                        <i class="fa-solid fa-list"></i>
                        <span> Category </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('subcategory.index') }}" class="waves-effect">
                        <i class="fa-solid fa-layer-group"></i>
                        <span> SubCategory </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('country.index') }}" class="waves-effect">
                        <i class="fa-solid fa-globe"></i>
                        <span> Country </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('brand.index') }}" class="waves-effect">
                        <i class="fa-brands fa-web-awesome"></i>
                        <span> Brands</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('subscription.index') }}" class="waves-effect">
                        <i class="fa-solid fa-dollar-sign"></i>
                        <span> Subcriptions</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.showproducts') }}" class="waves-effect">
                        <i class="fa-brands fa-product-hunt"></i>
                        <span> Products</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('account.index') }}" class="waves-effect">
                        <i class="fa-solid fa-user-secret"></i>
                        <span>Buyer's/Seller's</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('contact.index') }}" class="waves-effect">
                        <i class="fa-solid fa-envelope-open-text"></i>
                        <span>Messages</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('review.index') }}" class="waves-effect">
                        <i class="fa-regular fa-comments"></i>
                        <span>Reviews</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('user.index') }}" class="waves-effect">
                        <i class="fa-solid fa-user"></i>
                        <span> Users</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('header.index') }}" class="waves-effect">
                        <i class="fa-brands fa-hire-a-helper"></i>
                        <span>Header's</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('color.index') }}" class="waves-effect">
                        <i class="fa-solid fa-droplet"></i>
                        <span>Color's</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('topbar.index') }}" class="waves-effect">
                        <i class="fa-brands fa-codepen"></i>
                        <span>TopBar's</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('popularsearch.index') }}" class="waves-effect">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <span>Popular Search's</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('blog.index') }}" class="waves-effect">
                        <i class="fa-brands fa-blogger"></i>
                        <span>Blog's</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('influencer.index') }}" class="waves-effect">
                        <i class="fa-solid fa-person"></i>
                        <span>Influencer's</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('coupon.index') }}" class="waves-effect">
                        <i class="fa-solid fa-ticket"></i>
                        <span>Coupon's</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('couponusage.index') }}" class="waves-effect">
                        <i class="fa-solid fa-receipt"></i>
                        <span>Coupon Usage</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('media.index') }}" class="waves-effect">
                        <i class="fa-brands fa-slack"></i>
                        <span>Social Media's</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('stripe.index') }}" class="waves-effect">
                        <i class="fa-brands fa-cc-stripe"></i>
                        <span>Stripe Account</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('contactInfo.index') }}" class="waves-effect">
                        <i class="fa-brands fa-cc-stripe"></i>
                        <span>Contact Info</span>
                    </a>
                </li>
                <li class="menu-title">Footer</li>
                <li>
                    {{-- <a href="{{ route('term.index') }}" class="waves-effect">
                        <i class="fa-solid fa-scale-balanced"></i>
                        <span>Terms and Condition</span>
                    </a> --}}
                </li>
                {{-- <li>
                    <a href="{{ route('refund.index') }}" class="waves-effect">
                        <i class="fa-solid fa-money-bill"></i>
                        <span>Refund Policy</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('privacy.index') }}" class="waves-effect">
                        <i class="fa-solid fa-shield-halved"></i>
                        <span>Privacy Policy</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('aboutus.index') }}" class="waves-effect">
                        <i class="fa-solid fa-address-card"></i>
                        <span>About Us</span>
                    </a>
                </li> --}}
            </ul>
        </div>
        <div class="clearfix"></div>
    </div> <!-- end sidebarinner -->
</div>
