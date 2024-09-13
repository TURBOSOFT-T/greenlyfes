<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\{User, Address, Country, Product, Colissimo, Range, State, Shop, Page, Order};


use App\Models\{  Contact, Post, Comment,  Message, Review};
use Carbon\Factory;
use Faker\Factory as FakerFactory;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('123456789'), // password
                'role' => 'admin',
//'id' => Str::uuid(),
            ]);
            // Create 4 redactors
            User::factory()->count(4)->create([
                'role' => 'redac',
            ]);
            // Create 6 users
            User::factory()->count(6)->create();
        });

        $nbrUsers = 12;

        Country::insert([
            ['name' => 'France', 'tax' => 0.2],
            ['name' => 'Belgique', 'tax' => 0.2],
            ['name' => 'Suisse', 'tax' => 0],
            ['name' => 'Canada', 'tax' => 0],
        ]);
        Range::insert([
            ['max' => 1],
            ['max' => 2],
            ['max' => 3],
            ['max' => 100],
        ]);

        Colissimo::insert([
            ['country_id' => 1, 'range_id' => 1, 'price' => 7.25],
            ['country_id' => 1, 'range_id' => 2, 'price' => 8.95],
            ['country_id' => 1, 'range_id' => 3, 'price' => 13.75],
            ['country_id' => 1, 'range_id' => 4, 'price' => 0],
            ['country_id' => 2, 'range_id' => 1, 'price' => 15.5],
            ['country_id' => 2, 'range_id' => 2, 'price' => 17.55],
            ['country_id' => 2, 'range_id' => 3, 'price' => 22.45],
            ['country_id' => 2, 'range_id' => 4, 'price' => 0],
            ['country_id' => 3, 'range_id' => 1, 'price' => 15.5],
            ['country_id' => 3, 'range_id' => 2, 'price' => 17.55],
            ['country_id' => 3, 'range_id' => 3, 'price' => 22.45],
            ['country_id' => 3, 'range_id' => 4, 'price' => 0],
            ['country_id' => 4, 'range_id' => 1, 'price' => 27.65],
            ['country_id' => 4, 'range_id' => 2, 'price' => 38],
            ['country_id' => 4, 'range_id' => 3, 'price' => 55.65],
            ['country_id' => 4, 'range_id' => 4, 'price' => 0],
        ]);


        State::insert([
            ['name' => 'Attente chèque', 'slug' => 'cheque', 'color' => 'blue', 'indice' => 1],
            ['name' => 'Attente mandat administratif', 'slug' => 'mandat', 'color' => 'blue', 'indice' => 1],
            ['name' => 'Attente virement', 'slug' => 'virement', 'color' => 'blue', 'indice' => 1],
            ['name' => 'Attente paiement par carte', 'slug' => 'carte', 'color' => 'blue', 'indice' => 1],
            ['name' => 'Erreur de paiement', 'slug' => 'erreur', 'color' => 'red', 'indice' => 0],
            ['name' => 'Annulé', 'slug' => 'annule', 'color' => 'red', 'indice' => 2],
            ['name' => 'Mandat administratif reçu', 'slug' => 'mandat_ok', 'color' => 'green', 'indice' => 3],
            ['name' => 'Paiement accepté', 'slug' => 'paiement_ok', 'color' => 'green', 'indice' => 4],
            ['name' => 'Expédié', 'slug' => 'expedie', 'color' => 'green', 'indice' => 5],
            ['name' => 'Remboursé', 'slug' => 'rembourse', 'color' => 'red', 'indice' => 6],
        ]);






        // Categories
        DB::table('categories')->insert([
            [
                'title' => 'Offre Stage',
                'slug' => 'offre-1'
            ],
            [
                'title' => 'Concours',
                'slug' => 'concours-2'
            ],
            [
                'title' => 'Offres Emplois',
                'slug' => 'emplois-3'
            ],
        ]);

        $nbrCategories = 3;

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
        // factory(Shop::class)->create();
        // Shop::factory()->count(1)->create();

        // Contacts

        // Posts
        Post::withoutEvents(function () {
            foreach (range(1, 2) as $i) {
                Post::factory()->create([
                    'title' => 'Post ' . $i,
                    'slug' => 'post-' . $i,
                    'seo_title' => 'Post ' . $i,
                    'user_id' => 2,
                    'image' => 'img0' . $i . '.jpg',
                ]);
            }
            foreach (range(3, 9) as $i) {
                Post::factory()->create([
                    'title' => 'Post ' . $i,
                    'slug' => 'post-' . $i,
                    'seo_title' => 'Post ' . $i,
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



        // Contacts
          Contact::withoutEvents(function () {
            Contact::factory()->count(5)->create();
        });
         //Products
        Product::withoutEvents(function () {
            Product::factory()->count(10)->create();
        });
        //Reviews
        Review::withoutEvents(function () {
            Review::factory()->count(15)->create();
        });

        Shop::factory()->count(1)->create();

    //    Address::factory()->count(40)->create();
        // Pages
        $items = [
            ['about-us', 'About us'],
            ['Intership', 'Intership'],
            ['Tutorials', 'Tutorials'],
            ['Projects', 'Projects'],
            ['Services', 'Services'],
            ['privacy-policy', 'Privacy Policy'],
        ];

        foreach($items as $item) {
            Page::factory()->create([
                'slug' => $item[0],
                'title' => $item[1],
            ]);
        }
        $items = [
            ['livraisons', 'Livraisons'],
            ['mentions-legales', 'Mentions légales'],
            ['conditions-generales-de-vente', 'Conditons générales de vente'],
            ['politique-de-confidentialite', 'Politique de confidentialité'],
            ['respect-environnement', 'Respect de l\'environnement'],
            ['mandat-administratif', 'Mandat administratif'],
        ];
        foreach ($items as $item) {
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
