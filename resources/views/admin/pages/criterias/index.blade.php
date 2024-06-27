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
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">DATA KRITERIA</h5>
              <p>Kata kriteria adalah kata benda yang berarti “standar penilaian atau kritik.” Kriteria adalah aturan atau tolok ukur yang digunakan untuk menilai sesuatu</a>.</p>
              <div class="col-auto">
                                    <a href="#" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#addKriteriaModal">Input Data </a>
                                </div>

              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th><b>Code</b></th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($criterias as $criteria)
                    <tr>
                      <td>{{ $criteria->criteria_code }}</td>
                      <td>{{ $criteria->criteria_name }}</td>
                      <td>{{ $criteria->description }}</td>
                      <td>
                        <!-- Edit Button -->
                        <a href="{{ route('admin.criterias.edit', $criteria->id) }}" class="btn btn-primary btn-sm">
                          Edit
                        </a>
                        
                        <!-- Delete Button -->
                        
                          <form style="display:inline-block;"
                          action="{{ route('admin.criterias.destroy', $criteria->id) }}"
                          method="POST">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm('Anda yakin ingin menghapus data ini?')">Delete</button>
                        </form>
                        
                      </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
              <!-- End Table with stripped rows -->
            </div>
          </div>

        </div>
      </div>
</section>
</main>
@include('admin.pages.criterias.modal.addkriteria')
@include('admin.layouts.footer')

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

@include('admin.layouts.script')

</body>

</html>
