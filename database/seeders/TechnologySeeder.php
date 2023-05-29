<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run(Faker $faker)
    {
        $technologies = [
            'JavaScript',
            'HTML',
            'CSS',
            'Python',
            'PHP',
            'React',
            'MAMP',
            'Docker',
            'Inertia',
            'VSCode',
            'Atom',
            'Bootstrap',
            'Tailwind',
            'Git',
            'Postman',
            'GitHub',
            'Laravel',
            'MySQL',
            'VueJS',
            'Figma',
        ];
        foreach ($technologies as $technology) {
            $newTech = new Technology();
            $newTech->name = $technology;
            $newTech->slug = Str::slug($technology);
            $newTech->description = $faker->text(200);
            $newTech->website = $faker->url;
            $newTech->save();
        };
    }
}
