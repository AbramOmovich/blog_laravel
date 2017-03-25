<?php

use Illuminate\Database\Seeder;

class articles_table extends Seeder
{
    private $faker;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $db = DB::table('articles');

        $this->faker = Faker\Factory::create();

        for($i = 0; $i < 50; $i++){

            $values ['title']= $this->faker->sentence;
            $values ['slug'] = str_slug($values['title']);
            $values ['body'] = $this->faker->realText(3000);
            $values ['short_descr']= str_limit($values['body'],300);
            $values ['created_at']= $this->faker->dateTimeBetween('-1 years');
            $values ['updated_at'] = clone $values['created_at'];
            $values ['updated_at']->add($values['created_at']->diff(new $this->faker->dateTimeBetween('-1 years'),true));
            $values ['user_id'] = $this->faker->numberBetween(1,10);

            $db->insert($values);
        }

    }
}
