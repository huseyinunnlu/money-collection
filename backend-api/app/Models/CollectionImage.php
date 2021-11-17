<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollectionImage extends Model
{
    use HasFactory;
    protected $table = 'collection_images';
    protected $fillable = ['collection_id','image'];

    public $timestamps = false;
}
