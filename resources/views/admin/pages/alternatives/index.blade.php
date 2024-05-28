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
              <h5 class="card-title">Data Alternatif cok</h5>
              <p>iki alternatif</a>.</p>
              <div class="col-auto">
                                    <a href="#" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#addAlternatifModal">Input Data </a>
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
                    @foreach ($alternatives as $alternative)
                    <tr>
                      <td>{{ $alternative->alternative_code }}</td>
                      <td>{{ $alternative->alternative_name }}</td>
                      <td>{{ $alternative->description }}</td>
                      <td>
                        <!-- Edit Button -->
                        <a href="{{ route('admin.alternatives.edit', $alternative->id) }}" class="btn btn-primary btn-sm">
                          Edit
                        </a>
                        
                        <!-- Delete Button -->
                        <form action="{{ route('admin.alternatives.destroy', $alternative->id) }}" method="POST" style="display:inline-block;">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this alternative?');">
                            Delete
                          </button>
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

@include('admin.pages.alternatives.modal.addalternative')
@include('admin.layouts.footer')

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

@include('admin.layouts.script')

</body>

</html>
