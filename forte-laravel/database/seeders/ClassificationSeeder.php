<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Classification;

class ClassificationSeeder extends Seeder
{
    public function run(): void
    {
        Classification::insert([
            ['name'=>'Pohon Tumbang','description'=>'Laporan tentang pohon tumbang'],
            ['name'=>'Padi Rusak','description'=>'Laporan tentang padi rusak akibat hama atau cuaca'],
            ['name'=>'Buah Berlubang','description'=>'Buah yang rusak / berlubang'],
            ['name'=>'Sungai Tercemar','description'=>'Laporan pencemaran sungai'],
            ['name'=>'Jalan Rusak','description'=>'Laporan jalan rusak'],
        ]);
    }
}
