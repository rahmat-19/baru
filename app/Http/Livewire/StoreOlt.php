<?php

namespace App\Http\Livewire;

use App\Models\Olt;
use App\Models\sto;
use Livewire\Component;

class StoreOlt extends Component
{
    public $stos;
    public $merk = 'ZTE';
    public $number = 0;
    public $id_sto = 1;
    public $types = ['C320', 'C630'];
    public $type;
    public $hostname;

    protected $rules = [
        'hostname' => 'required',
        'id_sto' => 'required|integer',
        'merk' => 'required',
        'type' => 'required',
    ];

    public function mount()
    {
        $this->stos = sto::all();
    }



    public function save()
    {
        $dataValidate = $this->validate();
        $valid = Olt::create($dataValidate);

        return redirect(Route('olt.index'));
    }


    public function render()
    {
        return view('livewire.store-olt');
    }

    public function updatedMerk($merk)
    {
        switch ($merk) {
            case 'ZTE':
                $this->types = ['C320', 'C630'];
                $this->type = null;

                break;
            case 'HUAWEI':
                $this->types = ['MA5600T'];
                $this->type = null;
                break;
            case "FIBERHIOME":
                $this->types = ['AN5000', 'AN6000'];
                $this->type = null;
                break;
        }
    }
}
