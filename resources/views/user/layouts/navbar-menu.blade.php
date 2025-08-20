<header class="header-style-02">
    <div class="header-topbar">
        <div class="container">
          <div class="header-topbar-inner">
            <div class="header-topbar-leftpart">
              <ul class="topbar-info">
                <li>
                  <i class="base-icon-email1"></i>
                  <a href="mailto:{!! $spEmail->value !!}">{!! $spEmail->value !!}</a>
                </li>
                <li>
                  <i class="base-icon-pin2"></i>
                  <a href="{{ route('contact.index') }}">Jl. Pangeran Jayakarta 126 - 129 Blok D52</a>
                </li>
              </ul>
            </div>
            <div class="header-topbar-rightpart">
              <ul class="topbar-social">
                @foreach ($spSocialLink as $sl)
                    <li>
                        <a href="{{ $sl->link }}" target="_blank"><i class="fab {{ $sl->icon }}"></i></a>
                    </li>
                @endforeach
              </ul>
              <div class="language">
                <a class="language-btn" href="#"><i class="base-icon-globe1"></i> <span>English</span></a>
                <ul class="language-dropdown">
                  <li><a href="#">English</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    <nav class="main-menu sticky-header">
        <div class="container">
          <div class="main-menu-inner">
            <div class="main-menu-logo">
                <a href="{{ route('home.index') }}">
                    <img src="{{ URL::asset('assets/user/images/logo1.png') }}" width="165" height="72" alt="PT. Best Insulation Indonesia" />
                </a>
            </div>
            <ul class="main-nav-menu">
                <li class="{{ $activeMenu == 'home' ? 'current' : '' }}">
                    <a href="{{ route('home.index') }}">Home</a>
                </li>
                <li class="menu-has-sub {{ $activeMenu == 'product' ? ' current' : '' }}">
                    <a href="#">Product</a>
                    <ul>
                        <li><a href="{{ route('products.index') }}">All Products</a></li>

                        @foreach($spCategoryList as $eachCategory)
                            <li>
                                <a href="{{ route('products.category', ['category_permalink' => $eachCategory->permalink]) }}">
                                    {{ $eachCategory->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
                <li class="{{ $activeMenu == 'project' ? 'current' : '' }}">
                    <a href="{{ route('projects.index') }}">Project</a>
                </li>
                <li class="{{ $activeMenu == 'news' ? 'current' : '' }}">
                    <a href="{{ route('news.index') }}">News</a>
                </li>
                <li class="{{ $activeMenu == 'about' ? 'current' : '' }}">
                    <a href="{{ route('about.index') }}">About</a>
                </li>
                <li class="{{ $activeMenu == 'career' ? 'current' : '' }}">
                    <a href="{{ route('career.index') }}">Career</a>
                </li>
                <li class="{{ $activeMenu == 'contact' ? 'current' : '' }}">
                    <a href="{{ route('contact.index') }}">Contact</a>
                </li>
            </ul>
            <div class="main-menu-right">
                <a href="#" class="mobile-nav-toggler">
                    <span></span>
                    <span></span>
                    <span></span>
                </a>
                <a href="#" class="search-toggler">
                    <i class="base-icon-search-1"></i>
                </a>
                <div class="header-contact-info">
                    <div class="header-contact-info-icon">
                        <i class="base-icon-011-phone-1"></i>
                    </div>
                    <div class="header-contact-info-text">
                        <p class="call-text">Contact Me</p>
                        <h5 class="phone-no">
                            <a href="https://wa.me/{{ $spWhatsapp->value }}" target="_blank">+{{ $spWhatsapp->value }}</a>
                        </h5>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </nav>
</header>
