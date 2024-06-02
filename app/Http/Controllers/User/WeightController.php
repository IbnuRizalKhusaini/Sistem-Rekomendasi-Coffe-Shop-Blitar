<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Alternative;
use App\Models\Criteria;
use App\Models\Ranking;
use App\Models\WeightValue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class WeightController extends Controller
{
    public function index()
    {
        // Ambil semua kriteria dari database
        $criterias = Criteria::all();
        $user = Auth::user();

        // Get user-specific weight values from the database
        $userWeights = WeightValue::where('user_id', $user->id)->pluck('weight', 'criteria_id');

        // Hitung jumlah kriteria
        $totalCriteria = count($criterias);

        if ($totalCriteria == 0) {
            return view('user.pages.input-weight.index', compact('criterias'));
        }

        // Inisialisasi array untuk menyimpan hasil perhitungan bobot ROC

        $weightValue = []; // Inisialisasi array nilai bobot

        // Hitung bobot ROC untuk setiap kriteria
        foreach ($criterias as $criteria) {
            // Dapatkan bobot khusus pengguna atau default pada bobot kriteria
            $criteriaWeight = $userWeights->get($criteria->id, $criteria->weight);

            // Hitung peringkat prioritas
            $weightRanking = 1;
            foreach ($criterias as $otherCriteria) {
                $otherCriteriaWeight = $userWeights->get($otherCriteria->id, $otherCriteria->weight);
                if ($criteriaWeight < $otherCriteriaWeight) {
                    $weightRanking++;
                }
            }

            // Hitung bobot ROC berdasarkan peringkat prioritas
            $weightROC = 0;
            for ($i = 1; $i <= count($criterias); $i++) {
                if ($weightRanking <= $i) {
                    $weightROC += 1 / $i;
                }
            }

            // Simpan bobot ROC dalam larik
            $weightValue[$criteria->id] = $weightROC / count($criterias);
        }
        // Ambil semua data alternatif dari database
        $alternatives = Alternative::all();

        // Kirim data kriteria dan hasil perhitungan bobot ROC ke view
        return view('user.pages.input-weight.index', compact('criterias', 'weightValue', 'alternatives'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'values' => 'required|array',
            'values.*' => 'required|numeric|min:1|max:100',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        foreach ($request->values as $criteria_id => $weight) {
            $criteria = Criteria::find($criteria_id);

            if ($criteria) {
                $criteria->weight = $weight;
                $criteria->save();
            }
        }

        return redirect()->route('user.result.index')->with('success', 'Bobot berhasil diperbarui.');
    }

    public function update(Request $request, $criteria_id)
    {
        $request->validate([
            'weight' => 'required|numeric|min:1|max:100',
        ]);

        // Temukan kriteria berdasarkan ID
        $criteria = Criteria::findOrFail($criteria_id);

        // Perbarui bobot
        $criteria->update([
            'weight' => $request->weight,
        ]);

        return redirect()->route('user.result.index')->with('success', 'Data kriteria berhasil disimpan.');
    }


    public function edit($criteria_id)
    {
        $criteria = Criteria::findOrFail($criteria_id);
        return view('user.pages.input-weight.edit', compact('criteria'));
    }

    public function destroy(Criteria $criteria)
    {
        $criteria->delete();
        return redirect()->route('user.weight.index')->with('success', 'Data kriteria berhasil dihapus.');
    }
}
