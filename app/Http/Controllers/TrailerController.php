<?php

namespace App\Http\Controllers;

use App\Models\Trailer;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class TrailerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $TT=DB::select('select trailers.id,trailers.numero,trailers.volum,trailers.trailertype_id,trailer_types.name as trailer from trailers,trailer_types where trailers.trailertype_id=trailer_types.id');
        $trailer=DB::select('select id ,name from trailer_types where active=?',[1]);
        return view('trailer',compact('TT','trailer'));
    }
    public function validation($d){
        return $d->validate([
            'numero'=>'string|required',
            'volum'=>'numeric|required',
            'trailertype_id'=>'numeric|required',
        ]);
    }
    public function store(Request $r){
        $d=Trailer::create($this->validation($r));
        return response()->json(DB::select('select trailers.id,trailers.numero,trailers.volum,trailers.trailertype_id,trailer_types.name as trailer from trailers,trailer_types where trailers.trailertype_id=trailer_types.id and trailers.id=?',[$d->id]));
    }
    public function delete($id){
        return response()->json(Trailer::find($id)->delete());
    }
    public function show($id){
        return response()->json(Trailer::find($id));
    }
    public function update(Request $r){
        Trailer::where('id',$r->id)->update($this->validation($r));
        $data=DB::select('select trailers.id,trailers.numero,trailers.volum,trailers.trailertype_id,trailer_types.name as trailer from trailers,trailer_types where trailers.trailertype_id=trailer_types.id and trailers.id=?',[$r->id]);
        return response()->json($data);
    }
}
