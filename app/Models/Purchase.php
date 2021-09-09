<?php

namespace App\Models;

use App\Models\User;
use App\Models\Market;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Purchase extends Model
{
    use HasFactory;

    // public $timestamps = false;

    protected $fillable = ['quantity', 'user_id', 'market_id', 'selling_price', 'status'];

    public function getCreatedAtAttribute($value) {
        return date('m-d-Y H:i:s',strtotime("$value"));
    }
    public function getUpdatedAtAttribute($value) {
        return date('m-d-Y H:i:s',strtotime("$value"));
    }

    public function scopeHolding($query) {
        return $query->where('status', 'holding');
    }
    public function scopeSold($query) {
        return $query->where('status', 'sold');
    }

    public function users(){
        return $this->hasOne(User::class);
    }

    public function market(){
        return $this->belongsTo(Market::class);
    }
}
