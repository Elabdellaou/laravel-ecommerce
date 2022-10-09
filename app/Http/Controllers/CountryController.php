<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class CountryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $country=Country::all();
        return view('country',compact('country'));
    }
    public function validation($d){
        return $d->validate([
            'name'=>'string|required',
            'code'=>'string|required|regex:/^[a-z]{2}/i',
            'active'=>'boolean|required'
        ]);
    }
    public function store(Request $r){
        return response()->json(Country::create($this->validation($r)));
    }
    public function delete($id){
        return response()->json(Country::find($id)->delete());
    }
    public function show($id){
        return response()->json(Country::find($id));
    }
    public function update(Request $r){
        Country::where('id',$r->id)->update($this->validation($r));
        return response()->json(Arr::prepend($this->validation($r),$r->id,'id'));
    }
}

