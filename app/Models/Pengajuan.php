<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_port',
        'id_user',
        'label',
        'jenisPembangunan',
        'izin',
        'keterangan',
    ];

    protected $with = ['users', 'olt_ports'];

    public function users()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
    public function olt_ports()
    {
        return $this->belongsTo(oltPort::class, 'id_port', 'id');
    }
}
