<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Type;

use Illuminate\Support\Facades\Schema;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Type::truncate();
        Schema::enableForeignKeyConstraints();
        $allTypes = [
            'front-end',
            'back-end',
            'full-stack'
        ];
        foreach ($allTypes as $SingleType) {
            $type = Type::create([
                'name' => $SingleType,
            ]);

        }
    }
}
