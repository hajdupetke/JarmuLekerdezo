<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\User;


class UserController extends Controller
{
    public function index() {
        if(!auth()->check()){
            Session::put('redirectedFrom', 'vehicles.create');

            return redirect()->route('login');
        }

        if(auth()->user()->is_admin != 1){
            return abort(403, 'Nem rendelkezel adminisztrátori joggal 👨🏼‍⚖️');
        }

        $users = User::simplePaginate(10);

        return view('users.index', ['users' => $users]);
    }

    public function update(User $user) {
        if(!auth()->check()){
            Session::put('redirectedFrom', 'vehicles.create');

            return redirect()->route('login');
        }

        if(auth()->user()->is_admin != 1){
            return abort(403, 'Nem rendelkezel adminisztrátori joggal 👨🏼‍⚖️');
        }
        $user->is_premium = !$user->is_premium;
        $user->save();

        return redirect()->route('users.index');
    }

}
