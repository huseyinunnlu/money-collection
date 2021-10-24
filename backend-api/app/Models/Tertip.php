<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tertip extends Model
{
    use HasFactory;
    protected $table = "tertips";
    protected $fillable =['title','status'];
    public $timestamps = false;
}
