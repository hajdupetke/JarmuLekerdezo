<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use App\Models\Vehicle;
use App\Models\SearchHistory;


class VehicleController extends Controller
{
    public function search(Request $request) {
        if(!auth()->check()){
            Session::put('redirectedFrom', 'home');
            return redirect()->route('login');
        }

        $request->validate([
            'license' => 'required|regex:/[a-z]{3}-{0,1}[0-9]{3}/i',
        ], [
            'license' => 'Nem jó rendszám'
        ]);

        $query = $request->license;
        $licenseText =  strtoupper(substr($query, 0, 3));
        $licenseNumber = '';
        if(strlen($query) == 6) {
            $licenseNumber = substr($query, 3, 3);
        } else if(strlen($query) == 7) {
            $licenseNumber = substr($query, 4, 3);
        }
        $license = $licenseText . '-' . $licenseNumber;
        
        try {
            $vehicle = Vehicle::where('license', 'LIKE', $license)->firstOrFail();
            $user = auth()->user();
            $searchHistory = new SearchHistory();
            $searchHistory->searched_license = $license;
            $user->searchHistory()->save($searchHistory);
            
            return redirect()->route('vehicles.show', $vehicle);
        } catch(ModelNotFoundException $e) {
            return view('missing');
        }
    }
    public function show(Vehicle $vehicle) {
        if(!auth()->check()){
            Session::put('redirectedFrom', 'home');

            return redirect()->route('login');
        }
        $imageSrc = (substr($vehicle->image, 0, 4) == 'http') ? $vehicle->image : asset('storage/images/' . $vehicle->image);
    
        $incidents = $vehicle->incidents->sortByDesc('time');
        return view('vehicles.show', [
            'vehicle' => $vehicle,
            'incidents' => $incidents,
            'imageSrc' => $imageSrc
        ]);
    }

    public function create() {
        if(!auth()->check()){
            Session::put('redirectedFrom', 'vehicles.create');

            return redirect()->route('login');
        }

        if(auth()->user()->is_admin != 1){
            return abort(403, 'Nem rendelkezel adminisztrátori joggal 👨🏼‍⚖️');
        }

        return view('vehicles.create');
    }

    public function store(Request $request) {
        if(!auth()->check()){
            Session::put('redirectedFrom', 'vehicles.create');

            return redirect()->route('login');
        }

        if(auth()->user()->is_admin != 1){
            return abort(403);
        }
        $request->validate([
            'license_plate' => 'required|unique:vehicles,license|regex:/[a-z]{3}-{0,1}[0-9]{3}/i|min:6|max:7',
            'brand' => 'required|min:3|max:15',
            'model' => 'required|min:2|max:50',
            'year' => 'required|digits:4|integer|min:1900|max:'.(date('Y')+2),
            'image' => 'required|image|max:4096'
        ], [
            'required' => 'Ezt muszáj kitölteni... 🙄',
            'min' => 'Túl rövid xd',
            'max' => 'Túl hosszú 😳',
            'year' => 'Nem valid az év dude 😤',
            'regex' => 'Nem megfelelő formátum 🫥',
            'image' => 'Nem kép faszim 👽',
            'unique' => 'Ez a rendszám már benne van a rendszerben 🧑🏿‍💻'
        ]);

        $file = $request->file('image');
        $image_hash_name = $file->hashName();
        Storage::disk('public')->put('images/' . $image_hash_name, $file->get());

        $licenseText =  strtoupper(substr($request->license_plate, 0, 3));
        $licenseNumber = '';
        if(strlen($request->license_plate) == 6) {
            $licenseNumber = substr($request->license_plate, 3, 3);
        } else if(strlen($request->license_plate) == 7) {
            $licenseNumber = substr($request->license_plate, 4, 3);
        }
        $license = $licenseText . '-' . $licenseNumber;

        $vehicle = Vehicle::create([
            'license' => $license,
            'brand' => $request->brand,
            'model' => $request->model,
            'year' => $request->year,
            'image' => $image_hash_name,
        ]);

        return redirect()->route('vehicles.show', ['vehicle' => $vehicle]);
    }

    public function edit(Vehicle $vehicle) {
        if(!auth()->check()){
            Session::put('redirectedFrom', 'vehicles.edit');

            return redirect()->route('login');
        }

        if(auth()->user()->is_admin != 1){
            return abort(403, 'Nem rendelkezel adminisztrátori joggal 👨🏼‍⚖️');
        }
        return view('vehicles.edit', ['vehicle' => $vehicle]);
    }

    public function update(Vehicle $vehicle, Request $request) {
        if(!auth()->check()){
            Session::put('redirectedFrom', 'vehicles.create');

            return redirect()->route('login');
        }

        if(auth()->user()->is_admin != 1){
            return abort(403, 'Nem rendelkezel adminisztrátori joggal 👨🏼‍⚖️');
        }
        $request->validate([
            'brand' => 'nullable|min:3|max:15',
            'model' => 'nullable|min:2|max:50',
            'year' => 'nullable|digits:4|integer|min:1900|max:'.(date('Y')+2),
            'image' => 'nullable|image|max:4096'
        ], [
            'required' => 'Ezt muszáj kitölteni... 🙄',
            'min' => 'Túl rövid xd',
            'max' => 'Túl hosszú 😳',
            'year' => 'Nem valid az év dude 😤',
            'image' => 'Nem kép faszim 👽'
        ]);

        if($request->brand != null) {
            $vehicle->brand = $request->brand;
        } 
        if($request->model != null) {
            $vehicle->model = $request->model;
        } 
        if($request->year != null) {
            $vehicle->year = $request->year;
        } 

        if($request->hasFile('image')) {
            Storage::disk('public')->delete('images/' . $vehicle->image);
            $file = $request->file('image');
            $image_hash_name = $file->hashName();
            $vehicle->image = $image_hash_name;
            Storage::disk('public')->put('images/' . $image_hash_name, $file->get());
            
        }
        $vehicle->save();
        return redirect()->route('vehicles.show', ['vehicle' => $vehicle]);

    }
}
