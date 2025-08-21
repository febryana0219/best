<!-- Menu -->

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="index.html" class="app-brand-link">
            <span class="app-brand-logo demo me-1">
                <span style="color: var(--bs-primary)">
                    <img src="{{ URL::asset('assets/admin/img/logo/best_v2.png') }}" width="200" />
                </span>
            </span>
            <span class="app-brand-text demo menu-text fw-semibold ms-2"> </span>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <li class="menu-item {{ str_contains($activeMenu, 'homepage') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ri-home-line"></i>
                <div data-i18n="Basic">Home Page</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item{{ $activeMenu == 'homepage.slide_show' ? ' active' : '' }}">
                    <a href="{{ route('admin.homepage.slide_show.index') }}" class="menu-link">
                        <div data-i18n="Basic">Slide Show</div>
                    </a>
                </li>
                <li class="menu-item{{ $activeMenu == 'homepage.client_worked' ? ' active' : '' }}">
                    <a href="{{ route('admin.homepage.client_worked.index') }}" class="menu-link">
                        <div data-i18n="Basic">Client Worked</div>
                    </a>
                </li>
                {{-- <li class="menu-item{{ $activeMenu == 'homepage.banner' ? ' active' : '' }}">
                    <a href="{{ route('admin.homepage.banner.index') }}" class="menu-link">
                        <div data-i18n="Basic">Banner</div>
                    </a>
                </li> --}}
                <li class="menu-item{{ $activeMenu == 'homepage.footer' ? ' active' : '' }}">
                    <a href="{{ route('admin.homepage.footer.index') }}" class="menu-link">
                        <div data-i18n="Basic">Footer</div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-item {{ str_contains($activeMenu, 'catalog') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ri-booklet-line"></i>
                <div data-i18n="Basic">Catalogs</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item{{ $activeMenu == 'catalog.category' ? ' active' : '' }}">
                    <a href="{{ route('admin.catalog.category.index') }}" class="menu-link">
                        <div data-i18n="Basic">Category</div>
                    </a>
                </li>
                <li class="menu-item{{ $activeMenu == 'catalog.product' ? ' active' : '' }}">
                    <a href="{{ route('admin.catalog.product.index') }}" class="menu-link">
                        <div data-i18n="Basic">Product</div>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Manage Static Page -->
        <li class="menu-item {{ str_contains($activeMenu, 'static_page') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ri-pages-line"></i>
                <div data-i18n="Basic">Static Page</div>
            </a>

            <ul class="menu-sub">
                {{-- <li class="menu-item{{ $activeMenu == 'static_page.page_header' ? ' active' : '' }}">
                    <a href="{{ route('admin.static_page.page_header.index') }}" class="menu-link">
                        <div data-i18n="Basic">Page Header</div>
                    </a>
                </li> --}}
                <li class="menu-item{{ $activeMenu == 'static_page.about' ? ' active' : '' }}">
                    <a href="{{ route('admin.static_page.about.index') }}" class="menu-link">
                        <div data-i18n="Basic">About</div>
                    </a>
                </li>
                <li class="menu-item{{ $activeMenu == 'static_page.news' ? ' active' : '' }}">
                    <a href="{{ route('admin.static_page.news.index') }}" class="menu-link">
                        <div data-i18n="Basic">News</div>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Manage Page -->
        {{-- <li class="menu-item">
            <a href="#" class="menu-link">
                <i class="menu-icon tf-icons ri-article-line"></i>
                <div data-i18n="Basic">Manage Page</div>
            </a>
        </li> --}}

        <!-- Quality Control -->
        <li class="menu-item {{ str_contains($activeMenu, 'qc') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ri-booklet-line"></i>
                <div data-i18n="Basic">Quality Control</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item{{ $activeMenu == 'qc.category' ? ' active' : '' }}">
                    <a href="{{ route('admin.qc.category.index') }}" class="menu-link">
                        <div data-i18n="Basic">Category</div>
                    </a>
                </li>
                {{-- <li class="menu-item{{ $activeMenu == 'qc.project' ? ' active' : '' }}">
                    <a href="{{ route('admin.qc.project.index') }}" class="menu-link">
                        <div data-i18n="Basic">Project</div>
                    </a>
                </li> --}}
            </ul>
        </li>

        <!-- Contact -->
        <li class="menu-item {{ str_contains($activeMenu, 'contact') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ri-contacts-line"></i>
                <div data-i18n="Basic">Contact</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item{{ $activeMenu == 'contact.message' ? ' active' : '' }}">
                    <a href="{{ route('admin.contact.messages.index') }}" class="menu-link">
                        <div data-i18n="Basic">Contact Message</div>
                    </a>
                </li>
                <li class="menu-item{{ $activeMenu == 'contact.address' ? ' active' : '' }}">
                    <a href="{{ route('admin.contact.address.index') }}" class="menu-link">
                        <div data-i18n="Basic">Contact Adress</div>
                    </a>
                </li>
                <li class="menu-item{{ $activeMenu == 'contact.whatsapp' ? ' active' : '' }}">
                    <a href="{{ route('admin.contact.whatsapp.index') }}" class="menu-link">
                        <div data-i18n="Basic">Contact Whatsapp</div>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Systems -->
        <li class="menu-item {{ str_contains($activeMenu, 'system') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ri-settings-3-line"></i>
                <div data-i18n="Basic">Systems</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item{{ $activeMenu == 'system.newsletter' ? ' active' : '' }}">
                    <a href="{{ route('admin.system.newsletter.index') }}" class="menu-link">
                        <div data-i18n="Basic">Newsletter</div>
                    </a>
                </li>
                <li class="menu-item{{ $activeMenu == 'system.social_link' ? ' active' : '' }}">
                    <a href="{{ route('admin.system.social_link.index') }}" class="menu-link">
                        <div data-i18n="Basic">Social Link</div>
                    </a>
                </li>
                <li class="menu-item{{ $activeMenu == 'system.seo' ? ' active' : '' }}">
                    <a href="{{ route('admin.system.seo.edit') }}" class="menu-link">
                        <div data-i18n="Basic">SEO</div>
                    </a>
                </li>
                <li class="menu-item{{ $activeMenu == 'system.administrator' ? ' active' : '' }}">
                    <a href="{{ route('admin.system.administrator.index') }}" class="menu-link">
                        <div data-i18n="Basic">Administrator</div>
                    </a>
                </li>
                <li class="menu-item{{ $activeMenu == 'system.email' ? ' active' : '' }}">
                    <a href="{{ route('admin.system.email.edit') }}" class="menu-link">
                        <div data-i18n="Basic">Email</div>
                    </a>
                </li>
                <li class="menu-item{{ $activeMenu == 'system.email_career' ? ' active' : '' }}">
                    <a href="{{ route('admin.system.email_career.index') }}" class="menu-link">
                        <div data-i18n="Basic">Email Career</div>
                    </a>
                </li>
                <li class="menu-item{{ $activeMenu == 'system.phone' ? ' active' : '' }}">
                    <a href="{{ route('admin.system.phone.edit') }}" class="menu-link">
                        <div data-i18n="Basic">Phone</div>
                    </a>
                </li>
                <li class="menu-item{{ $activeMenu == 'system.address' ? ' active' : '' }}">
                    <a href="{{ route('admin.system.address.edit') }}" class="menu-link">
                        <div data-i18n="Basic">Address</div>
                    </a>
                </li>
                <li class="menu-item{{ $activeMenu == 'system.ga' ? ' active' : '' }}">
                    <a href="{{ route('admin.system.ga.edit') }}" class="menu-link">
                        <div data-i18n="Basic">Google Analytics</div>
                    </a>
                </li>
                <li class="menu-item{{ $activeMenu == 'system.bg' ? ' active' : '' }}">
                    <a href="{{ route('admin.system.bg.index') }}" class="menu-link">
                        <div data-i18n="Basic">Background</div>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</aside>
<!-- / Menu -->
