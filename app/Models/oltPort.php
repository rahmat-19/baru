<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class oltPort extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_olt',
        'port_number',
        'penggunaan',
    ];

    protected $with = ['olts'];

    public function olts()
    {
        return $this->belongsTo(Olt::class, 'id_olt', 'id');
    }
    public function pengajuans()
    {
        return $this->hasMany(Pengajuan::class);
    }

    // public function users()
    // {
    //     return $this->belongsToMany(User::class, 'pengajuans', 'id_port', 'id_user')->withTimestamps();
    // }
}
