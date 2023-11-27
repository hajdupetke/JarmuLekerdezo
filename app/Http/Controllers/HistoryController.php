<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
class HistoryController extends Controller
{
    public function index() {

        if(!auth()->check()){
            Session::put('redirectedFrom', 'history.index');

            return redirect()->route('login');
        }

        $user = Auth::user();
        $history = $user->searchHistory()->simplePaginate(10);
        $vehicles = Vehicle::all();
        return view('history.index', [
            'history' => $history,
            'vehicles' => $vehicles
        ]);
    }
}
