<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Money extends Model
{
    use HasFactory;
    protected $table = 'money';
    protected $fillable = ['emissionId','scwpmId','kuphurId','serieId','tertipId','printPlace','value','cilValue','tValue','size','tedavulDate','lastDate','zortedDate','timeoutDate','expiryDate','frontColor','backColor','frontImage','backImage','link','desc','status','emissionId','scwpmId','kuphurId','serieId','tertipId','printPlace'];

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

    public function emission(){
        return $this->belongsTo(Emission::class, 'emissionId');
    }

    public function scwpm(){
        return $this->belongsTo('App\Models\Scwpm'::class, 'scwpmId');
    }

    public function kuphur(){
        return $this->belongsTo('App\Models\Kuphur'::class, 'kuphurId');
    }

    public function serie(){
        return $this->belongsTo('App\Models\Serie'::class, 'serieId');
    }

    public function tertip(){
        return $this->belongsTo('App\Models\Tertip'::class, 'tertipId');
    }

    public function printPlace(){
        return $this->belongsTo('App\Models\PrintPlace'::class, 'printPlace');
    }

    public function collection()
    {
        return $this->hasMany('App\Models\Collection'::class, 'moneyId');
    }
}
