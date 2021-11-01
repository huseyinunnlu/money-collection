<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;
    protected $table = 'collections';
    protected $fillable = ['userId','moneyId'];
    public $timestamps = false;

    public function user()
    {
        return $this->hasOne('App\Models\User'::class, 'id');
    }
}
