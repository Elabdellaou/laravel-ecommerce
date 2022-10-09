<?php

namespace App\Http\Controllers;

use App\Models\TrailerType;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class TrailerTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $TT=TrailerType::all();
        return view('trailertype',compact('TT'));
    }
    public function validation($d){
        return $d->validate([
            'name'=>'string|required',
            'active'=>'boolean',
        ]);
    }
    public function store(Request $r){
        return response()->json(TrailerType::create($this->validation($r)));
    }
    public function show($id){
        return response()->json(TrailerType::find($id));
    }
    public function update(Request $r){
        TrailerType::find($r->id)->update($this->validation($r));
        return response()->json(Arr::prepend($this->validation($r),$r->id,'id'));
    }
    public function delete($id){
        return response()->json(TrailerType::find($id)->delete());
    }
}
