<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;

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
    public $incrementing = false;
    public function getRouteKeyName()
    {
        return 'id';
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
    public function slots()
    {
        return $this->belongsTo(Slot::class, 'id_slot', 'id');
    }
    public function olt_ports()
    {
        return $this->belongsTo(oltPort::class, 'port_id', 'id');
    }

    // public static function boot()
    // {
    //     parent::boot();
    //     self::creating(function ($model) {
    //         $model->uuid = IdGenerator::generate(['table' => 'pengajuans', 'length' => 6, ]);
    //     });
    // }


    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id = IdGenerator::generate(['table' => 'pengajuans', 'length' => 10, 'prefix' => 'FTTH-']);
        });
    }
}
