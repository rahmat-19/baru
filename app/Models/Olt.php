<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Olt extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_sto',
        'hostname',
    ];
    protected $with = ['stos'];
    protected $appends = ['total_slots'];


    public function getTotalAttribute()
    {
        return $this->slots->count();
    }

    public function slots()
    {
        return $this->hasMany(Slot::class, 'id_olt');
    }

    public function stos()
    {
        return $this->belongsTo(sto::class, 'id_sto', 'id');
    }
}
