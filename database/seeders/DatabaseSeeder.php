<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{ User, Contact, Post, Comment, Page, Message, Config };
use Carbon\Factory;
use Faker\Factory as FakerFactory;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Users
        User::withoutEvents(function () {
            // Create 1 admin
            User::factory()->count(1)->create([
                'name' => 'Admin ',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('123456789'), // password
                'role' => 'admin',
            ]);
            // Create 4 redactors
            User::factory()->count(10)->create([
                'role' => 'redac',
            ]);
            // Create 6 users
            User::factory()->count(9)->create();
        });

        $nbrUsers = 20;

        $cat = new Config();
        $cat->frais = '15';
        $cat->description = 'GREENLYFES est une entreprise spécialisée en intermediation  des 
entreprises. Nous intervenons dans cinq secteurs: les études, les produits 
artisanaux, la santé, informatique, et le tourisme';
       $cat->telephone= '56399165';
       $cat->email='greenlyfes@gmail.com';
       $cat->addresse='Tunis ';

        $cat->save(); 

        // Categories
        DB::table('categories')->insert([
            [
                'title' => 'Droit de l\'homme',
                'slug' => 'droit-de-lhomme'
            ],
            [
                'title' => 'Droit vie privée',
                'slug' => 'droit-vie-privee'
            ],
            [
                'title' => 'Droit de la femme',
                'slug' => 'droit-de-la-femme'
            ],
            [
                'title' => 'Droit au travail',
                'slug' => 'droit-au-travail'
            ],
            [
                'title' => 'Droit de l\'enfant',
                'slug' => 'droit-de-lenfant'
            ],
            [
                'title' => 'Droit des affaires',
                'slug' => 'droit des affaires'
            ]
        ]);

        $nbrCategories = 6;

        // Tags
        DB::table('tags')->insert([
            ['tag' => 'Tag1', 'slug' => 'tag1'],
            ['tag' => 'Tag2', 'slug' => 'tag2'],
            ['tag' => 'Tag3', 'slug' => 'tag3'],
            ['tag' => 'Tag4', 'slug' => 'tag4'],
            ['tag' => 'Tag5', 'slug' => 'tag5'],
            ['tag' => 'Tag6', 'slug' => 'tag6']
        ]);

        $nbrTags = 6;

        // Posts
        Post::withoutEvents(function () {
            foreach (range(1, 2) as $i) {
                Post::factory()->create([
                    'title' => 'Probleme ' . $i,
                    'slug' => 'probleme-' . $i,
                    'seo_title' => 'Probleme ' . $i,
                    'user_id' => 2,
                    'image' => 'img0' . $i . '.jpg',
                ]);
            }
            foreach (range(3, 9) as $i) {
                Post::factory()->create([
                    'title' => 'Probleme ' . $i,
                    'slug' => 'probleme-' . $i,
                    'seo_title' => 'Probleme ' . $i,
                    'user_id' => 3,
                    'image' => 'img0' . $i . '.jpg',
                ]);
            }
        });

        $nbrPosts = 9;
        //factory(App\Models\Message::class, 10)->create();
        // Tags attachment
        $posts = Post::all();
        foreach ($posts as $post) {
            if ($post->id === 9) {
                $numbers=[1,2,5,6];
                $n = 4;
            } else {
                $numbers = range (1, $nbrTags);
                shuffle ($numbers);
                $n = rand (2, 4);
            }
            for($i = 0; $i < $n; ++$i) {
                $post->tags()->attach($numbers[$i]);
            }
        }

        // Set categories
        foreach ($posts as $post) {
            if ($post->id === 9) {
                DB::table ('category_post')->insert ([
                    'category_id' => 1,
                    'post_id' => 9,
                ]);
            } else {
                $numbers = range (1, $nbrCategories);
                shuffle ($numbers);
                $n = rand (1, 2);
                for ($i = 0; $i < $n; ++$i) {
                    DB::table ('category_post')->insert ([
                        'category_id' => $numbers[$i],
                        'post_id' => $post->id,
                    ]);
                }
            }
        }

        // Comments
        foreach (range(1, $nbrPosts - 1) as $i) {
            Comment::factory()->create([
                'post_id' => $i,
                'user_id' => rand(1, $nbrUsers),
            ]);
        }

        $faker = \Faker\Factory::create();

        Comment::create([
            'post_id' => 2,
            'user_id' => 3,
            'body' => $faker->paragraph($nbSentences = 4, $variableNbSentences = true),

            'children' => [
                [
                    'post_id' => 2,
                    'user_id' => 4,
                    'body' => $faker->paragraph($nbSentences = 4, $variableNbSentences = true),

                    'children' => [
                        [
                            'post_id' => 2,
                            'user_id' => 2,
                            'body' => $faker->paragraph($nbSentences = 4, $variableNbSentences = true),
                        ],
                    ],
                ],
            ],
        ]);

        Comment::create([
            'post_id' => 2,
            'user_id' => 6,
            'body' => $faker->paragraph($nbSentences = 4, $variableNbSentences = true),

            'children' => [
                [
                    'post_id' => 2,
                    'user_id' => 3,
                    'body' => $faker->paragraph($nbSentences = 4, $variableNbSentences = true),
                ],
                [
                    'post_id' => 2,
                    'user_id' => 6,
                    'body' => $faker->paragraph($nbSentences = 4, $variableNbSentences = true),

                    'children' => [
                        [
                            'post_id' => 2,
                            'user_id' => 3,
                            'body' => $faker->paragraph($nbSentences = 4, $variableNbSentences = true),

                            'children' => [
                                [
                                    'post_id' => 2,
                                    'user_id' => 6,
                                    'body' => $faker->paragraph($nbSentences = 4, $variableNbSentences = true),
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ]);

        Comment::create([
            'post_id' => 4,
            'user_id' => 4,
            'body' => $faker->paragraph($nbSentences = 4, $variableNbSentences = true),

            'children' => [
                [
                    'post_id' => 4,
                    'user_id' => 5,
                    'body' => $faker->paragraph($nbSentences = 4, $variableNbSentences = true),

                    'children' => [
                        [   'post_id' => 4,
                            'user_id' => 2,
                            'body' => $faker->paragraph($nbSentences = 4, $variableNbSentences = true),
                        ],
                        [
                            'post_id' => 4,
                            'user_id' => 1,
                            'body' => $faker->paragraph($nbSentences = 4, $variableNbSentences = true),
                        ],
                    ],
                ],
            ],
        ]);

        // Contacts
          Contact::withoutEvents(function () {
            Contact::factory()->count(10)->create();
        });

        // Pages
        $items = [
            ['about-us', 'About us'],
       
            ['Projects', 'Projects'],
            ['Services', 'Services'],
        
        ];

        foreach($items as $item) {
            Page::factory()->create([
                'slug' => $item[0],
                'title' => $item[1],
            ]);
        }

        // Social
        DB::table('follows')->insert([
            ['title' => 'Telegram', 'href' => '#'],
            ['title' => 'Facebook', 'href' => '#'],
            ['title' => 'WthatsApp', 'href' => '#'],
            ['title' => 'Instagram', 'href' => '#'],
        ]);




    }


}
