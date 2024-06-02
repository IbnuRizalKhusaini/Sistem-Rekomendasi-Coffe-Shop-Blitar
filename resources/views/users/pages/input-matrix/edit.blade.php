<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Rekomendasi Coffee Shop</title>
    <!-- for icons  -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <!-- bootstrap  -->
    <link rel="stylesheet" href="{{ asset ('assets/css/bootstrap.min.css') }}">
    <!-- for swiper slider  -->
    <link rel="stylesheet" href="{{ asset ('assets/css/swiper-bundle.min.css') }}">

    <!-- fancy box  -->
    <link rel="stylesheet" href="{{ asset ('assets/css/jquery.fancybox.min.css') }}">
    <!-- custom css  -->
    <link rel="stylesheet" href="style.css">
</head>


<body class="body-fixed">
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
    <!-- End Header -->
    <main>
        <div class="container mt-4 py-5">
            <div class="row mb-4 justify-content-center">
                <div class="col-md-8">
                    <div class="text-center mb-4">
                        <p class="font-weight-bold">
                            Berikan Penilaian Anda Setelah Mengunjungi {{ $alternatives->alternative_name }}
                        </p>
                    </div>

                    <div class="row">
                        <div class="col-md-6 text-center d-flex flex-column align-items-center">
                            <img src="{{ asset('storage/' . $alternatives->image) }}"
                                class="img-fluid img-fluid-custom larger-image mb-3" alt="Gambar">
                            <p class="font-weight-bold transparent-text ">
                                {{ $alternatives->description }}
                            </p>
                        </div>
                        <div class="col-md-5">
                            <form
                                action="{{ route('user.alternative-values.update', ['alternative_id' => $alternatives->id]) }}"
                                method="POST">
                                @csrf
                                @method('PUT')

                                @foreach ($criterias as $criteria)
                                    <div class="mb-3">
                                        <label for="value{{ $criteria->id }}"
                                            class="form-label">{{ $criteria->criteria_name }}</label>
                                        <select name="values[{{ $criteria->id }}]" id="value{{ $criteria->id }}"
                                            class="form-select" required>
                                            <option value="">Beri Nilai</option>
                                            <option value="1">1 - Sangat Buruk</option>
                                            <option value="2">2 - Buruk</option>
                                            <option value="3">3 - Cukup</option>
                                            <option value="4">4 - Baik</option>
                                            <option value="5">5 - Sangat Baik</option>
                                        </select>
                                        @error('values.' . $criteria->id)
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                @endforeach

                                <div class="d-flex justify-content-between">
                                    <button type="submit" class="btn btn-primary btn-visit">Simpan</button>
                                    {{-- <a href="{{ route('user.home.index') }}" class="btn btn-danger btn-visit">Kembali ke Home</a> --}}
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer class="site-footer" id="contact">
                <div class="top-footer section">
                    <div class="sec-wp">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="footer-info">
                                        <div class="footer-logo">
                                            <a href="index.html">
                                                <img src="logo-cafe.png" width="50" height="50" alt="">
                                            </a>
                                        </div>
                                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Mollitia, tenetur.
                                        </p>
                                        <div class="social-icon">
                                            <ul>
                                                <li>
                                                    <a href="#">
                                                        <i class="uil uil-facebook-f"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <i class="uil uil-instagram"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <i class="uil uil-github-alt"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <i class="uil uil-youtube"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="footer-flex-box">
                                        <!--<div class="footer-table-info">
                                            <h3 class="h3-title">open hours</h3>
                                            <ul>
                                                <li><i class="uil uil-clock"></i> Mon-Thurs : 9am - 22pm</li>
                                                <li><i class="uil uil-clock"></i> Fri-Sun : 11am - 22pm</li>
                                            </ul>
                                        </div>
                                        <div class="footer-menu food-nav-menu">
                                            <h3 class="h3-title">Links</h3>
                                            <ul class="column-2">
                                                <li>
                                                    <a href="#home" class="footer-active-menu">Home</a>
                                                </li>
                                                <li><a href="#about">About</a></li>
                                                <li><a href="#menu">Menu</a></li>
                                                <li><a href="#gallery">Gallery</a></li>
                                                <li><a href="#blog">Blog</a></li>
                                                <li><a href="#contact">Contact</a></li>
                                            </ul>
                                        </div>
                                        <div class="footer-menu">
                                            <h3 class="h3-title">Company</h3>
                                            <ul>
                                                <li><a href="#">Terms & Conditions</a></li>
                                                <li><a href="#">Privacy Policy</a></li>
                                                <li><a href="#">Cookie Policy</a></li>
                                            </ul>
                                        </div>-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bottom-footer">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12 text-center">
                                <div class="copyright-text">
                                    <p>Copyright &copy; 2024 <span class="name">Sirecoshop. </span>All Rights Reserved.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <button class="scrolltop"><i class="uil uil-angle-up"></i></button>
                    </div>
                </div>
            </footer>

    <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <!-- jquery  -->
<script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>
<!-- bootstrap -->
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/popper.min.js') }}"></script>
<!-- fontawesome  -->
<script src="{{ asset('assets/js/font-awesome.min.js') }}"></script>
<!-- swiper slider  -->
<script src="{{ asset('assets/js/swiper-bundle.min.js') }}"></script>
<!-- mixitup -- filter  -->
<script src="{{ asset('assets/js/jquery.mixitup.min.js') }}"></script>
<!-- fancy box  -->
<script src="{{ asset('assets/js/jquery.fancybox.min.js') }}"></script>
<!-- parallax  -->
<script src="{{ asset('assets/js/parallax.min.js') }}"></script>
<!-- gsap  -->
<script src="{{ asset('assets/js/gsap.min.js') }}"></script>
<!-- scroll trigger  -->
<script src="{{ asset('assets/js/ScrollTrigger.min.js') }}"></script>
<!-- scroll to plugin  -->
<script src="{{ asset('assets/js/ScrollToPlugin.min.js') }}"></script>
<!-- smooth scroll  -->
<script src="{{ asset('assets/js/smooth-scroll.js') }}"></script>
<!-- custom js  -->
<script src="{{ asset('main.js') }}"></script>

<script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('assets/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if ($message = Session::get('success'))
        <script>
            Swal.fire('{{ $message }}');
        </script>
    @endif

    @if ($message = Session::get('failed'))
        <script>
            Swal.fire('{{ $message }}');
        </script>
    @endif

</body>

</html>
