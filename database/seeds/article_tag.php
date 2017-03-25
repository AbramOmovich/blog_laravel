<?php

use Illuminate\Database\Seeder;

class article_tag extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $db = DB::table('article_tag');

        $this->faker = Faker\Factory::create();

        for($i = 0; $i < 150; $i++){
            $values ['article_id'] = $this->faker->numberBetween(1,50);
            $values ['tag_id'] = $this->faker->numberBetween(1,10);

            $db->insert($values);
        }
    }
}
