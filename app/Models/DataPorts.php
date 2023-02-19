<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPorts extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    protected $with = ['users'];

    public function olt_ports()
    {
        return $this->belongsTo(oltPort::class, 'id_port', 'id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
