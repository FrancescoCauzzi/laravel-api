<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Type;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $types = ['Full stack', 'Front end', 'Back end', 'Web app', 'Personal project', 'Framework', 'Blog', 'API', 'Game', 'Desktop app', 'Mobile app', 'Database management', 'E-commerce', 'Machine learning', 'Data analysis', 'Data visualization', 'Other'];

        foreach ($types as $type) {
            $newType = new Type();
            $newType->name = $type;
            $newType->slug = Str::slug($newType->name, '-');
            $newType->description = $faker->text(200);

            $newType->save();
        }
    }
}
