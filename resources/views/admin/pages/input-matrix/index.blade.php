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
              <h5 class="card-title">DATA NILAI MATRIKS</h5>
              <p>Nilai matriks disini merupakan nilai untuk setiap kriteria pada setiap alternatif</a>.</p>
              <div class="col-auto">
                                    <a href="#" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#addMatrikModal">Input/Edit Nilai Alternatif </a>
                                </div>

              <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Kode Alternatif
                                            </th>
                                            @foreach ($criterias as $criteria)
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    {{ $criteria->criteria_code }}
                                                </th>
                                            @endforeach
                                            {{-- <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Aksi
                                            </th> --}}
                                            <th class="text-secondary opacity-7"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($alternatives as $alternative)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-3 py-1">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">
                                                                {{ $alternative->alternative_code }}
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                @foreach ($criterias as $criteria)
                                                    <td>
                                                        @php
                                                            $alternative_value = $alternative
                                                                ->alternative_values()
                                                                ->where('criteria_id', $criteria->id)
                                                                ->first();
                                                        @endphp
                                                        @if ($alternative_value)
                                                            <h6 class="text-xs font-weight-bold mb-0">
                                                                {{ $alternative_value->value }}</h6>
                                                        @else
                                                            <h6 class="text-xs font-weight-bold mb-0">-</h6>
                                                        @endif
                                                    </td>
                                                @endforeach
                                                {{-- <td class="align-middle" style="text-align: center;">
                                                    <div class="dropdown">
                                                        <button class="btn btn-link text-secondary mb-0 " type="button"
                                                            data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="fa fa-ellipsis-v text-xs"></i>
                                                        </button>
                                                        @foreach ($alternative_values as $alternative_value)
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <form action="{{ route('admin.alternative-values.destroy', $alternative_value->alternative_id) }}" method="post">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="dropdown-item">Delete</button>
                                                                </form>
                                                            </li>
                                                        </ul>
                                                    @endforeach
                                                    </div>
                                                </td> --}}
                                            </tr>
                                        @endforeach
                                        {{-- <td>
                                            <div class="d-flex px-3 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">Nilai Maksimal</h6>
                                                </div>
                                            </div>
                                        </td>
                                        @foreach ($criterias as $criteria)
                                            <td>
                                                <h6 class="text-xs font-weight-bold mb-0">
                                                    @php
                                                        $maxValue = \App\Models\AlternativeValue::where(
                                                            'criteria_id',
                                                            $criteria->id,
                                                        )->max('value');
                                                        echo $maxValue;
                                                    @endphp
                                                </h6>
                                            </td>
                                        @endforeach
                                        <tr>
                                            <td>
                                                <div class="d-flex px-3 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">Nilai Minimal</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            @foreach ($criterias as $criteria)
                                                <td>
                                                    <h6 class="text-xs font-weight-bold mb-0">
                                                        @php
                                                            $minValue = \App\Models\AlternativeValue::where(
                                                                'criteria_id',
                                                                $criteria->id,
                                                            )->min('value');
                                                            echo $minValue;
                                                        @endphp
                                                    </h6>
                                                </td>
                                            @endforeach --}}
                                        </tr>
                                    </tbody>
                                </table>
              
            </div>
          </div>

        </div>
      </div>
</section>
</main>
@include('admin.pages.input-matrix.modal.addmatrik')

@include('admin.layouts.footer')

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

@include('admin.layouts.script')

</body>

</html>
