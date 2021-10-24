<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrintPlace extends Model
{
    use HasFactory;
    protected $table = "print_places";
    protected $fillable =['title','status'];
    public $timestamps = false;
}
