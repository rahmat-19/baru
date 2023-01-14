<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class oltPort extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_slot',
        'port_number',
        'penggunaan',
    ];

    // protected $with = ['olts'];

    public function slots()
    {
        return $this->belongsTo(Slot::class, 'id_slot', 'id');
    }


    // public function users()
    // {
    //     return $this->belongsToMany(User::class, 'pengajuans', 'id_port', 'id_user')->withTimestamps();
    // }
}
