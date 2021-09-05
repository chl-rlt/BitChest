<?php

namespace App\Models;

use App\Models\Market;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cryptocurrencie extends Model
{
    use HasFactory;

    protected $fillable = ['name','logo', 'description', 'tag'];

    public $timestamps = false;

    public function markets(){
        return $this->hasMany(Market::class);
    }

}
