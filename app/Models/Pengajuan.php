<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;
    protected $guarded = [
        'id'
    ];
    // protected $fillable = [
    //     'id_port',
    //     'id_user',
    //     'label',
    //     'jenisPembangunan',
    //     'izin',
    //     'keterangan',
    // ];

    protected $with = ['users', 'slots'];

    public function users()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
    public function slots()
    {
        return $this->belongsTo(Slot::class, 'id_slot', 'id');
    }
}
