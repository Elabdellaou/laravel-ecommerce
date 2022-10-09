<?php

namespace App\Http\Controllers;

use App\Models\Devise;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class DeviseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $devise=Devise::all();
        return view('devise',compact('devise'));
    }
    public function validation($d){
        return $d->validate([
            'name'=>'string|required|unique:devises,name',
            'divis'=>'required|string',
            'active'=>'boolean',
            'local'=>'boolean',
        ]);
    }
    public function store(Request $r){
        $d=Devise::create($this->validation($r));
        if($d->local==1)
            Devise::where('id','!=',$d->id)->update(['local'=>0]);
        $da=Devise::all();
        return response()->json($da);
    }
    public function show($id){
        return response()->json(Devise::find($id));
    }
    public function update(Request $r){
        Devise::where('id',$r->id)->update(['name'=>'ibrahim']);
        $d=Devise::find($r->id);
        if($d->local==1&&$r->local==0)
            Devise::where('id','<>',$d->id)->first()->update(['local'=>1]);
        else if($d->local==0&&$r->local==1)
            Devise::where('id','<>',$d->id)->update(['local'=>0]);
        else
            Devise::where('id',$r->d)->update(['local'=>$r->local]);
        $d->update($this->validation($r));
        return response()->json(Devise::all());
    }
    public function delete($id){
        $d=Devise::find($id);
        if($d->local==1)
            Devise::where('id','<>',$id)->first()->update(['local'=>1]);
        $d->delete();
        return response()->json(Devise::all());
    }
}
