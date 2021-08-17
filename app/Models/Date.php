<?php

namespace App\Models;

use App\Models\Market;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Date extends Model
{
    use HasFactory;

    protected $fillable = ['date'];
    public $timestamps = false;

    public function markets() {
        $this->belongsToMany(Market::class);
    }
}
