<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trailer extends Model
{
    use HasFactory;
    public $timestamps=false;

    protected $fillable=['id','numero','trailertype_id','volum'];
}
