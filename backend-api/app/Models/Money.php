<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Money extends Model
{
    use HasFactory;
    protected $table = 'money';
    protected $fillable = ['emission_id','scwpm_id','kuphur_id','serie_id','tertip_id','print_place_id','value','cilValue','tValue','size','tedavulDate','lastDate','zortedDate','timeoutDate','expiryDate','frontColor','backColor','frontImage','backImage','link','desc','status'];

    protected $appends = ['isCollected'];

    public function getIsCollectedAttribute()
    {
        if (Auth()->user()) {
            $user = $this->collection()->where('userId',Auth()->user()->id)->first();
            if ($user) {
                return true;
            }else{
                return false;
            }
        }else {
            return false;
        }
    }

    public function signature(){
        return $this->hasMany('App\Models\MoneySignatures'::class, 'moneyId');
    }

    public function emission_id(){
        return $this->belongsTo('App\Models\Emission'::class, 'emission_id');
    }

    public function scwpm_id(){
        return $this->belongsTo('App\Models\Scwpm'::class, 'scwpm_id');
    }

    public function kuphur_id(){
        return $this->belongsTo('App\Models\Kuphur'::class, 'kuphur_id');
    }

    public function serie_id(){
        return $this->belongsTo('App\Models\Serie'::class, 'serie_id');
    }

    public function tertip_id(){
        return $this->belongsTo('App\Models\Tertip'::class, 'tertip_id');
    }

    public function print_place_id(){
        return $this->belongsTo('App\Models\PrintPlace'::class, 'print_place_id');
    }

    public function collection()
    {
        return $this->hasMany('App\Models\Collection'::class, 'moneyId');
    }
}
