<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">

    <div class="container">
        <a class="navbar-brand" href="{{route('frontend.home.index')}}">Blog</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                aria-label="Toggle navigation">
            Menu
            <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li><a href="{{route("frontend.home.index")}}"><i class="fa fa-home"></i>Ana Sayfa</a></li>
                @if(Auth::guest())
                    <li><a href="{{route("login")}}"><i class="fa fa-sign-in"></i> Üye Girişi</a>
                    </li>
                    <li><a href="{{route('register')}}"><i class="fa fa-users"></i> Üye Ol</a></li>
                @else

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                           aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-right" role="menu">
                            @if(Auth::user()->yetkisi_varmi("admin"))
                                <li><a href="{{ url('/site-ayarlari') }}"><i class="fa fa-dashboard"></i>
                                        Admin Panel</a></li>

                            @endif
                            @if(Auth::user()->yetkisi_varmi("author"))
                                <li><a href="{{ route("frontend.article.index")}}"><i class="fa fa-btn fa-list"></i>Makalelerim</a>
                                </li>
                                <li><a href="{{route("frontend.article.create") }}"><i class="fa fa-btn fa-plus"></i>Yeni
                                        Makale Ekle</a></li>
                            @endif
                            @if(!Auth::user()->yetkisi_varmi("admin") && !Auth::user()->yetkisi_varmi("author"))
                                <li><a href="{{ url('/yazarlik-talebi') }}"><i class="fa fa-btn fa-envelope"></i>Yazarlık
                                        Talebi</a></li>
                            @endif
                            <li class="">
                                <a class="dropdown-item pl-0" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"></i>Çıkış
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>
                            </li>
                            @endif

                        </ul>
                    </li>
            </ul>
        </div>
    </div>
</nav>
