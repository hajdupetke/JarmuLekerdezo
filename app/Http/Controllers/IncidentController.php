<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Incident;

class IncidentController extends Controller
{
    //Show incident
    public function show(Incident $incident) {
        if(!auth()->check()){
            return redirect()->route('login');
        }

        if(auth()->user()->is_premium != 1){
            return abort(403);
        }

        return view('incidents.show', [
            'incident' => $incident,
            'vehicles' => $incident->vehicles,
        ]);
    }
}
