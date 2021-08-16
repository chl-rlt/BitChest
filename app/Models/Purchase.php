<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = ['quantity', 'price_bought', 'bought_at'];

    public function users(){
        return $this->hasOne(User::class);
    }
}
