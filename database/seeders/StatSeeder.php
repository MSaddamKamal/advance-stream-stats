<?php

namespace Database\Seeders;

use App\Models\Stat;
use Illuminate\Database\Seeder;

class StatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'title' => 'Live',
                'statistics' => '89',
                'type' => 'PAID',
            ],
            [
                'title' => 'My Rank',
                'statistics' => '105',
                'type' => 'FREE',
            ],
            [
                'title' => 'Paid Challenges',
                'statistics' => '45',
                'type' => 'FREE',
            ],
            [
                'title' => 'Opponents',
                'statistics' => '20',
                'type' => 'PAID',
            ],
        ];
        foreach ($data as $val){
            Stat::create($val);
        }

    }
}
