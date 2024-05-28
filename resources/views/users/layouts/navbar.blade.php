<header class="site-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-2">
                    <div class="header-logo">
                        <a href="index.html">
                            <img src="logo-cafe.png" width="36" height="36" alt="Logo">
                        </a>
                    </div>
                </div>
                <div class="col-lg-10">
                    <div class="main-navigation">
                        <button class="menu-toggle"><span></span><span></span></button>
                        <nav class="header-menu">
                            <ul class="menu food-nav-menu">
                                <li><a href="#home">Home</a></li>
                                <li><a href="#about">About</a></li>
                                <li><a href="#blog">Coffe Shop</a></li>
                                <li><a href="#contact">Contact</a></li>
                                <li></li>
                                <li></li>
                                <li><a href="../sirecoshop/index.php"><b>Rekomendasi Kafe</b></a></li>
                                <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Akun
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    @guest
                                        <li><a class="dropdown-item" href="{{ route('login') }}">Login</a></li>
                                        <li><a class="dropdown-item" href="{{ route('register-view') }}">Register</a></li>
                                    @else
                                        <li>
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                Logout
                                            </a>
                                        </li>
                                        <form id="logout-form" action="{{ route('logout') }}" style="display: none;">
                                            @csrf
                                        </form>
                                    @endguest
                                </ul>
                            </li>
                            </ul>
                        </nav>
                        
                    </div>
                </div>
            </div>
        </div>
    </header>