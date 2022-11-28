<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sto extends Model
{
    use HasFactory;
    protected $fillable = [
        'slug',
        'kota',
    ];


    public function olts()
    {
        return $this->hasMany(Olt::class);
    }
}
