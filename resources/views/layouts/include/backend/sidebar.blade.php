<div
    id="m_ver_menu"
    class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark "
    m-menu-vertical="1"
    m-menu-scrollable="0" m-menu-dropdown-timeout="500"
>
    <ul class="m-menu__nav ">
        <li class="m-menu__section m-menu__section--first">
            <h4 class="m-menu__section-text">
                Departments
            </h4>
            <i class="m-menu__section-icon flaticon-more-v3"></i>
        </li>
        <li class="m-menu__item  m-menu__item--active" aria-haspopup="true">
            <a href="index.html" class="m-menu__link ">
                <span class="m-menu__item-here"></span>
                <i class="m-menu__link-icon flaticon-line-graph"></i>
                <span class="m-menu__link-text">
										Dashboard
									</span>
            </a>
        </li>
        <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
            <a href="javascript:;" class="m-menu__link m-menu__toggle">
                <span class="m-menu__item-here"></span>
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
												<span class="m-menu__item-here"></span>
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

    </ul>
</div>
