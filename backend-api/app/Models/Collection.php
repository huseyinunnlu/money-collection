<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;
    protected $table = 'collections';
    protected $fillable = ['userId','moneyId','uniqueSerie','price','date','purchasedPerson'];

    public function user()
    {
        return $this->hasOne('App\Models\User'::class, 'id','userId');
    }

    public function money()
    {
        return $this->hasOne('App\Models\Money'::class, 'id','moneyId');
    }

    public function images()
    {
        return $this->hasMany('App\Models\CollectionImage'::class, 'collection_id');
    }


}
