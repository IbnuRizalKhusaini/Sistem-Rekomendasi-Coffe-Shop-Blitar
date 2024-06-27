@php
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Auth;
    use App\Models\WeightValue;
    use App\Models\Alternative;
    use App\Models\Criteria;
    use App\Models\Ranking;

    // Ambil semua entri weight_values dari database
    $weightValues = WeightValue::all();

    // Hitung total nilai weight
    $totalWeight = $weightValues->sum('weight');

    // Ambil semua nilai alternatif dari database
    $alternatives = Alternative::all();

    // Buat array untuk menyimpan pembagi untuk setiap criteria_id
    $divisors = [];

    // Hitung pembagi untuk setiap criteria_id
    foreach ($alternatives->groupBy('criteria_id') as $criteria_id => $groupedAlternatives) {
        $sumOfSquares = $groupedAlternatives->sum(function ($alternative) {
            return pow($alternative->value, 2);
        });
        $divisors[$criteria_id] = sqrt($sumOfSquares);
    }
@endphp

@if ($totalWeight > 0)
    @foreach ($weightValues as $weightValue)
        <!-- Proses setiap weightValue -->
    @endforeach
@else
    <!-- Jika total weight 0 -->
@endif

<!-- Menampilkan Normalized Matrix dan Weighted Normalized Values (Y) -->
@php
    $aPositifs = [];
    $aNegatifs = [];
    $weightedNormalizedValues = [];
    $Vs = [];
@endphp

@foreach($groupedData as $criteria_id => $alternatives)
    @php
        $sumOfSquares = $alternatives->sum(function($item) {
            return pow($item->value, 2);
        });
        $pembagi = sqrt($sumOfSquares);
        $normalizedWeight = $weightValues->firstWhere('criteria_id', $criteria_id)->weight / $totalWeight;
        $aPositif = null;
        $aNegatif = null;
    @endphp

    @foreach($alternatives as $alternative)
        @php
            $normalizedValue = $alternative->value / $pembagi;
            $weightedNormalizedValue = $normalizedValue * $normalizedWeight;
            $weightedNormalizedValues[$alternative->alternative_id][$criteria_id] = $weightedNormalizedValue;

            $criteria = $criterias->where('id', $criteria_id)->first();
            if ($criteria->description == 'Benefit') {
                if ($aPositif === null || $weightedNormalizedValue > $aPositif) {
                    $aPositif = $weightedNormalizedValue;
                }
                if ($aNegatif === null || $weightedNormalizedValue < $aNegatif) {
                    $aNegatif = $weightedNormalizedValue;
                }
            } elseif ($criteria->description == 'Cost') {
                if ($aPositif === null || $weightedNormalizedValue < $aPositif) {
                    $aPositif = $weightedNormalizedValue;
                }
                if ($aNegatif === null || $weightedNormalizedValue > $aNegatif) {
                    $aNegatif = $weightedNormalizedValue;
                }
            }
        @endphp
    @endforeach

    @php
        $aPositifs[$criteria_id] = $aPositif;
        $aNegatifs[$criteria_id] = $aNegatif;
    @endphp
@endforeach

@php
    $distances = [];
@endphp

@foreach($alternatives as $alternative)
    @php
        $dPositif = sqrt(
            array_sum(array_map(function($criteria_id) use ($weightedNormalizedValues, $aPositifs, $alternative) {
                return pow($aPositifs[$criteria_id] - $weightedNormalizedValues[$alternative->alternative_id][$criteria_id], 2);
            }, array_keys($aPositifs)))
        );

        $dNegatif = sqrt(
            array_sum(array_map(function($criteria_id) use ($weightedNormalizedValues, $aNegatifs, $alternative) {
                return pow($aNegatifs[$criteria_id] - $weightedNormalizedValues[$alternative->alternative_id][$criteria_id], 2);
            }, array_keys($aNegatifs)))
        );

        $V = $dPositif + $dNegatif > 0 ? $dNegatif / ($dNegatif + $dPositif) : 0;

        $Vs[$alternative->alternative_id] = $V;
        $distances[$alternative->alternative_id] = ['dPositif' => $dPositif, 'dNegatif' => $dNegatif, 'V' => $V];
    @endphp
@endforeach

@foreach($Vs as $alternative_id => $V)
    @php
        Ranking::updateOrCreate(
            ['alternative_id' => $alternative_id, 'id_user' => Auth::id()],
            ['result_cal' => $V]
        );
    @endphp
@endforeach

@php
    $existingRankings = Ranking::where('id_user', Auth::id())->pluck('result_cal', 'alternative_id')->toArray();

    arsort($Vs);
    $rank = 1;
@endphp

@foreach($Vs as $alternative_id => $V)
    @php
        $ranking = Ranking::where('id_user', Auth::id())->where('alternative_id', $alternative_id)->first();
        if ($ranking) {
            if ($ranking->result_cal != $V || $ranking->result_rank != $rank) {
                $ranking->result_cal = $V;
                $ranking->result_rank = $rank;
                $ranking->save();
            }
        } else {
            $ranking = new Ranking;
            $ranking->alternative_id = $alternative_id;
            $ranking->id_user = Auth::id();
            $ranking->result_cal = $V;
            $ranking->result_rank = $rank;
            $ranking->save();
        }
        $rank++;
    @endphp
@endforeach

@php
    $rankings = Ranking::where('id_user', Auth::id())->orderBy('result_rank')->get();

    $rankedAlternatives = $rankings->map(function ($ranking) {
        return [
            'alternative' => Alternative::find($ranking->alternative_id),
            'result_cal' => $ranking->result_cal,
            'result_rank' => $ranking->result_rank,
        ];
    });
@endphp





<!DOCTYPE html>
<html lang="en">

@extends('users.pages.input-matrix.assets.style')

<body class="body-fixed">
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

    <!-- Modal -->
        @if ($rankedAlternatives->isNotEmpty())
            <div class="bg-pattern bg-light repeat-img"
                style="background-image: url(assets/images/blog-pattern-bg.png);">
                <section class="blog-sec section" id="blog">
                    <div class="sec-wp">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="sec-title text-center mb-5">
                                        <p class="sec-sub-title mb-3">Coffee Shop</p>
                                        <h2 class="h2-title">Hasil Rekomendasi Kafe Pilihan di Kota Blitar Berdasarkan Kriteria Anda</span></h2>
                                        <div class="sec-title-shape mb-4">
                                            <img src="assets/images/title-shape.svg" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @php
                                $rankedAlternatives = $rankedAlternatives->sortBy('result_rank');
                            @endphp

                            <div class="row">
                                @foreach ($rankedAlternatives as $rankedAlternative)
                                <div class="col-lg-4">
                                    <div class="blog-box">
                                        <div class="blog-img back-img"
                                            style="background-image: url({{ asset('storage/' . $rankedAlternative['alternative']->image) }});"></div>
                                        <div class="blog-text">
                                            <p class="blog-date">Rekomendasi : {{$rankedAlternative['result_rank']}}</p>
                                            <a href="#" class="h4-title">{{$rankedAlternative['alternative']->alternative_name}}</a>
                                            <p>{{$rankedAlternative['alternative']->description}}</p>
                                            <a href="{{$rankedAlternative['alternative']->location}}" class="sec-btn">Location</a>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        
                    </div>
                    @else
                </section>

                <p>No rankings found.</p>
            @endif

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






    @include('users.layouts.script')

    @if(request()->query('showModal') == 'true')
    <script>
        $(document).ready(function() {
            $('#questionModal').modal('show');
        });

        document.getElementById('belumPernahBtn').addEventListener('click', function() {
            $('#questionModal').modal('hide');
            $('#questionModal').on('hidden.bs.modal', function() {
                $('#detailModal').modal('show');
                $(this).off('hidden.bs.modal');
            });
        });

        document.getElementById('yaBtn').addEventListener('click', function() {
            $('#detailModal').modal('hide');
            $('#detailModal').on('hidden.bs.modal', function() {
                window.location.href = "#portfolio";
                $(this).off('hidden.bs.modal');
            });
        });
    </script>
@endif


</body>

</html>