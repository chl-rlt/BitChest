<?php

namespace App\Models;

use App\Models\Cryptocurrencie;
use App\Models\Date;
use App\Models\Purchase;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Market extends Model
{
    use HasFactory;

    protected $fillable = ['price', 'date', 'cryptocurrencie_id'];

    public $timestamps = false;

    public function cryptocurrencies() {
        return $this->belongsTo(Cryptocurrencie::class);
    }

    public function dates(){
        return $this->hasOne(Date::class);
    }

    public function purchases(){
        return $this->hasMany(Purchase::class);
    }
}
