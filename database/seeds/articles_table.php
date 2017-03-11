<?php

use Illuminate\Database\Seeder;

class articles_table extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $db = DB::table('articles');

        $db->truncate();

        $this->faker = Faker\Factory::create();

        for($i = 0; $i < 50; $i++){
            $db->insert([
                'title' => $this->faker->domainWord,
                'slug'=> $this->faker->slug,
                'short_descr' => $this->faker->sentence,
                'body' => $this->faker->text(3000)
            ]);
        }

    }
}
