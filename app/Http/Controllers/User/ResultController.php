<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Alternative;
use App\Models\AlternativeValue;
use App\Models\Criteria;
use App\Models\WeightValue;
use Illuminate\Support\Facades\Auth;
use App\Models\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResultController extends Controller
{
    public function index()
    {
        $criterias = Criteria::all();
        $alternatives = Alternative::all();
        $weightValues = WeightValue::all();

        // Ambil semua data dari AlternativeValue dan kelompokkan berdasarkan criteria_id
        $alternativeValues = AlternativeValue::all();
        $groupedData = $alternativeValues->groupBy('criteria_id');

        return view('users.pages.calculate-results.index', compact('criterias', 'alternatives', 'weightValues', 'groupedData'));
    }

    public function tampil()
    {
        return view('users.pages.calculate-results.tampil');
    }
}
