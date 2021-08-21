<?php

namespace App\Models;

use App\Models\User;
use App\Models\Market;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Purchase extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['quantity', 'bought_at', 'user_id', 'market_id'];

    public function setBoughtAtAttribute($value) {
        $this->attributes['bought_at'] = date('Y-m-d H:i:s',intval($value/1000));
    }

    public function users(){
        return $this->hasOne(User::class);
    }

    public function market(){
        return $this->belongsTo(Market::class);
    }
}
