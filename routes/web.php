<?php

use Illuminate\Support\Facades\Route;
use UniSharp\LaravelFilemanager\Lfm;
use App\Http\Controllers\Front\{
    PostController as FrontPostController,
    CommentController as FrontCommentController,
    ContactController,
    PageController as FrontPageController,
    InfosController,
    NewsController,
    ShopController,
    ProductController as FrontProduct,
    CartController as backcart,
    OrderController,
    EcoleController as FrontEcoleController,
    HopitalController as FrontHopitalController,
    ConsultationController,
    InscriptionController,
    TestimonialController,
    
};
use App\Http\Controllers\Back\{
    AdminController,
    PostController as BackPostController,
    ResourceController as BackResourceController,
    UserController as BackUserController,
    HeroPageController,
    SponsorController ,
    OrderController as BackOrderController,
    EcoleController,
    HopitalController,


    ServiceController,
    CategoryController,
    ProductController,

    ConfigController,
    AccountController
};


use App\Http\Controllers\Auth\LoginController;


//////////////Dashboard , Account
Route::resource('settings', AccountController::class);


Route::get('user/{id}', [AccountController::class, 'changeStatus']);
Route::get('/users/simple', 'UserController@simple')->name('simple_search');
Route::get('update_avatar', [AccountController::class, 'update_avatar']);
Route::put('update_user', [AccountController::class, 'update_user']);
Route::post('change_password/{id}', [AccountController::class, 'change_password']);
Route::put('update_address/{id}', [AccountController::class, 'update_address']);
Route::put('avatar/{id}', [AccountController::class, 'avatar']);

// Home
Route::name('home')->get('/', [FrontPostController::class, 'index']);
//Route::name('category')->get('category/{category:slug}', [FrontPostController::class, 'category']);
Route::name('author')->get('author/{user}', [FrontPostController::class, 'user']);
Route::name('tag')->get('tag/{tag:slug}', [FrontPostController::class, 'tag']);
//Route::name('page')->get('page/{page:slug}', FrontPageController::class);
//Route::name('page')->get('page/{page:slug}', FrontPageController::class);
Route::name('follow')->get('page/{page:slug}', FrontPageController::class);
Route::get('page/{page:slug}', FrontPageController::class)->name('page');


Route::get('searchs', [FrontPostController::class, 'searchs'])->name("searchs");

Route::post('/posts/{post}/comments', [FrontCommentController::class, 'storeComment'])->name('comments.store');

///////Blogs
Route::prefix('posts')->group(function () {
    Route::name('posts.display')->get('{slug}', [FrontPostController::class, 'show']);



 
    Route::name('posts.comments')->get('{post}/comments', [FrontCommentController::class, 'comments']);
    Route::name('posts.comments.store')->post('{post}/comments', [FrontCommentController::class, 'store'])->middleware('auth');
});
Route::get('/blog', [FrontPostController::class, 'blog']);
Route::get('details-blog/{id}/{slug}', [FrontPostController::class, 'details'])->name('details-blog');
Route::get('/category/{id}', [FrontPostController::class, 'posts'])->where('id', '[0-9]+');
Route::name('front.comments.destroy')->delete('comments/{comment}', [FrontCommentController::class, 'destroy']);

////Ecoles
Route::get('schools', [FrontEcoleController::class, 'schools'])->name('schools');
Route::get('details-ecole/{id}', [FrontEcoleController::class, 'details'])->name('details-ecole');
Route::get('/filiere/{id}', [FrontEcoleController::class, 'school'])->where('id', '[0-9]+');
Route::get('ecole/{id}', [FrontEcoleController::class,'show'])->name('ecole.show');
Route::get('rechercher', [FrontEcoleController::class, 'rechercher'])->name("rechercher");
Route::post('/inscription', [InscriptionController::class, 'store'])->name('inscription.store');



////Hopitaux
Route::get('hopitaux', [FrontHopitalController::class, 'hopitaux'])->name('hopitaux');
Route::get('/specialite/{id}', [FrontHopitalController::class, 'hopital'])->where('id', '[0-9]+');
Route::get('details-hopital/{id}', [FrontHopitalController::class, 'details'])->name('details-hopital');
Route::get('/hopital/{id}', [FrontHopitalController::class,'show'])->name('hopital.show');
Route::get('recherche', [FrontHopitalController::class, 'recherche'])->name("recherche");
Route::post('/consultation', [ConsultationController::class, 'store'])->name('consultation.store');

/////temoignages
Route::resource('testimonial', TestimonialController::class);

// Infos
// Contact
Route::resource('contacts', ContactController::class, ['only' => ['create', 'store', 'contact', 'about']]);
Route::resource('contact', ContactController::class);
Route::get('about', [ContactController::class, 'about'])->name('about');


// Products
Route::get('produits', [ShopController::class, 'produits'])->name('produits');;
Route::get('/details-produits/{id}/{slug}', [ShopController::class, 'details'])->name('details-produits');
Route::get('search', [ShopController::class, 'search'])->name("search");
Route::get('/categorie/{id}', [ShopController::class, 'products'])->where('id', '[0-9]+');
Route::get('products/{product}', FrontProduct::class)->name('detailsproducts.show');


///Commandes
Route::get('checkout', [FrontProduct::class, 'proceed']);
Route::get('/commandes/{id}', [OrderController::class, 'commandes'])->name('commandes');
Route::post('/order', [OrderController::class, 'confirmOrder'])->name('order.confirm');
Route::get('/thank-you', [FrontProduct::class, 'index'])->name('thank-you');


require __DIR__ . '/auth.php';

//Route::view('admin', 'back.layout');
// Laguages
Route::name('language')->get('language/{lang}', 'HomeController@language');
/*
|--------------------------------------------------------------------------
| Backend
|--------------------------------------------------------------------------|
*/

Route::prefix('admin')->group(function () {

    Route::middleware('redac')->group(function () {

        // Dashboard
        Route::name('admin')->get('/', [AdminController::class, 'index']);
        // Purge
        Route::name('purge')->put('purge/{model}', [AdminController::class, 'purge']);
        // Posts
        Route::resource('posts', BackPostController::class)->except(['show', 'create']);
        Route::name('posts.create')->get('posts/create/{id?}', [BackPostController::class, 'create']);
        
      //  Route::name('posts.edit')->put('posts/{post}', [BackPostController::class, 'update']);
        //Projects
        Route::resource('projects', 'ProductController')->except('show');
        // Users
        Route::name('users.valid')->put('valid/{user}', [BackUserController::class, 'valid']);
        Route::name('users.unvalid')->put('unvalid/{user}', [BackUserController::class, 'unvalid']);
        // Comments
        Route::resource('comments', BackResourceController::class)->except(['show', 'create', 'store']);
        Route::name('comments.indexnew')->get('newcomments', [BackResourceController::class, 'index']);

           // Oders
           Route::resource('orders', BackOrderController::class);
            Route::name('orders.indexnew')->get('neworders', [BackResourceController::class, 'index']);
    });

    Route::middleware('admin')->group(function () {

        // Posts
        Route::name('posts.indexnew')->get('newposts', [BackPostController::class, 'index']);
        // Categories
        Route::resource('categories', BackResourceController::class)->except(['show']);
        Route::resource('savecategories', CategoryController::class);

        /////specialites

        Route::resource('specialites', BackResourceController::class)->except(['show']);


        ///Ecoles
        Route::resource('ecoles', EcoleController::class);
        Route::resource('schools', EcoleController::class);

        Route::resource('saveecole', EcoleController::class);
        /////Inscriptions
        Route::resource('inscriptions', BackResourceController::class)->except(['show']);
        Route::name('inscriptions.indexnew')->get('newinscriptions', [BackResourceController::class, 'index']);
        Route::resource('saveinscriptions', InscriptionController::class);

        /////Ecoles

        /////Hopitals
        Route::resource('hopitals', BackResourceController::class)->except(['show']);
       // Route::name('hopitals.indexnew')->get('newhopitals', [BackResourceController::class, 'index']);
        Route::resource('hospitals', HopitalController::class);
        Route::resource('savehopitals', HopitalController::class);
        /////consultations
        Route::resource('consultations', BackResourceController::class)->except(['show']);
        Route::name('consultations.indexnew')->get('newconsultations', [BackResourceController::class, 'index']);
        Route::resource('saveconsultations', ConsultationController::class);
       

        ////////Filieres
        Route::resource('filieres', BackResourceController::class)->except(['show']);
        
      

        // Products
        Route::resource('products', ProductController::class);
        Route::name('products.indexnew')->get('newproducts', [ProductController::class, 'index']);
        Route::resource('saveproducts', ProductController::class);

     
        // Users
        Route::resource('users', BackUserController::class)->except(['show', 'create', 'store']);
        Route::name('users.indexnew')->get('newusers', [BackResourceController::class, 'index']);

        // Oders
      Route::resource('commandes', BackOrderController::class);
      Route::get('/commandes/{id}/envoyer-facture', [BackOrderController::class, 'sendInvoice'])->name('commandes.envoyer-facture');

      Route::get('/commandes/{id}/facture', [BackOrderController::class, 'generateInvoice'])->name('commandes.facture');
      Route::resource('orders', BackResourceController::class)->except(['show']);
       Route::name('orders.indexnew')->get('neworders', [BackResourceController::class, 'index']);

        // Contacts
        Route::resource('contacts', BackResourceController::class)->only(['index', 'destroy']);
        Route::name('contacts.indexnew')->get('newcontacts', [BackResourceController::class, 'index']);

        ///Testimonitals
        
        Route::name('testimonials.indexnew')->get('newtestimonials', [BackResourceController::class, 'index']);
        
       Route::resource('testimonials', TestimonialController::class);
        Route::get('testimoniales/{id}/approve', [TestimonialController::class, 'approve'])->name('testimoniales.approve');
        Route::get('testimoniales/{id}/disapprove', [TestimonialController::class, 'disapprove'])->name('testimoniales.disapprove');
        Route::delete('testimoniales/{id}/destroy', [TestimonialController::class, 'destroy'])->name('testimoniales.destroy');
        Route::get('testimoniale/{id}/destroy', [TestimonialController::class, 'destroy'])->name('testimoniale.destroy');

        // Follows
        Route::resource('follows', BackResourceController::class)->except(['show']);
        // Pages
        Route::resource('pages', BackResourceController::class)->except(['show']);

        // Heros
        Route::resource('homes', BackResourceController::class)->except(['show']);
        Route::resource('heros', HeroPageController::class);


        // Services
       
        Route::resource('services', ServiceController::class);

        ////Sponsors
       Route::resource('sponsors', SponsorController::class);


        Route::resource('contactadmins', ConfigController::class);



         // all users
         Route::get('/send/mail/view/all', [BackUserController::class, 'emailViewAll'])->name('send.email.view.all');

         Route::post('/store/email/all', [BackUserController::class, 'storeAllUserEmail'])->name('store.alluser.email');


         // single users
         Route::get('/send/mail/view/{id}', [BackUserController::class, 'emailView'])->name('send.email.view');

         Route::post('/store/email/{id}', [BackUserController::class, 'storeSingleEmail'])->name('store.user.email');




    });
});

Route::middleware('ajax')->group(function () {
    Route::post('message', 'UserController@message')->name('message');
});
// Home page
//Route::view('/', 'home')->name('home');


Route::post('/register', [LoginController::class, 'store'])
    ->middleware('guest');