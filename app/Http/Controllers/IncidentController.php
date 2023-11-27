<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Incident;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Carbon;


class IncidentController extends Controller
{
    //Show incident
    public function show(Incident $incident) {
        if(!auth()->check()){
            Session::put('redirectedFrom', 'incidents.show');

            return redirect()->route('login');
        }

        if(auth()->user()->is_premium != 1){
            return abort(403, 'Nem vagy prémium felhasználó 💸');
        }

        return view('incidents.show', [
            'incident' => $incident,
            'vehicles' => $incident->vehicles,
        ]);
    }

    public function create() {
        if(!auth()->check()){
            Session::put('redirectedFrom', 'incidents.create');

            return redirect()->route('login');
        }

        if(auth()->user()->is_admin != 1){
            return abort(403, 'Nem rendelkezel adminisztrátori joggal 👨🏼‍⚖️');
        }

        $vehicles = Vehicle::all();
        return view('incidents.create', ['vehicles' => $vehicles]);
    }

    public function store(Request $request) {
        if(!auth()->check()){
            Session::put('redirectedFrom', 'incidents.create');

            return redirect()->route('login');
        }

        if(auth()->user()->is_admin != 1){
            return abort(403, 'Nem rendelkezel adminisztrátori joggal 👨🏼‍⚖️');
        }
        $request->validate([
            'location' => 'required|min:5|max:50',
            'time' => 'required|before:' . Carbon::now(),
            'desc' => 'max:250',
            'vehicles' => 'required|array|min:1'
        ], [
            'required' => 'Ezt muszáj kitölteni... 🙄',
            'min' => 'Túl rövid xd',
            'max' => 'Túl hosszú 😳',
            'vehicles.min' => 'Legalább egy járműnek kell lennie a balesetben',
            'before' => 'Jövőben élsz dude? 😤',
        ]);

        $vehicles = Vehicle::whereIn('license', $request->vehicles)->get();

        $incident = Incident::create([
            'location'=> $request->location,
            'time'=> $request->time,
            'desc'=> $request->desc,
        ]);

        $incident->vehicles()->attach($vehicles);


        return redirect()->route('incidents.show', [
            'incident' => $incident,
            'vehicles' => $vehicles,
        ]);
    }

    public function edit(Incident $incident) {
        if(!auth()->check()){
            Session::put('redirectedFrom', 'incidents.edit');

            return redirect()->route('login');
        }

        if(auth()->user()->is_admin != 1){
            return abort(403, 'Nem rendelkezel adminisztrátori joggal 👨🏼‍⚖️');
        }

        $vehicles = Vehicle::all();
        return view('incidents.edit', [
            'vehicles' => $vehicles,
            'incident' => $incident,
        ]);
    }

    public function update(Incident $incident, Request $request) {
        if(!auth()->check()){
            Session::put('redirectedFrom', 'incidents.edit');

            return redirect()->route('login');
        }

        if(auth()->user()->is_admin != 1){
            return abort(403, 'Nem rendelkezel adminisztrátori joggal 👨🏼‍⚖️');
        }

        $request->validate([
            'location' => 'min:5|max:50',
            'time' => 'before:' . Carbon::now(),
            'desc' => 'max:250',
            'vehicles' => 'array|min:1'
        ], [
            'required' => 'Ezt muszáj kitölteni... 🙄',
            'min' => 'Túl rövid xd',
            'max' => 'Túl hosszú 😳',
            'vehicles.min' => 'Legalább egy járműnek kell lennie a balesetben',
            'before' => 'Jövőben élsz dude? 😤',
        ]);

        $vehicles = Vehicle::whereIn('license', $request->vehicles)->get();

        if($request->location != null) {
            $incident->location = $request->location;
        }

        if($request->time != null) {
            $incident->time = $request->time;
        }

        if($request->desc != null) {
            $incident->desc = $request->desc;
        }

        $incident->vehicles()->sync($vehicles);
        $incident->save();

        return redirect()->route('incidents.show', [
            'vehicles' => $vehicles,
            'incident' => $incident,
        ]);
    }

    public function destroy(Incident $incident) {
        if(!auth()->check()){
            Session::put('redirectedFrom', 'incidents.edit');

            return redirect()->route('login');
        }

        if(auth()->user()->is_admin != 1){
            return abort(403, 'Nem rendelkezel adminisztrátori joggal 👨🏼‍⚖️');
        }

        $incident->delete();
        return redirect()->route('home');
    }
}
