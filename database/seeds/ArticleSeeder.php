<?php

use Illuminate\Database\Seeder;
use App\Article;
use App\Author;
use Faker\Generator as Faker; 

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)  // in maniera del tutto automatica, Laravel andrà a soddisfare questa dipendenza.
    {

        $typeList= [
            'cronaca',
            'sport',
            'attualità'
        ];

        for ($i = 0; $i < 30; $i++){
             
            //creo la parte indipendente e salvo
            $authorObject = new Author();            
            $authorObject->name=$faker->name();
            $authorObject->surname=$faker->lastName();
            $authorObject->picture=$faker->imageUrl(320, 320, 'animals', true);
            $authorObject->email=$faker->email();
            $authorObject->save();

            $randGenereKey= array_rand($typeList,1);
            $type = $typeList[$randGenereKey];


            //collego la parte dipendente
            $articleObject = new Article();
            $articleObject->picture=$faker->imageUrl(640, 480, 'animals', true);
            $articleObject->type=$type;
            $articleObject->text=$faker->paragraph(2);
            $articleObject->title=$faker->sentence();
            $articleObject->author_id= $authorObject->id;
            $articleObject->save();
        }
    }
}
