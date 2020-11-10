<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Carousel;

class CarouselSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $carousels = [
            [
                'caption' => 'This is Caption1',
                'img' => '/images/banner/1.webp'
            ],
            [
                'caption' => 'This is Caption2',
                'img' => '/images/banner/2.webp'
            ],
            [
                'caption' => 'This is Caption3',
                'img' => '/images/banner/3.webp'
            ]
        ];

        foreach ($carousels as $item) {
            Carousel::create([
                'caption' => $item['caption'],
                'img' => $item['img']
            ]);
        }
    }
}
