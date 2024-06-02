<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Alternative;
use App\Models\Criteria;
use App\Models\Ranking;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $alternatives=Alternative::All();
        $criterias=Criteria::All();
        return view('users.pages.home.index', compact('alternatives', 'criterias'));
    }
    public function checkRankings()
    {
        if (Auth::guest()) {
            // Jika pengguna belum login, tetap arahkan ke halaman dengan modal
            return redirect()->route('user.home.index', ['showModal' => 'true']);
        }

        $userId = Auth::id(); // Ambil ID pengguna yang sedang login

        // Periksa apakah user_id ada di tabel rankings
        $rankingExists = Ranking::where('id_user', $userId)->exists();

        if ($rankingExists) {
            return redirect()->route('user.weight.index');
        } else {
            // Kembalikan tampilan dengan modal
            return redirect()->route('user.home.index', ['showModal' => 'true']);
        }
    }
}
