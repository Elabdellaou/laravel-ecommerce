<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class CityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $city=DB::table('cities')->select('id','name','position','active')->orderBy('name')->simplePaginate(10);
        $country=DB::select('select id,name from countries where active=?',[1]);
        return view('city',compact('city','country'));
    }
    public function validation($d){
        return $d->validate([
            'name'=>'string|required',
            'position'=>'string|required',
            'country_id'=>'integer|required',
            'active'=>'boolean',
        ]);
    }
    public function search($name){
        $data=DB::table('cities')->select('id','name','position','active')->orderBy('name')->simplePaginate(10);
        if($name!='Etoile')
            $data=DB::select("select id,name,position,active from `cities` where name LIKE '%".$name."%'");

            //dd($data);
        return response()->json($data);
    }
    public function update_active($id ,$active){
        if($active==true||$active==false)
        return response()->json(City::find($id)->update(['active'=>$active]));
        else
        return response()->json(['error'=>'Not boolean']);
    }
    public function store(Request $r){
        return response()->json(City::create($this->validation($r)));
    }
    public function show($id){
        return response()->json(City::find($id));
    }
    public function update(Request $r){
        City::find($r->id)->update($this->validation($r));
        return response()->json(Arr::prepend($this->validation($r),$r->id,'id'));
    }
    public function delete($id){
        return response()->json(City::find($id)->delete());
    }
}
