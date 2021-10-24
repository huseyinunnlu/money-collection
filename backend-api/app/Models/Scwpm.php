<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scwpm extends Model
{
    use HasFactory;
    protected $table = "scwpms";
    protected $fillable =['title','status'];
    public $timestamps = false;
}
