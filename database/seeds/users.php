<?php

use Illuminate\Database\Seeder;

class users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $db = DB::table('users');

        $this->faker = Faker\Factory::create();

        for($i = 0; $i < 10; $i++){

            $values ['name']= $this->faker->name;
            $values ['email'] = $this->faker->email;
            $values ['password'] = $this->faker->password;

            $db->insert($values);
        }
    }
}
