<?php

use App\Article;
use App\Tag;
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

        $articles_ids = Article::all()->pluck('id')->toArray();
        $tags_ids = Tag::all('id')->pluck('id')->toArray();
        $numbOfTags = count($tags_ids);

        foreach($articles_ids as $articleId){
            $randTags = array_rand(array_flip($tags_ids),$this->faker->numberBetween(2,$numbOfTags));
            $values = [];
            foreach($randTags as $tagsId){
                $values ['article_id'] = $articleId;
                $values ['tag_id'] = $tagsId;

                $db->insert($values);
            }
        }
    }
}
