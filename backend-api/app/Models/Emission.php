<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emission extends Model
{
    use HasFactory;
    protected $table = "emissions";
    protected $fillable =['title','status'];
    public $timestamps = false;
}
