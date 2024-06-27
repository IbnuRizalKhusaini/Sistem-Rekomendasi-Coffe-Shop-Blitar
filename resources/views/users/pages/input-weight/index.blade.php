<!DOCTYPE html>
<html lang="en">

@extends('users.pages.input-matrix.assets.style')

<body>
    <header class="site-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-2">
                    <div class="header-logo">
                        <a href="index.html">
                            <img src="{{asset ('logo-cafe.png')}}" width="36" height="36" alt="Logo">
                        </a>
                    </div>
                </div>
                <div class="col-lg-10">
                    <div class="main-navigation">
                        <button class="menu-toggle"><span></span><span></span></button>
                        <nav class="header-menu">
                            <ul class="menu food-nav-menu">
                                <li><a href="{{ route('user.home.index') }}">Home</a></li>
                                <li><a href="{{ route('user.home.index') }}#about">About</a></li>
                                <li><a href="{{ route('user.home.index') }}#blog">Coffe Shop</a></li>
                                <li><a href="{{ route('user.home.index') }}#contact">Contact</a></li>
                                <li></li>
                                <li></li>
                                <li><a href="{{route ('check.rankings')}}"><b>Rekomendasi Kafe</b></a></li>
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
    <main>
        <br><br><br>
        <div class="container mt-4 py-5">
            <div class="row mb-4 justify-content-center">
                <div class="col-md-8">
                    <div class="text-center mb-4">
                        <p class="font-weight-bold text-capitalize">
                            Silahkan isi kolom kriteria tersebut sesuai keinginan/preferensi anda
                        </p>
                    </div>
    
                    <div class="row justify-content-center">
                        <div class="col-md-7 text-center d-flex flex-column align-items-center">
                            <img src="{{asset('coffee.jpeg')}}" class="img-fluid img-fluid-custom larger-image mb-3" alt="Gambar">
                        </div>
                        <div class="col-md-5">
                            <form action="{{ route('user.weight.store') }}" method="POST">
                                @csrf
                                @foreach ($criterias as $criteria)
                                    <div class="mb-3">
                                        <label for="value{{ $criteria->id }}" class="form-label"><b>{{ $criteria->criteria_name }}</b></label>
                                        <div class="d-flex align-items-center">
                                            @if($criteria->criteria_name === 'Harga')
                                                <span class="me-2">Mahal</span>
                                            @else
                                                <span class="me-2">Kurang</span>
                                            @endif
                                            <input type="range" name="values[{{ $criteria->id }}]" id="value{{ $criteria->id }}" class="form-range" min="1" max="100" step="1" oninput="this.nextElementSibling.value = this.value" required>
                                            <output class="ms-2">50</output>
                                            @if($criteria->criteria_name !== 'Harga')
                                                <span class="ms-2">Baik</span>
                                            @else
                                                <span class="ms-2">Murah</span>
                                            @endif
                                        </div>
                                        @error('values.' . $criteria->id)
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                @endforeach
    
                                <div class="d-flex justify-content-between">
                                    <button type="submit" class="btn btn-primary btn-visit">Hasil</button>
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

    <!-- footer starts  -->
    <footer class="site-footer" id="contact">
        <div class="top-footer section">
            <div class="sec-wp">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="footer-info">
                                <div class="footer-logo">
                                    <a href="index.html">
                                        <img src="{{asset ('logo-cafe.png')}}" width="50" height="50" alt="">
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
    @include('users.layouts.script')

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
