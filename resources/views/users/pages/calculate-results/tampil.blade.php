@php
    use Illuminate\Support\Facades\Auth;
    use App\Models\Ranking;
    use App\Models\Alternative;

    // Mengambil data ranking untuk user yang sedang login
    $rankings = Ranking::where('id_user', Auth::id())->orderBy('result_rank')->get();

    // Mengambil data alternatif berdasarkan ranking
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

@include('users.layouts.head')

<body class="body-fixed">
    <!-- start of header  -->
    @include('users.layouts.navbar')
    <!-- header ends  -->

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
                                        <h2 class="h2-title">Kafe Pilihan di Kota Blitar</span></h2>
                                        <div class="sec-title-shape mb-4">
                                            <img src="assets/images/title-shape.svg" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                @foreach ($rankedAlternatives as $rankedAlternative)
                                <div class="col-lg-4">
                                    <div class="blog-box">
                                        <div class="blog-img back-img"
                                            style="background-image: url({{ asset('storage/' . $rankedAlternative['alternative']->image) }});"></div>
                                        <div class="blog-text">
                                            <!-- <p class="blog-date">Jl. S. Supriadi No.56, Bendogerit, Kec. Sananwetan</p> -->
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
            @include('users.layouts.footer')






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