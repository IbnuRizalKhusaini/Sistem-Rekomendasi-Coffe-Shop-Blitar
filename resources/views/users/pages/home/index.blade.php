<!DOCTYPE html>
<html lang="en">

@include('users.layouts.head')

<body class="body-fixed">
    <!-- start of header  -->
    @include('users.layouts.navbar')
    <!-- header ends  -->

    <!-- Modal -->
    <div class="modal fade" id="questionModal" tabindex="-1" role="dialog" aria-labelledby="questionModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body"></div>
                <div class="modal-body"></div>
                <div class="modal-body text-center">
                    <img src="{{ asset('impact/assets/img/hero-img.svg') }}" class="img-fluid" alt=""
                        data-aos="zoom-out" data-aos-delay="100">
                    <p>Apakah anda sudah pernah pergi ke Coffee Shop yang ada di Kota Blitar ?</p>
                    <a href="{{ route('user.weight.index') }}" class="btn btn-primary">Ya Pernah</a>
                    <button type="button" id="belumPernahBtn" class="btn btn-danger" data-dismiss="modal">Belum
                        Pernah</button>
                </div>
                <div class="modal-body"></div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body"></div>
                <div class="modal-body"></div>
                <div class="modal-body text-center">
                    <img src="{{ asset('impact/assets/img/hero-img.svg') }}" class="img-fluid" alt=""
                        data-aos="zoom-out" data-aos-delay="100">
                    <p>Ingin melihat beberapa detail Coffee Shop di Kota Blitar terlebih dahulu ?</p>
                    <a href="#blog" id="yaBtn" class="btn btn-primary">Ya</a>
                    <a href="{{ route('user.home.index') }}" class="btn btn-primary">Tidak</a>
                </div>
                <div class="modal-body"></div>
            </div>
        </div>
    </div>

    <div id="viewport">
        <div id="js-scroll-content">
            <section class="main-banner" id="home">
                <div class="js-parallax-scene">
                    <div class="banner-shape-1 w-100" data-depth="0.30">
                        <img src="assets/images/coffee.png" alt="">
                    </div>
                    <div class="banner-shape-2 w-100" data-depth="0.25">
                        <img src="assets/images/leaf.png" alt="">
                    </div>
                </div>
                <div class="sec-wp">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="banner-text">
                                    <h1 class="h1-title">
                                        Udah tau
                                        <span>Kota Blitar</span>
                                        belum?
                                    </h1>
                                    <p>Kota Blitar, sebagai salah satu kota di Jawa Timur, memiliki ciri khas dan keunikan tersendiri. Sebagai kota yang kaya akan sejarah, Blitar menjadi destinasi yang menarik bagi wisatawan. Keberagaman budaya dan keindahan alamnya membuat Blitar menjadi tempat yang potensial untuk pertumbuhan industri kafe.</p>
                                    <div class="banner-btn mt-4">
                                        <a href="#desc" class="sec-btn">Artikel selanjutnya</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="banner-img-wp">
                                    <div class="banner-img" style="background-image: url(assets/images/blitar.jpeg);">
                                    </div>
                                </div>
                                <div class="banner-img-text mt-4 m-auto">
                                    <h5 class="h5-title">*Gong Perdamaian Dunia</h5>
                                    <p>Jl. Ir. Soekarno No.244, Bendogerit, Kec. Sananwetan, Kota Blitar, Jawa Timur 66113</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>


            <section class="desc-sec section" id="desc">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="sec-title text-center mb-5">
                                <!--<p class="sec-sub-title mb-3">About Us</p>-->
                                <h2 class="h2-title">Industri Coffee Shop (Kafe) <span>Kota Blitar</span></h2>
                                <div class="sec-title-shape mb-4">
                                    <img src="assets/images/title-shape.svg" alt="">
                                </div>
                                <p>Kepala Dinas Penanaman Modal Tenaga Kerja dan PTSP Kota Blitar, Suharyono mengatakan, kedai kopi yang saat ini berdiri di Kota Blitar menjadi daya tarik sendiri. Bahkan, pihaknya menyebut Kota Blitar sebagai “Kota 1.000 Kopi”, karena setiap kedai kopi menyuguhkan cita rasa yang berbeda-beda. Selain menjadi daya tarik warga luar kota Blitar, fenomena ini dinilai mampu menumbuhkan sektor perekonomian di Kota Blitar, termasuk berkurangnya angka pengangguran.</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 m-auto">
                            <div class="about-video">
                                <div class="about-video-img" style="background-image: url(assets/images/desc.jpeg);">
                                </div>
                               
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            
            
            <!--
            <section class="book-table section bg-light">

                <div class="sec-wp">
                    <div class="container">

                        <div class="row" id="gallery">
                            <div class="col-lg-10 m-auto">
                                <div class="book-table-img-slider" id="icon">
                                    <div class="swiper-wrapper">
                                        <a href="assets/images/bt1.jpg" data-fancybox="table-slider"
                                            class="book-table-img back-img swiper-slide"
                                            style="background-image: url(assets/images/bt1.jpg)"></a>
                                        <a href="assets/images/bt2.jpg" data-fancybox="table-slider"
                                            class="book-table-img back-img swiper-slide"
                                            style="background-image: url(assets/images/bt2.jpg)"></a>
                                        <a href="assets/images/bt3.jpg" data-fancybox="table-slider"
                                            class="book-table-img back-img swiper-slide"
                                            style="background-image: url(assets/images/bt3.jpg)"></a>
                                        <a href="assets/images/bt4.jpg" data-fancybox="table-slider"
                                            class="book-table-img back-img swiper-slide"
                                            style="background-image: url(assets/images/bt4.jpg)"></a>
                                        <a href="assets/images/bt1.jpg" data-fancybox="table-slider"
                                            class="book-table-img back-img swiper-slide"
                                            style="background-image: url(assets/images/bt1.jpg)"></a>
                                        <a href="assets/images/bt2.jpg" data-fancybox="table-slider"
                                            class="book-table-img back-img swiper-slide"
                                            style="background-image: url(assets/images/bt2.jpg)"></a>
                                        <a href="assets/images/bt3.jpg" data-fancybox="table-slider"
                                            class="book-table-img back-img swiper-slide"
                                            style="background-image: url(assets/images/bt3.jpg)"></a>
                                        <a href="assets/images/bt4.jpg" data-fancybox="table-slider"
                                            class="book-table-img back-img swiper-slide"
                                            style="background-image: url(assets/images/bt4.jpg)"></a>
                                    </div>

                                    <div class="swiper-button-wp">
                                        <div class="swiper-button-prev swiper-button">
                                            <i class="uil uil-angle-left"></i>
                                        </div>
                                        <div class="swiper-button-next swiper-button">
                                            <i class="uil uil-angle-right"></i>
                                        </div>
                                    </div>
                                    <div class="swiper-pagination"></div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>

            </section>
            -->

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
                                @foreach ($alternatives as $alternative)
                                <div class="col-lg-4">
                                    <div class="blog-box">
                                        <div class="blog-img back-img"
                                            style="background-image: url({{ asset('storage/' . $alternative->image) }});"></div>
                                        <div class="blog-text">
                                            <!-- <p class="blog-date">Jl. S. Supriadi No.56, Bendogerit, Kec. Sananwetan</p> -->
                                            <a href="#" class="h4-title">{{$alternative->alternative_name}}</a>
                                            <p>{{$alternative->description}}</p>
                                            <a href="{{$alternative->location}}" class="sec-btn">Location</a>
                                            <a href="{{route('user.alternative-values.edit', ['alternative_id' => $alternative -> id])}}" class="sec-btn">Rating</a>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <section class="about-sec section" id="about">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="sec-title text-center mb-5">
                                            <p class="sec-sub-title mb-3">About Us</p>
                                            <h2 class="h2-title">Apa itu <span>Sistem Rekomendasi?</span></h2>
                                            <div class="sec-title-shape mb-4">
                                                <img src="assets/images/title-shape.svg" alt="">
                                            </div>
                                            <p>Setelah melihat-lihat artikel diatas, ada banyak sekali kedai kopi yang ada di Kota Blitar. 
                                                Keberagaman tersebut justru dapat membuat konsumen kesulitan memilih kedai kopi yang sesuai dengan preferensi dan kebutuhan mereka. 
                                                Setiap orang memiliki pandangan yang berbeda terhadap coffee shop, mengingat adanya variasi menu kopi, harga, pelayanan, suasana, fasilitas, dan lain sebagainya yang diberikan. 
                                                Nah, disini sistem rekomendasi menjadi solusi efektif untuk membantu konsumen menemukan kafe yang sesuai dengan preferensi mereka. Dengan demikian, konsumen dapat lebih mudah menemukan kafe yang memenuhi harapan mereka. 
                                                <br><br><b>*Jika kalian bingung dalam menggunakan sistem rekomendasi ini, silahkan tonton video panduan dibawah*</b></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-8 m-auto">
                                        <div class="about-video">
                                            <div class="about-video-img" style="background-image: url(assets/images/about.jpeg);">
                                            </div>
                                            <div class="play-btn-wp">
                                                <a href="assets/images/video.mp4" data-fancybox="video" class="play-btn">
                                                    <i class="uil uil-play"></i>
            
                                                </a>
                                                <span>Lihat Panduan Penggunaan Sistem Rekomendasi Ini</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>

                

            <!-- footer starts  -->
            @include('users.layouts.footer')



        </div>
    </div>





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