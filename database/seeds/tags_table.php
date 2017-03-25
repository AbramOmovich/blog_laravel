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

        $this->faker = Faker\Factory::create();

        for($i = 0; $i < 10; $i++){
            $word = $this->faker->word;
            $db->insert(['title' => $word, 'slug'=> str_slug($word)]);
        }

    }
}
