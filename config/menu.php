<?php

return [

    'Dashboard' => [
        'role'   => 'redac',
        'route'  => 'admin',
        'icon'   => 'tachometer-alt',
    ],

    'Categories Articles' => [
        'icon' => 'list',
        'role'   => 'admin',
        'children' => [
            [
                'name'  => 'All categories',
                'role'  => 'admin',
                'route' => 'categories.index',
            ],
            [
                'name'  => 'Add',
                'role'  => 'admin',
                'route' => 'categories.create',
            ],
            [
                'name'  => 'fake',
                'role'  => 'admin',
                'route' => 'categories.edit',
            ],
        ],
    ],
    'Posts' => [
        'icon' => 'file-alt',
        'role'   => 'redac',
        'children' => [
            [
                'name'  => 'All posts',
                'role'  => 'redac',
                'route' => 'posts.index',
            ],
            [
                'name'  => 'New posts',
                'role'  => 'admin',
                'route' => 'posts.indexnew',
            ],
            [
                'name'  => 'Add',
                'role'  => 'redac',
                'route' => 'posts.create',
            ],
            [
                'name'  => 'fake',
                'role'  => 'redac',
                'route' => 'posts.edit',
            ],
        ],
    ],
 

    'Categories Logements' => [
        'icon' => 'list',
        'role'   => 'admin',
        'children' => [
            [
                'name'  => 'Les categories logements',
                'role'  => 'admin',
                'route' => 'logements.index',
            ],
            [
                'name'  => 'Ajouter',
                'role'  => 'admin',
                'route' => 'logements.create',
            ],
            [
                'name'  => 'fake',
                'role'  => 'admin',
                'route' => 'logements.edit',
            ],
        ],
    ],

    'Appartemens' => [
        'icon' => 'list',
        'role'   => 'redac',
        'children' => [
            [
                'name'  => 'Les  logements',
                'role'  => 'redac',
                'route' => 'books.index',
            ],
            [
                'name'  => 'Ajouter',
                'role'  => 'redac',
                'route' => 'savebooks.create',
            ],
            [
                'name'  => 'fake',
                'role'  => 'redac',
                'route' => 'books.edit',
            ],
        ],
    ],


    
    'Rooms' => [
        'icon' => 'list',
        'role'   => 'redac',
        'children' => [
            [
                'name'  => 'Les  chambres',
                'role'  => 'redac',
                'route' => 'rooms.index',
            ],

           
            [
                'name'  => 'Ajouter une chambre',
                'role'  => 'redac',
                'route' => 'saverooms.create',
            ],
            [
                'name'  => 'fake',
                'role'  => 'redac',
                'route' => 'rooms.edit',
            ],
        ],
    ],

   /*  'Filières' => [
        'icon' => 'list',
        'role'   => 'admin',
        'children' => [
            [
                'name'  => 'Toutes les filières',
                'role'  => 'admin',
                'route' => 'filieres.index',
            ],
            [
                'name'  => 'Ajouter Filière',
                'role'  => 'admin',
                'route' => 'filieres.create',
            ],
            [
                'name'  => 'fake',
                'role'  => 'admin',
                'route' => 'filieres.edit',
            ],
        ],
    ], */

   /*  'Specialités' => [
        'icon' => 'list',
        'role'   => 'admin',
        'children' => [
            [
                'name'  => 'Toutes les spécialités',
                'role'  => 'admin',
                'route' => 'specialites.index',
            ],
            [
                'name'  => 'Ajouter une spécialité',
                'role'  => 'admin',
                'route' => 'specialites.create',
            ],
            [
                'name'  => 'fake',
                'role'  => 'admin',
                'route' => 'specialites.edit',
            ],
        ],
    ],
 */

/* 
    'Les études' => [
        'icon' => 'list',
        'role'   => 'admin',
        'children' => [
               [
                'name'  => 'Toutes les écoles',
                'role'  => 'admin',
                'route' => 'ecoles.index',
            ],   
            [
                'name'  => 'Ajouter un nouvelle école',
                'role'  => 'admin',
                'route' => 'saveecole.create',
            ],
            [
                'name'  => 'Les inscriptions',
                'role'  => 'admin',
                'route' => 'inscriptions.index',
            ],
            [
                'name'  => 'Les nouvelles inscriptions',
                'role'  => 'admin',
                'route' => 'inscriptions.indexnew',
            ],
            [
                'name'  => 'fake',
                'role'  => 'admin',
                'route' => 'schools.edit',
            ],
        ],
    ],
 */

   /*  'La Santé' => [
        'icon' => 'list',
        'role'   => 'admin',
        'children' => [
             [
                'name'  => 'Tous les hopitaux',
                'role'  => 'admin',
                'route' => 'hopitals.index',
            ], 
            [
                'name'  => 'Ajouter un Hopital',
                'role'  => 'admin',
                'route' => 'savehopitals.create',
            ],
            [
                'name'  => 'Les consultation',
                'role'  => 'admin',
                'route' => 'consultations.index',
            ],
            [
                'name'  => 'Les nouvelles consultations',
                'role'  => 'admin',
                'route' => 'consultations.indexnew',
            ],
            [
                'name'  => 'fake',
                'role'  => 'admin',
                'route' => 'hospitals.edit',
            ],
        ],
    ],
 */
   /*  'Products' => [
        'icon' => 'list',
        'role'   => 'admin',
        'children' => [
            [
                'name'  => 'All Products',
                'role'  => 'admin',
                'route' => 'products.index',
            ],
            [
                'name'  => 'Add New Product',
                'role'  => 'admin',
                'route' => 'saveproducts.create',
            ],
            [
                'name'  => 'fake',
                'role'  => 'admin',
                'route' => 'saveproducts.edit',
            ],
        ],
    ], */
    'Utilisateurs' => [
        'icon' => 'user',
        'role'   => 'admin',
        'children' => [
            [
                'name'  => 'All users',
                'role'  => 'admin',
                'route' => 'users.index',
            ],
            [
                'name'  => 'New users',
                'role'  => 'admin',
                'route' => 'users.indexnew',
            ],
            [
                'name'  => 'fake',
                'role'  => 'admin',
                'route' => 'users.edit',
            ],
        ],
    ],

    'Bannières' => [
        'icon' => 'list',
        'role'   => 'admin',
        'children' => [
            [
                'name'  => 'Toutes les bannières',
                'role'  => 'admin',
                'route' => 'homes.index',
            ],
            [
                'name'  => 'Ajouter bannières',
                'role'  => 'admin',
                'route' => 'heros.create',
            ],
            [
                'name'  => 'fake',
                'role'  => 'admin',
                'route' => 'heros.edit',
            ],
        ],
    ],

    'Galleries' => [
        'icon' => 'list',
        'role'   => 'admin',
        'children' => [
            [
                'name'  => 'Toutes les galleries',
                'role'  => 'admin',
                'route' => 'galleries.index',
            ],
            [
                'name'  => 'Ajouter gallerie',
                'role'  => 'admin',
                'route' => 'galleries.create',
            ],
            [
                'name'  => 'fake',
                'role'  => 'admin',
                'route' => 'galleries.edit',
            ],
        ],
    ],

 /*    'Services' => [
        'icon' => 'list',
        'role'   => 'admin',
        'children' => [
            [
                'name'  => 'All Services',
                'role'  => 'admin',
                'route' => 'services.index',
            ],
            [
                'name'  => 'Add Service',
                'role'  => 'admin',
                'route' => 'services.create',
            ],
            [
                'name'  => 'fake',
                'role'  => 'admin',
                'route' => 'services.edit',
            ],
        ],
    ], */
/* 
    'Sponsors' => [
        'icon' => 'list',
        'role'   => 'admin',
        'children' => [
            [
                'name'  => 'All Sponsors',
                'role'  => 'admin',
                'route' => 'sponsors.index',
            ],
            [
                'name'  => 'Add Sponsor',
                'role'  => 'admin',
                'route' => 'sponsors.create',
            ],
            [
                'name'  => 'fake',
                'role'  => 'admin',
                'route' => 'sponsors.edit',
            ],
        ],
    ],
 */

    'Comments' => [
        'icon' => 'comment',
        'role'   => 'redac',
        'children' => [
            [
                'name'  => 'All comments',
                'role'  => 'redac',
                'route' => 'comments.index',
            ],
            [
                'name'  => 'New comments',
                'role'  => 'redac',
                'route' => 'comments.indexnew',
            ],
            [
                'name'  => 'fake',
                'role'  => 'redac',
                'route' => 'comments.edit',
            ],
        ],
    ],

/*     'Commandes' => [
        'icon' => 'comment',
        'role'   => 'redac',
        'children' => [
            [
                'name'  => 'Toutes les commandes',
                'role'  => 'redac',
                'route' => 'commandes.index',
            ],

            [
                'name'  => 'Nouvelles commandes',
                'role'  => 'admin',
                'route' => 'orders.index',
            ],
        
        ],
    ],
 */
    
    'Réservation' => [
        'icon' => 'comment',
        'role'   => 'redac',
        'children' => [
            [
                'name'  => 'Toutes les réservations',
                'role'  => 'redac',
                'route' => 'reservations.index',
            ],

            [
                'name'  => 'Nouvelles Réservations',
                'role'  => 'admin',
                'route' => 'reservations.indexnew',
            ],
        
        ],
    ],
    'Contacts' => [
        'icon' => 'envelope',
        'role'   => 'admin',
        'children' => [
            [
                'name'  => 'All contacts',
                'role'  => 'admin',
                'route' => 'contacts.index',
            ],
            [
                'name'  => 'New contacts',
                'role'  => 'admin',
                'route' => 'contacts.indexnew',
            ],
        ],
    ],


    'Témoignages' => [
        'icon' => 'envelope',
        'role'   => 'admin',
        'children' => [
           
            [
                'name'  => 'Les  témoignages',
                'role'  => 'admin',
                'route' => 'testimonials.index',
            ],
            [
                'name'  => 'Les nouveaux témoignages',
                'role'  => 'admin',
                'route' => 'testimonials.indexnew',
            ],
        ],
    ],
    'Follows' => [
        'icon' => 'share-alt',
        'role'   => 'admin',
        'children' => [
            [
                'name'  => 'All follows',
                'role'  => 'admin',
                'route' => 'follows.index',
            ],
            [
                'name'  => 'Add',
                'role'  => 'admin',
                'route' => 'follows.create',
            ],
            [
                'name'  => 'fake',
                'role'  => 'admin',
                'route' => 'follows.edit',
            ],
        ],
    ],
    'Pages' => [
        'icon' => 'file',
        'role'   => 'admin',
        'children' => [
            [
                'name'  => 'All pages',
                'role'  => 'admin',
                'route' => 'pages.index',
            ],
            [
                'name'  => 'Add',
                'role'  => 'admin',
                'route' => 'pages.create',
            ],
            [
                'name'  => 'fake',
                'role'  => 'admin',
                'route' => 'pages.edit',
            ],
        ],
    ],


    'Paramètres' => [
        'icon' => 'file',
        'role'   => 'admin',
        'children' => [
            [
                'name'  => 'Configurations',
                'role'  => 'admin',
                'route' => 'contactadmins.index',
            ],
            [
                'name'  => 'Settings',
                'role'  => 'admin',
                'route' => 'settings.index',
            ],
       
           
        ],
    ],
];