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
        'port',
        'keterangan',
    ];
    protected $with = ['stos'];

    public function olt_ports()
    {
        return $this->hasMany(oltPort::class, 'id_olt');
    }

    public function stos()
    {
        return $this->belongsTo(sto::class, 'id_sto', 'id');
    }
}
