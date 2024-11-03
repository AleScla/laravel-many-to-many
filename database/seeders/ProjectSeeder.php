<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

use App\Models\{
    Project,
    Type,
    Technology
};
class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Project::truncate();
        Schema::enableForeignKeyConstraints();
        for ($i=0; $i < 15; $i++) {

            $randomType = Type::inRandomOrder()->first();
            $project = Project::create([
                'title' => fake()->word(),
                'description' =>fake()->paragraph(),
                'completed' =>fake()->boolean(70),
                'starting_date' =>fake()->dateTimeBetween('-1 week', '+1 week'),
                'level'=>fake()->word(),
                'type_id'=> $randomType->id,
            ]);
            $technologyIds= [];
            for ($j=0; $j < Technology::count(); $j++) {
                $randomTech = Technology::inRandomOrder()->first();

                if(!in_array($randomTech->id, $technologyIds)){
                    $technologyIds[] = $randomTech->id;
                }
            }
            $project->technologies()->sync($technologyIds);
        }
    }
}
