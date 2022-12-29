<?php

namespace Database\Seeders;

use App\Models\sto;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(1)->create();

        sto::create(
            [
                'slug' => 'BOO',
                'kota' => 'BOGOR'
            ]
        );
        sto::create(
            [
                'slug' => 'SPL',
                'kota' => 'SEMPLAK'
            ],
        );
        sto::create(
            [
                'slug' => 'DMG',
                'kota' => 'DRAMAGA'
            ],
        );
        sto::create(
            [
                'slug' => 'LWL',
                'kota' => 'LEUWILIANG'
            ],
        );
        sto::create(
            [
                'slug' => 'CGD',
                'kota' => 'CIGUDEG'
            ],
        );
        sto::create(
            [
                'slug' => 'JSA',
                'kota' => 'JASINGA'
            ],
        );
        sto::create(
            [
                'slug' => 'LBI',
                'kota' => 'LEBAK WANGI'
            ],
        );
        sto::create(
            [
                'slug' => 'PAG',
                'kota' => 'PAGELARAN'
            ],
        );
        sto::create(
            [
                'slug' => 'CJU',
                'kota' => 'CIJERUK'
            ],
        );
        sto::create(
            [
                'slug' => 'CPS',
                'kota' => 'CIAPUS'
            ],
        );
        sto::create(
            [
                'slug' => 'CWI',
                'kota' => 'CIAWI'
            ],
        );
        sto::create(
            [
                'slug' => 'CRI',
                'kota' => 'CARINGIN'
            ],
        );
        sto::create(
            [
                'slug' => 'CSR',
                'kota' => 'CISARUA'
            ],
        );
        sto::create(
            [
                'slug' => 'STL',
                'kota' => 'SENTUL'
            ],
        );
        sto::create(
            [
                'slug' => 'PMU',
                'kota' => 'PASIR MAUNG'
            ],
        );
        sto::create(
            [
                'slug' => 'CTR',
                'kota' => 'CITEREUP'
            ],
        );
        sto::create(
            [
                'slug' => 'GPI',
                'kota' => 'GUNUNG PUTRI'
            ],
        );
        sto::create(
            [
                'slug' => 'CBI',
                'kota' => 'CIBINONG'
            ],
        );
        sto::create(
            [
                'slug' => 'CLS',
                'kota' => 'CILENGSI'
            ],
        );
        sto::create(
            [
                'slug' => 'CSN',
                'kota' => 'CIANGSANA'
            ],
        );
        sto::create(
            [
                'slug' => 'JGL',
                'kota' => 'JONGGOL'
            ],
        );
        sto::create(
            [
                'slug' => 'CAU',
                'kota' => 'CARIU'
            ],
        );
        sto::create(
            [
                'slug' => 'DEP',
                'kota' => 'DEPOK'
            ],
        );
        sto::create(
            [
                'slug' => 'SKJ',
                'kota' => 'SUKMAJAYA'
            ],
        );
        sto::create(
            [
                'slug' => 'PCM',
                'kota' => 'PANCORAN MAS'
            ],
        );
        sto::create(
            [
                'slug' => 'CNE',
                'kota' => 'CINERE'
            ],
        );
        sto::create(
            [
                'slug' => 'PAR',
                'kota' => 'PARUNG'
            ],
        );
        sto::create(
            [
                'slug' => 'TJH',
                'kota' => 'TAJUR HALANG'
            ],
        );
        sto::create(
            [
                'slug' => 'BJD',
                'kota' => 'BOJONG GEDE'
            ],
        );
        sto::create(
            [
                'slug' => 'CSE',
                'kota' => 'CISEENG'
            ],
        );
        sto::create(
            [
                'slug' => 'CISALAK',
                'kota' => 'CISALAK'
            ],
        );
        sto::create(
            [
                'slug' => 'KHL',
                'kota' => 'KEDUNG HALANG'
            ],
        );
    }
}
