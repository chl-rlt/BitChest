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

    protected $fillable = ['quantity', 'bought_at'];

    public function users(){
        return $this->hasOne(User::class);
    }

    public function market(){
        return $this->belongsTo(Market::class);
    }
}
