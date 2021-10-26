<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MoneySignatures extends Model
{
    use HasFactory;
    protected $table = 'money_signatures';
    protected $fillable = ['moneyId','signatureId'];
    public $timestamps = false;

    public function name()
    {
        return $this->hasOne('App\Models\Signature'::class, 'id');
    }
}
