<?php

use Illuminate\Database\Seeder;

class tags_table extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    protected $faker;

    public function run()
    {
        $db = DB::table('tags');

        $db->truncate();

        $this->faker = Faker\Factory::create();

        for($i = 0; $i < 50; $i++){
            $db->insert(['title' => $this->faker->word, 'slug'=> $this->faker->slug]);
        }

    }
}
