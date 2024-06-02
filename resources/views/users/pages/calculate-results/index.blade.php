@php
    // Ambil semua entri weight_values dari database
    $weightValues = \App\Models\WeightValue::all();

    // Hitung total nilai weight
    $totalWeight = $weightValues->sum('weight');
@endphp

@php
    use Illuminate\Support\Facades\DB;

    // Ambil semua nilai alternatif dari database
    $alternatives = \App\Models\Alternative::all();

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

@php
    use App\Models\Criteria;
@endphp


{{-- <!DOCTYPE html>
<html>
<head>
    <title>Normalized Weights</title>
</head>
<body> --}}
     <!-- Menampilkan Normalized Weights -->
    <!-- Menampilkan Normalized Weights -->
    {{-- <h1>Normalized Weights</h1> --}}
    @if ($totalWeight > 0)
        {{-- <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User ID</th>
                    <th>Criteria ID</th>
                    <th>Weight</th>
                    <th>Normalized Weight</th>
                </tr>
            </thead>
            <tbody> --}}
                @foreach ($weightValues as $weightValue)
                    {{-- <tr>
                        <td>{{ $weightValue->id }}</td>
                        <td>{{ $weightValue->user_id }}</td>
                        <td>{{ $weightValue->criteria_id }}</td>
                        <td>{{ $weightValue->weight }}</td>
                        <td>{{ $weightValue->weight / $totalWeight }}</td>
                    </tr> --}}
                @endforeach
            {{-- </tbody>
        </table> --}}
    @else
        {{-- <p>No weights found.</p> --}}
    @endif

    <!-- Menampilkan Normalized Matrix dan Weighted Normalized Values (Y) -->
    {{-- <h1>Normalized Matrix and Weighted Normalized Values (Y)</h1> --}}
    @php
        $aPositifs = [];
        $aNegatifs = [];
        $weightedNormalizedValues = [];
        $Vs = [];
    @endphp
    @foreach($groupedData as $criteria_id => $alternatives)
        {{-- <h2>Criteria ID: {{ $criteria_id }}</h2> --}}
        <!-- Hitung Pembagi (sqrt(sum(alternative_value^2))) -->
        @php
            $sumOfSquares = $alternatives->sum(function($item) {
                return pow($item->value, 2);
            });
            $pembagi = sqrt($sumOfSquares);
            // Ambil nilai bobot yang sudah dinormalisasi untuk criteria_id
            $normalizedWeight = $weightValues->firstWhere('criteria_id', $criteria_id)->weight / $totalWeight;
            // Inisialisasi nilai aPositif dan aNegatif
            $aPositif = null;
            $aNegatif = null;
        @endphp

        {{-- <table border="1">
            <tr>
                <th>Alternative ID</th>
                <th>Original Value</th>
                <th>Normalized Value</th>
                <th>Weighted Normalized Value (Y)</th>
            </tr> --}}

            @foreach($alternatives as $alternative)
                @php
                    // Hitung nilai yang sudah dinormalisasi
                    $normalizedValue = $alternative->value / $pembagi;
                    // Hitung nilai Y
                    $weightedNormalizedValue = $normalizedValue * $normalizedWeight;
                    // Simpan nilai weightedNormalizedValue
                    $weightedNormalizedValues[$alternative->alternative_id][$criteria_id] = $weightedNormalizedValue;
                    // Jika deskripsi adalah Benefit
                    if ($criterias->where('id', $criteria_id)->first()->description == 'Benefit') {
                        // Cari nilai maksimum untuk aPositif
                        if ($aPositif === null || $weightedNormalizedValue > $aPositif) {
                            $aPositif = $weightedNormalizedValue;
                        }
                        // Cari nilai minimum untuk aNegatif
                        if ($aNegatif === null || $weightedNormalizedValue < $aNegatif) {
                            $aNegatif = $weightedNormalizedValue;
                        }
                    }
                    // Jika deskripsi adalah Cost
                    elseif ($criterias->where('id', $criteria_id)->first()->description == 'Cost') {
                        // Cari nilai minimum untuk aPositif
                        if ($aPositif === null || $weightedNormalizedValue < $aPositif) {
                            $aPositif = $weightedNormalizedValue;
                        }
                        // Cari nilai maksimum untuk aNegatif
                        if ($aNegatif === null || $weightedNormalizedValue > $aNegatif) {
                            $aNegatif = $weightedNormalizedValue;
                        }
                    }
                @endphp

                {{-- <tr>
                    <td>{{ $alternative->alternative_id }}</td>
                    <td>{{ $alternative->value }}</td>
                    <td>{{ $normalizedValue }}</td>
                    <td>{{ $weightedNormalizedValue }}</td>
                </tr> --}}
            @endforeach
        {{-- </table> --}}
        <!-- Menyimpan nilai aPositif dan aNegatif -->
        @php
            $aPositifs[$criteria_id] = $aPositif;
            $aNegatifs[$criteria_id] = $aNegatif;
        @endphp
        <!-- Menampilkan nilai aPositif dan aNegatif -->
        {{-- <p>aPositif for Criteria ID {{ $criteria_id }}: {{ $aPositif }}</p>
        <p>aNegatif for Criteria ID {{ $criteria_id }}: {{ $aNegatif }}</p> --}}
    @endforeach

    <!-- Menghitung dan Menampilkan Jarak dPositif dan dNegatif -->
    {{-- <h1>Distance to aPositif (dPositif) and aNegatif (dNegatif)</h1> --}}
    @php
        $distances = [];
    @endphp
    {{-- <table border="1">
        <thead>
            <tr>
                <th>Alternative ID</th>
                <th>dPositif</th>
                <th>dNegatif</th>
                <th>V</th>
            </tr>
        </thead>
        <tbody> --}}
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

                    // Menghitung nilai V
                    $V = $dPositif + $dNegatif > 0 ? $dNegatif / ($dNegatif + $dPositif) : 0;

                    // Menyimpan nilai V ke dalam array
                    $Vs[$alternative->alternative_id] = $V;

                    // Simpan jarak dan nilai V
                    $distances[$alternative->alternative_id] = ['dPositif' => $dPositif, 'dNegatif' => $dNegatif, 'V' => $V];
                @endphp
                {{-- <tr>
                    <td>{{ $alternative->alternative_id }}</td>
                    <td>{{ $dPositif }}</td>
                    <td>{{ $dNegatif }}</td>
                    <td>{{ $V }}</td>
                </tr> --}}
            @endforeach

            <!-- Menyimpan nilai V ke dalam database -->
            @foreach($Vs as $alternative_id => $V)
            @php
                // Mencari atau membuat instance dari model Ranking berdasarkan alternative_id dan id_user
                // Jika sudah ada, maka nilai result_cal akan diupdate, jika tidak, maka akan dibuat baru
                \App\Models\Ranking::updateOrCreate(
                    ['alternative_id' => $alternative_id, 'id_user' => Auth::id()],
                    ['result_cal' => $V]
                );
            @endphp
        @endforeach
        

<!-- Menampilkan Ranking -->
{{-- <h1>Ranking</h1> --}}
{{-- <table border="1"> --}}
    {{-- <thead>
        <tr>
            <th>Alternative ID</th>
            <th>Result (V)</th>
            <th>Rank</th>
        </tr>
    </thead> --}}
    {{-- <tbody> --}}
        @php
            use Illuminate\Support\Facades\Auth;
            use App\Models\Ranking;

            // Mengambil data V dan ranking yang sudah ada untuk user_id tertentu
            $existingRankings = Ranking::where('id_user', Auth::id())->pluck('result_cal', 'alternative_id')->toArray();
            
            // Mengurutkan alternatif berdasarkan nilai V dari yang terbesar
            arsort($Vs);
            $rank = 1;
        @endphp
        @foreach($Vs as $alternative_id => $V)
            @php
                // Periksa apakah V sudah tersimpan dan apakah nilainya sama
                $ranking = Ranking::where('id_user', Auth::id())->where('alternative_id', $alternative_id)->first();
                if ($ranking) {
                    // Update nilai V dan rank hanya jika ada perubahan
                    if ($ranking->result_cal != $V || $ranking->result_rank != $rank) {
                        $ranking->result_cal = $V;
                        $ranking->result_rank = $rank;
                        $ranking->save();
                    }
                } else {
                    // Simpan nilai V dan rank ke database jika belum ada
                    $ranking = new Ranking;
                    $ranking->alternative_id = $alternative_id;
                    $ranking->id_user = Auth::id();
                    $ranking->result_cal = $V;
                    $ranking->result_rank = $rank;
                    $ranking->save();
                }
            @endphp
            {{-- <tr>
                <td>{{ $alternative_id }}</td>
                <td>{{ $V }}</td>
                <td>{{ $rank }}</td>
            </tr> --}}
            @php
                $rank++;
            @endphp
        @endforeach
    {{-- </tbody> --}}
{{-- </table> --}}

{{-- </body> --}}
{{-- </html> --}}

@php

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