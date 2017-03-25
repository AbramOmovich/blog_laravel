<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(users::class);
        $this->call(tags_table::class);
        $this->call(articles_table::class);
        $this->call(article_tag::class);
    }
}
