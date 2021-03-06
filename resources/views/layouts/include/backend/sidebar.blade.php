<div
    id="m_ver_menu"
    class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark "
    m-menu-vertical="1"
    m-menu-scrollable="0" m-menu-dropdown-timeout="500"
>
    <ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
        <li class="m-menu__item  m-menu__item--active" aria-haspopup="true">
            <a href="{{route("backend.home.index")}}" class="m-menu__link ">
                <i class="m-menu__link-icon flaticon-line-graph"></i>
                <span class="m-menu__link-title">
										<span class="m-menu__link-wrap">
											<span class="m-menu__link-text">
												Dashboard
											</span>
											<span class="m-menu__link-badge">
												<span class="m-badge m-badge--danger">
													2
												</span>
											</span>
										</span>
									</span>
            </a>
        </li>
        <li class="m-menu__item " aria-haspopup="true">
            <a href="{{route("frontend.home.index")}}" target="_blank" class="m-menu__link ">
                <i class="m-menu__link-icon flaticon-imac"></i>
                <span class="m-menu__link-title">
										<span class="m-menu__link-wrap">
											<span class="m-menu__link-text">
												Ana Sayfa
											</span>

										</span>
									</span>
            </a>
        </li>
        <li class="m-menu__section ">
            <h4 class="m-menu__section-text">
                Components
            </h4>
            <i class="m-menu__section-icon flaticon-more-v3"></i>
        </li>
        <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
            <a href="javascript:;" class="m-menu__link m-menu__toggle">
                <i class="m-menu__link-icon flaticon-settings"></i>
                <span class="m-menu__link-text">
										Ayarlar
									</span>
                <i class="m-menu__ver-arrow la la-angle-right"></i>
            </a>
            <div class="m-menu__submenu ">
                <span class="m-menu__arrow"></span>
                <ul class="m-menu__subnav">
                    <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true">
											<span class="m-menu__link">
												<span class="m-menu__link-text">
													Ayarlar
												</span>
											</span>
                    </li>
                    <li class="m-menu__item " aria-haspopup="true">
                        <a href="{{route("backend.setting.index")}}" class="m-menu__link ">
                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                <span></span>
                            </i>
                            <span class="m-menu__link-text">
													Site Ayarları
												</span>
                        </a>
                    </li>

                </ul>
            </div>
        </li>
        <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1">
            <a href="{{route("backend.user.index")}}" class="m-menu__link ">
                <span class="m-menu__item-here"></span>
                <i class="m-menu__link-icon flaticon-users"></i>
                <span class="m-menu__link-text">
										Kullanıcılar
									</span>
            </a>
        </li>

        <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1">
            <a href="{{route("backend.category.index")}}" class="m-menu__link ">
                <span class="m-menu__item-here"></span>
                <i class="m-menu__link-icon flaticon-signs-1"></i>
                <span class="m-menu__link-text">
										Kategoriler
									</span>
            </a>
        </li>

        <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1">
            <a href="{{route("backend.article.index")}}" class="m-menu__link ">
                <span class="m-menu__item-here"></span>
                <i class="m-menu__link-icon flaticon-edit"></i>
                <span class="m-menu__link-text">
										Makaleler
									</span>
            </a>
        </li>

        <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1">
            <a href="{{route("backend.writer.index")}}" class="m-menu__link ">
                <span class="m-menu__item-here"></span>
                <i class="m-menu__link-icon flaticon-edit-1"></i>
                <span class="m-menu__link-text">
										Yazarlık Başvuruları
									</span>
            </a>
        </li>
    </ul>
</div>
