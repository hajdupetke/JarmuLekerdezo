<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Auth;
class HistoryController extends Controller
{
    public function index() {

        if(!auth()->check()){
            return redirect()->route('login');
        }

        $user = Auth::user();
        $history = $user->searchHistory()->simplePaginate(10);
        return view('history.index', [
            'history' => $history,
        ]);
    }
}
