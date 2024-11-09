<?php

use Illuminate\Database\Seeder;
// use App\Models\Book;
// use App\Models\Journal;
// use App\Models\CD;
// use App\Models\Paper;
// use App\Models\Skripsi;
// use App\database\factories\BookFactory;
use Database\Seeders\BookSeeder;
use Database\Seeders\CDSeeder;
use Database\Seeders\JournalSeeder;
use Database\Seeders\PaperSeeder;
use Database\Seeders\SkripsiSeeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            BookSeeder::class,
            CDSeeder::class,
            JournalSeeder::class,
            PaperSeeder::class,
            SkripsiSeeder::class,
        ]);
    }
}