<?php

namespace App\Models;

use App\Models\Cryptocurrencie;
use App\Models\Date;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Market extends Model
{
    use HasFactory;

    protected $fillable = ['price'];

    public function cryptocurrencies() {
        $this->hasOne(Cryptocurrencie::class);
    }

    public function dates(){
        $this->hasOne(Date::class);
    }
}
