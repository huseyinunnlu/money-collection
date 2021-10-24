<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kuphur extends Model
{
    use HasFactory;
    protected $table = "kuphurs";
    protected $fillable =['title','status'];
    public $timestamps = false;
}
