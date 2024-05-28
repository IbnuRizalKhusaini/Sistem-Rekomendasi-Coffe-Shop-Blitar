<!DOCTYPE html>
<html lang="en">

<head>
@include('admin.layouts.head')
</head>

<body>
@include('admin.layouts.header')
@include('admin.layouts.sidebar')
<main id="main" class="main">
<section class="section">
<div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <div class="row">
                                <div class="col">
                                    <h6>Input Data Alternatif</h6>
                                </div>
                            </div>
                        </div>

                        <div class="card-header pb-0">
                            <div class="row">
                                <div class="col">
                                    <!-- Start Form -->
                                    <form action="{{ route('admin.alternatives.update', $alternative->id) }}"
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                            <label for="alternative_code" class="form-label">Kode Alternatif</label>
                                            <input type="text" name="alternative_code" id="alternative_code"
                                                class="form-control" placeholder="Masukkan Kode Alternatif"
                                                value="{{ $alternative->alternative_code }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="alternative_name" class="form-label">Nama Alternatif</label>
                                            <input type="text" name="alternative_name" id="alternative_name"
                                                class="form-control" placeholder="Masukkan Nama Alternatif"
                                                value="{{ $alternative->alternative_name }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="description" class="form-label">Deskripsi</label>
                                            <input type="text" name="description" id="description"
                                                class="form-control" placeholder="Masukkan Deskripsi"
                                                value="{{ $alternative->description }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="location" class="form-label">Link Lokasi</label>
                                            <input type="text" name="location" id="location"
                                                class="form-control" placeholder="Masukkan Link Lokasi"
                                                value="{{ $alternative->location }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="image" class="form-label">Foto</label>
                                            <input type="file" id="image" name="image" class="form-control">
                                            <img src="{{ asset('storage/' . $alternative->image) }}"
                                                alt="Alternative Image" class="img-thumbnail"
                                                style="max-width: 500px; margin-top: 10px;">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <button type="button" onclick="history.back()" class="btn btn-danger">Kembali</button>
                                    </form>
                                    <!-- End Form -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
</main>

@include('admin.layouts.footer')

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

@include('admin.layouts.script')

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
