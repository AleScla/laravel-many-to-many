<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Technology;

use Illuminate\Support\Facades\Schema;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Technology::truncate();
        Schema::enableForeignKeyConstraints();
        $allTechnologies = [
            'HTML',
            'CSS',
            'JS',
            'Bootstrap',
            'Laravel',
            'Vue',
            'React',
            'NodeJS',
            'Tailwind',
            'JAVA',
            'C++'
        ];
        foreach ($allTechnologies as $SingleTechnology) {
            $technology = Technology::create([
                'name' => $SingleTechnology,
            ]);
        }
    }
}

