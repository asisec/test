<div class="dashboard__left dashboard-left-content">
    <div class="dashboard__left__main">
        <div class="dashboard__left__close close-bars"><i class="fa-solid fa-times"></i></div>
        <div class="dashboard__top">
            <div class="dashboard__top__logo">
                <a href="{{route('admin.dashboard')}}">
                {!! render_image_markup_by_attachment_id(get_static_option('site_logo')) !!}
                </a>
            </div>
        </div>

        <div class="dashboard__bottom mt-5">
            <div class="dashboard__bottom__search mb-3">
                <input class="form--control  w-100" type="text" placeholder="{{ __('Search here') }}" id="search_sidebarList">
            </div>
            <ul class="dashboard__bottom__list dashboard-list">

                @can('admin-dashboard')
                    <li class="dashboard__bottom__list__item @if(request()->is('admin/dashboard')) active @endif">
                        <a href="{{route('admin.dashboard')}}"><i class="lab la-accessible-icon"></i>
                            <span class="icon_title">{{ __('Kontrol Paneli') }}</span>
                        </a>
                    </li>
                @endcan

                <li class="dashboard__bottom__list__item has-children @if(request()->is('admin/fast-listing*') || request()->is('admin/sms-test*')) active open show @endif">
    <a href="javascript:void(0)"> 
        <i class="las la-tools"></i> 
        <span class="icon_title">{{ __('Özel Eklentiler') }}</span> 
    </a>
    <ul class="submenu">
        <li class="dashboard__bottom__list__item @if(request()->is('admin/fast-listing')) selected @endif">
            <a href="{{ url('admin/hizli-ilan-bas') }}"> {{ __('Hızlı İlan Bas') }} </a>
        </li>
        <li class="dashboard__bottom__list__item @if(request()->is('admin/sms-test')) selected @endif">
            <a href="{{ url('admin/sms-test') }}"> {{ __('SMS Test Laboratuvarı') }} </a>
        </li>
    </ul>
</li>
                <!--Admin listing manage -->
                @canany(['user-listing-list', 'guest-listing-list', 'admin-listing-list', 'report-reason-list', 'listing-report-list'])
                    <li  class="dashboard__bottom__list__item has-children @if (request()->is('admin/listings/*')) active open show @endif">
                        <a href="javascript:void(0)"> <i class="las la-th-list"></i> {{ __('İlan Yönetimi') }} </a>
                        <ul class="submenu">
                            @can('user-listing-list')
                            <li class="dashboard__bottom__list__item @if (request()->is('admin/listings/user-all-listings')) selected @endif">
                                <a href="{{ route('admin.user.all.listings') }}"> {{ __('Tüm Kullanıcı İlanları') }} </a>
                            </li>
                            @endcan

                            @if(!empty(get_static_option('guest_listing_allowed_disallowed')))
                               @can('guest-listing-list')
                                <li class="dashboard__bottom__list__item @if (request()->is('admin/listings/guest/all-listings')) selected @endif">
                                    <a href="{{ route('admin.guest.all.listings') }}"> {{ __('Tüm Misafir İlanları') }} </a>
                                </li>
                               @endcan
                            @endif

                            @can('admin-listing-list')
                            <li class="dashboard__bottom__list__item @if (request()->is('admin/listings/all') || request()->is('admin/listings/add') || request()->is('admin/listings/admin-edit-listing/*')) selected @endif">
                                <a href="{{ route('admin.all.listings') }}"> {{ __('Tüm Admin İlanları') }} </a>
                            </li>
                           @endcan
                            @can('report-reason-list')
                            <li class="dashboard__bottom__list__item @if (request()->is('admin/listings/report/reason/all')) selected @endif">
                                <a href="{{ route('admin.report.reason.all') }}"> {{ __('Şikayet Nedeni') }} </a>
                            </li>
                            @endcan
                             @can('listing-report-list')
                            <li class="dashboard__bottom__list__item @if (request()->is('admin/listings/report/all')) selected @endif">
                                <a href="{{ route('admin.listing.report.all') }}"> {{ __('İlan Şikayetleri') }} </a>
                            </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany

                <!--Admin advertisement manage -->
                @if(get_static_option('google_adsense_status') == 'on')
                    @canany(['advertisement-list', 'advertisement-add'])
                        <li  class="dashboard__bottom__list__item has-children @if (request()->is('admin/advertisement/*')) active open show @endif">
                            <a href="javascript:void(0)"> <i class="las la-ad"></i> {{ __('Reklam Yönetimi') }} </a>
                            <ul class="submenu">
                                @can('advertisement-list')
                                <li class="dashboard__bottom__list__item @if (request()->is('admin/advertisement/index')) selected @endif">
                                    <a href="{{ route('admin.advertisement') }}"> {{ __('Tüm Reklamlar') }} </a>
                                </li>
                                @endcan
                                @can('advertisement-add')
                                <li class="dashboard__bottom__list__item @if (request()->is('admin/advertisement/new')) selected @endif">
                                    <a href="{{ route('admin.advertisement.new') }}"> {{ __('Yeni Reklam Ekle') }} </a>
                                </li>
                                @endcan
                            </ul>
                        </li>
                     @endcanany
                @endif


               @canany(['user-list', 'user-deactivated-list', 'user-verify-status', 'user-add'])
                <li  class="dashboard__bottom__list__item has-children @if (request()->is('admin/user*')) active open show @endif">
                    <a href="javascript:void(0)"> <i class="las la-user-circle"></i> {{ __('Kullanıcı Yönetimi') }} </a>
                    <ul class="submenu">
                        @can('user-list')
                            <li class="dashboard__bottom__list__item @if (request()->routeIs(['admin.user.all'])) selected @endif">
                                <a href="{{ route('admin.user.all') }}"> {{ __('Tüm Kullanıcılar') }} </a>
                            </li>
                        @endcan
                        @can('user-deactivated-list')
                            <li class="dashboard__bottom__list__item @if (request()->routeIs(['admin.user.deactivated.all'])) selected @endif">
                                <a href="{{ route('admin.user.deactivated.all') }}"> {{ __('Devre Dışı Kullanıcılar') }} </a>
                            </li>
                           <li class="dashboard__bottom__list__item @if (request()->routeIs(['admin.user.restore'])) selected @endif">
                                <a href="{{ route('admin.user.restore') }}"> {{ __('Çöp Kutusu') }} </a>
                            </li>
                        @endcan
                        @can('user-verify-status')
                            <li class="dashboard__bottom__list__item @if (request()->routeIs(['admin.user.verification.request'])) selected @endif">
                                <a href="{{ route('admin.user.verification.request') }}">
                                    {{ __('Kimlik Doğrulama Talepleri') }} </a>
                            </li>
                        @endcan
                        @can('user-add')
                        <li class="dashboard__bottom__list__item @if (request()->routeIs(['admin.user.add'])) selected @endif">
                            <a href="{{ route('admin.user.add') }}">
                                {{ __('Yeni Kullanıcı Ekle') }} </a>
                        </li>
                        @endcan
                    </ul>
                </li>
               @endcanany

               @canany(['category-list', 'category-add'])
                <li class="dashboard__bottom__list__item has-children @if(request()->is('admin/category/*')) active open @endif">
                    <a href="javascript:void(0)"><i class="las la-th-list"></i>
                        <span class="icon_title">{{ __('Kategoriler') }}</span>
                    </a>
                    <ul class="submenu" style="@if(request()->is('admin/category/*')) display:block; @endif">
                        @can('category-list')
                        <li class="dashboard__bottom__list__item @if(request()->is('admin/category/index')) selected @endif">
                            <a href="{{ route('admin.category') }}">{{ __('Tüm Kategoriler') }}</a>
                        </li>
                        @endcan
                       @can('category-add')
                        <li class="dashboard__bottom__list__item @if(request()->is('admin/category/add-new-category')) selected @endif">
                            <a href="{{ route('admin.category.new') }}">{{ __('Yeni Kategori Ekle') }}</a>
                        </li>
                        @endcan
                    </ul>
                </li>
               @endcanany

              @canany(['subcategory-list', 'subcategory-add'])
                <li class="dashboard__bottom__list__item has-children @if(request()->is('admin/subcategory/*')) active open @endif">
                    <a href="javascript:void(0)"><i class="las la-th-list"></i>
                        <span class="icon_title">{{ __('Alt Kategoriler') }}</span>
                    </a>
                    <ul class="submenu" style="@if(request()->is('admin/subcategory/*')) display:block; @endif">
                        @can('subcategory-list')
                        <li class="dashboard__bottom__list__item @if(request()->is('admin/subcategory/index')) selected @endif">
                            <a href="{{ route('admin.subcategory') }}">{{ __('Tüm Alt Kategoriler') }}</a>
                        </li>
                        @endcan
                        @can('subcategory-add')
                        <li class="dashboard__bottom__list__item @if(request()->is('admin/subcategory/add-new-subcategory')) selected @endif">
                            <a href="{{ route('admin.subcategory.new') }}">{{ __('Yeni Alt Kategori Ekle') }}</a>
                        </li>
                       @endcan
                    </ul>
                  </li>
                @endcanany

                    <!-- Child Categories Manage -->
                    @canany(['child-category-list', 'child-category-add'])
                        <li class="dashboard__bottom__list__item has-children @if(request()->is('admin/child-category/*')) active open @endif">
                            <a href="javascript:void(0)">
                                <i class="las la-th-list"></i>
                                <span class="icon_title">{{ __('Alt Kategoriler') }}</span>
                            </a>
                            <ul class="submenu" style="@if(request()->is('admin/child-category/*')) display:block; @endif">
                                @can('child-category-list')
                                    <li class="dashboard__bottom__list__item @if(request()->is('admin/child-category/index')) selected @endif">
                                        <a href="{{ route('admin.child.category') }}">{{ __('Tüm Alt Kategoriler') }}</a>
                                    </li>
                                @endcan
                                @can('child-category-add')
                                    <li class="dashboard__bottom__list__item @if(request()->is('admin/child-category/add-new-child-category')) selected @endif">
                                        <a href="{{ route('admin.child.category.new') }}">{{ __('Yeni Alt Kategori Ekle') }}</a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcanany

                    <!-- Pages Manage -->
                    @canany(['dynamic-page-list', 'dynamic-page-add'])
                        <li class="dashboard__bottom__list__item has-children @if(request()->is('admin/dynamic-page*')) active open @endif">
                            <a href="javascript:void(0)">
                                <i class="las la-paste"></i>
                                <span class="icon_title">{{ __('Sayfalar') }}</span>
                            </a>
                            <ul class="submenu" style="@if(request()->is('admin/dynamic-page/*')) display:block; @endif">
                                @can('dynamic-page-list')
                                    <li class="dashboard__bottom__list__item @if(request()->is('admin/dynamic-page/all')) selected @endif">
                                        <a href="{{ route('admin.page') }}">{{ __('Tüm Sayfalar') }}</a>
                                    </li>
                                @endcan
                                @can('dynamic-page-add')
                                    <li class="dashboard__bottom__list__item @if(request()->is('admin/dynamic-page/new')) selected @endif">
                                        <a href="{{ route('admin.page.new') }}">{{ __('Yeni Sayfa Ekle') }}</a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcanany


                    @include('backend.partials.module-list')


                @can('notifications-list')
                    <li class="dashboard__bottom__list__item @if(request()->is('admin/notification/*')) active @endif">
                        <a href="{{ route('admin.notification.all') }}"><i class="las la-bell"></i>{{ __('Tüm Bildirimler') }}</a>
                    </li>
                @endcan

                @can('notice-list')
                <li class="dashboard__bottom__list__item @if(request()->is('admin/notice/*')) active @endif">
                    <a href="{{ route('admin.all.notice') }}"><i class="las la-bell"></i>{{ __('Duyuru Ayarları') }}</a>
                </li>
                @endcan

              @can('google-map-settings')
                <li class="dashboard__bottom__list__item @if(request()->is('admin/map-settings/*')) active @endif">
                    <a href="{{ route('admin.map.settings.page') }}"><i class="las la-map"></i>{{ __('Google Harita Ayarları') }}</a>
                </li>
               @endcan

                    <!-- Appearance Settings -->
                    @canany([
                        'navbar-global-variant', 'footer-global-variant', 'color-settings', 'typography-settings',
                        'typography-single-settings', 'font-add-settings', 'custom-font-delete', 'custom-font-status-change',
                        'widgets-list', 'widgets-add', 'widgets-delete', 'menu-list', 'menu-add', 'menu-edit', 'menu-delete',
                        'form-builder-list', 'form-builder-edit', 'form-builder-delete', 'form-builder-bulk.delete',
                        'media-upload', 'media-upload-delete', '404-page-settings', 'maintains-page-settings'
                    ])
                        <li class="dashboard__bottom__list__item has-children @if(request()->is('admin/appearance-settings/*')) active open @endif">
                            <a href="javascript:void(0)">
                                <i class="las la-cogs"></i>
                                <span class="icon_title">{{ __('Görünüm Ayarları') }}</span>
                            </a>
                            <ul class="submenu" style="@if(request()->is('admin/appearance-settings/*')) display:block; @endif">
                                @can('form-builder-list')
                                    <li class="dashboard__bottom__list__item @if (request()->is('admin/appearance-settings/form/*')) selected @endif">
                                        <a href="{{ route('admin.form') }}"> {{ __('Form Oluşturucu') }} </a>
                                    </li>
                                @endcan
                                @can('widgets-list')
                                    <li class="dashboard__bottom__list__item @if(request()->is('admin/appearance-settings/widgets')) selected @endif">
                                        <a href="{{ route('admin.widgets') }}">{{ __('Widget Oluşturucu') }}</a>
                                    </li>
                                @endcan
                                @can('menu-list')
                                    <li class="dashboard__bottom__list__item @if(request()->is('admin/appearance-settings/menu')) selected @endif">
                                        <a href="{{ route('admin.menu') }}">{{ __('Menü Yönetimi') }}</a>
                                    </li>
                                @endcan
                                @can('navbar-global-variant')
                                    <li class="dashboard__bottom__list__item @if(request()->is('admin/appearance-settings/global-variant-navbar')) selected @endif">
                                        <a href="{{ route('admin.general.global.variant.navbar') }}">{{ __('Genel Navbar Varyantı') }}</a>
                                    </li>
                                @endcan
                                @can('footer-global-variant')
                                    <li class="dashboard__bottom__list__item @if(request()->is('admin/appearance-settings/global-variant-footer')) selected @endif">
                                        <a href="{{ route('admin.general.global.variant.footer') }}">{{ __('Genel Footer Varyantı') }}</a>
                                    </li>
                                @endcan
                                @can('color-settings')
                                    <li class="dashboard__bottom__list__item @if(request()->is('admin/appearance-settings/color-settings')) selected @endif">
                                        <a href="{{ route('admin.general.color.settings') }}">{{ __('Renk Ayarları') }}</a>
                                    </li>
                                @endcan
                                @can('typography-settings')
                                    <li class="dashboard__bottom__list__item @if(request()->is('admin/appearance-settings/typography-settings')) selected @endif">
                                        <a href="{{ route('admin.general.typography.settings') }}">{{ __('Tipografi Ayarları') }}</a>
                                    </li>
                                @endcan
                                @can('media-upload')
                                    <li class="dashboard__bottom__list__item @if(request()->is('admin/appearance-settings/media-upload/page')) selected @endif">
                                        <a href="{{ route('admin.upload.media.images.page') }}">{{ __('Medya Görselleri Yönetimi') }}</a>
                                    </li>
                                @endcan
                                @can('404-page-settings')
                                    <li class="dashboard__bottom__list__item @if(request()->is('admin/appearance-settings/404-page-manage')) selected @endif">
                                        <a href="{{ route('admin.404.page.settings') }}">{{ __('404 Sayfa Yönetimi') }}</a>
                                    </li>
                                @endcan
                                @can('maintains-page-settings')
                                    <li class="dashboard__bottom__list__item @if(request()->is('admin/appearance-settings/maintains-page')) selected @endif">
                                        <a href="{{ route('admin.maintains.page.settings') }}">{{ __('Bakım Sayfası Yönetimi') }}</a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcanany

                    @canany([
                            'login-register-page-settings', 'listing-create-page-settings', 'listing-details-page-settings',
                            'listing-guest-page-settings', 'user-public-profile-page-settings'
                        ])
                        <li class="dashboard__bottom__list__item has-children @if(request()->is('admin/page-settings/*')) active open @endif">
                            <a href="javascript:void(0)">
                                <i class="las la-envelope"></i>
                                <span class="icon_title">{{ __('Sayfa Ayarları') }}</span>
                            </a>
                            <ul class="submenu" style="@if(request()->is('admin/page-settings/*')) display:block; @endif">
                                @can('login-register-page-settings')
                                    <li class="dashboard__bottom__list__item @if(request()->is('admin/page-settings/register-page')) selected @endif">
                                        <a href="{{ route('admin.login.register.page.settings') }}">{{ __('Giriş ve Kayıt Sayfası') }}</a>
                                    </li>
                                @endcan
                                @can('listing-create-page-settings')
                                    <li class="dashboard__bottom__list__item @if(request()->is('admin/page-settings/listing-create-page/settings')) selected @endif">
                                        <a href="{{ route('admin.listing.create.settings') }}">{{ __('İlan Oluşturma Sayfası Ayarları') }}</a>
                                    </li>
                                @endcan
                                @can('listing-details-page-settings')
                                    <li class="dashboard__bottom__list__item @if(request()->is('admin/page-settings/listing-details-page/settings')) selected @endif">
                                        <a href="{{ route('admin.listing.details.settings') }}">{{ __('İlan Detay Sayfası Ayarları') }}</a>
                                    </li>
                                @endcan
                                @can('listing-guest-page-settings')
                                    <li class="dashboard__bottom__list__item @if(request()->is('admin/page-settings/guest-listing/settings')) selected @endif">
                                        <a href="{{ route('admin.listing.guest.settings') }}">{{ __('Misafir İlan Ayarları') }}</a>
                                    </li>
                                @endcan
                                @can('user-public-profile-page-settings')
                                    <li class="dashboard__bottom__list__item @if(request()->is('admin/page-settings/user-public-profile/settings')) selected @endif">
                                        <a href="{{ route('admin.user.public.profile.settings') }}">{{ __('Kullanıcı Genel Profil Ayarları') }}</a>
                                    </li>
                                @endcan
                                @can('user-public-profile-page-settings')
                                    <li class="dashboard__bottom__list__item @if(request()->is('admin/page-settings/admin-login-page/settings')) selected @endif">
                                        <a href="{{ route('admin.login.page.settings') }}">{{ __('Admin Giriş Sayfası Ayarları') }}</a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcanany

                    @canany(['smtp-settings'])
                    <li class="dashboard__bottom__list__item has-children @if(request()->is('admin/email-settings/*')) active open @endif">
                    <a href="javascript:void(0)"><i class="las la-envelope"></i>
                        <span class="icon_title">{{ __('E-posta Ayarları') }}</span>
                    </a>
                        <ul class="submenu" style="@if(request()->is('admin/email-settings/*')) display:block; @endif">
                            <li class="dashboard__bottom__list__item @if(request()->is('admin/email-settings/smtp')) selected @endif">
                                <a href="{{ route('admin.email.smtp.settings') }}">{{ __('SMTP Ayarları') }}</a>
                            </li>
                            <li class="dashboard__bottom__list__item @if(request()->is('admin/email-settings/all-email-templates')) selected @endif">
                                <a href="{{ route('admin.email.template.all') }}">{{ __('Tüm E-posta Şablonları') }}</a>
                            </li>
                        </ul>
                    </li>
                    @endcanany

                 @canany(['reading-settings', 'site-identity-settings', 'basic-settings', 'seo-settings', 'scripts-settings', 'custom-css-settings',
                          'custom-js-settings', 'sitemap-settings', 'gdpr-settings', 'license-setting', 'software-update-setting', 'cache-settings', 'database-upgrade-setting'
                          ])
                <li class="dashboard__bottom__list__item has-children @if(request()->is('admin/general-settings/*')) active open @endif">
                    <a href="javascript:void(0)"><i class="las la-cog"></i>
                        <span class="icon_title">{{ __('Genel Ayarlar') }}</span>
                    </a>
                    <ul class="submenu" style="@if(request()->is('admin/general-settings/*')) display:block; @endif">
                        @can('reading-settings')
                            <li class="dashboard__bottom__list__item @if(request()->is('admin/general-settings/reading')) selected @endif">
                                <a href="{{ route('admin.general.reading') }}">{{ __('Okuma') }}</a>
                            </li>
                        @endcan
                       @can('site-identity-settings')
                        <li class="dashboard__bottom__list__item @if(request()->is('admin/general-settings/site-identity')) selected @endif">
                            <a href="{{ route('admin.general.site.identity') }}">{{ __('Site Kimliği') }}</a>
                        </li>
                        @endcan
                        @can('basic-settings')
                        <li class="dashboard__bottom__list__item @if(request()->is('admin/general-settings/basic-settings')) selected @endif">
                            <a href="{{ route('admin.general.basic.settings') }}">{{ __('Temel Ayarlar') }}</a>
                        </li>
                       @endcan
                       @can('seo-settings')
                        <li class="dashboard__bottom__list__item @if(request()->is('admin/general-settings/seo-settings')) selected @endif">
                            <a href="{{ route('admin.general.seo.settings') }}">{{ __('SEO Ayarları') }}</a>
                        </li>
                       @endcan
                      @can('scripts-settings')
                        <li class="dashboard__bottom__list__item @if(request()->is('admin/general-settings/scripts')) selected @endif">
                            <a href="{{ route('admin.general.scripts.settings') }}">{{ __('Üçüncü Taraf Betikleri') }}</a>
                        </li>
                      @endcan
                      @can('custom-css-settings')
                        <li class="dashboard__bottom__list__item @if(request()->is('admin/general-settings/custom-css')) selected @endif">
                            <a href="{{ route('admin.general.custom.css') }}">{{ __('Özel CSS') }}</a>
                        </li>
                      @endcan
                       @can('custom-js-settings')
                        <li class="dashboard__bottom__list__item @if(request()->is('admin/general-settings/custom-js')) selected @endif">
                            <a href="{{ route('admin.general.custom.js') }}">{{ __('Özel JS') }}</a>
                        </li>
                      @endcan
                      @can('sitemap-settings')
                        <li class="dashboard__bottom__list__item @if(request()->is('admin/general-settings/sitemap-settings')) selected @endif">
                            <a href="{{ route('admin.general.sitemap.settings') }}">{{ __('Site Haritası Ayarları') }}</a>
                        </li>
                      @endcan
                     @can('gdpr-settings')
                        <li class="dashboard__bottom__list__item @if(request()->is('admin/general-settings/gdpr-settings')) selected @endif">
                            <a href="{{ route('admin.general.gdpr.settings') }}">{{ __('GDPR Ayarları') }}</a>
                        </li>
                     @endcan
                      @can('license-settings')
                        <li class="dashboard__bottom__list__item @if(request()->is('admin/general-settings/license-setting')) selected @endif">
                            <a href="{{ route('admin.general.license.settings') }}">{{ __('Lisans Ayarları') }}</a>
                        </li>
                       @endcan
                      @can('software-update-settings')
                        <li class="dashboard__bottom__list__item @if(request()->is('admin/general-settings/software-update-setting')) selected @endif">
                            <a href="{{ route('admin.general.software.update.settings') }}">{{ __('Güncellemeyi Kontrol Et') }}</a>
                        </li>
                     @endcan
                     @can('cache-settings')
                        <li class="dashboard__bottom__list__item @if(request()->is('admin/general-settings/cache-settings')) selected @endif">
                            <a href="{{ route('admin.general.cache.settings') }}">{{ __('Önbellek Ayarları') }}</a>
                        </li>
                     @endcan
                      @can('database-upgrade-settings')
                        <li class="dashboard__bottom__list__item @if(request()->is('admin/general-settings/database-upgrade')) selected @endif">
                            <a href="{{ route('admin.general.database.upgrade') }}">{{ __('Veritabanı Yükseltmesi') }}</a>
                        </li>
                     @endcan
                    </ul>
                </li>
               @endcanany

                @can('languages-list')
                    <li class="dashboard__bottom__list__item @if(request()->is('admin/languages/*') || request()->is('admin/languages')) active @endif">
                        <a href="{{ route('admin.languages') }}"><i class="las la-language"></i> <span class="icon_title">{{ __('Diller') }}</span></a>
                    </li>
                @endcan

                <li class="dashboard__bottom__list__item">
                    <a href="{{ route('admin.logout') }}"> <i class="las la-sign-out-alt"></i> <span class="icon_title">{{ __('Çıkış Yap') }}</span></a>
                </li>
            </ul>
        </div>
    </div>
</div>







