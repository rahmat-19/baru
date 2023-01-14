<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slot extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'id_olt'
    ];


    public function getTotalAttribute()
    {
        return $this->olt_ports->count();
    }

    public function olts()
    {
        return $this->belongsTo(Olt::class, 'id_olt', 'id');
    }
    public function olt_ports()
    {
        return $this->hasMany(oltPort::class, 'id_slot');
    }

    public function pengajuans()
    {
        return $this->hasMany(Pengajuan::class);
    }
}
