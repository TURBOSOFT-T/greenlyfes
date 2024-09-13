<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\{
    AuthController,
    CategoryController,
    ProductController,
    ContactController,
    ShopController,
    UserController
};

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
   // return $request->user();

  //  Route::get('getuser', [AuthController::class, 'getuser']);
//});


Route::middleware('auth:sanctum')->group( function() {


    Route::get('getuser', [AuthController::class, 'getuser']);
    Route::post('/logout', [AuthController::class, 'logout']);
});



Route::middleware('auth:sanctum')->group(function () { Route::post(  'email/verify',  [AuthController::class, 'verifyEmail']  );
  Route::middleware('verify.api')->group(function () {
// Route::post(  '/logout', [AuthController::class, 'logout'] );
});});

Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('/verify/pin', [AuthController::class, 'verifyPin']);
Route::post('/reset-password', [AuthController::class, 'resetPassword']);

Route::group(['prefix' => 'users', 'middleware' => 'CORS'], function ($router) {
    Route::post('/register', [AuthController::class, 'register'])->name('register.user');
   // Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/view-profile', [AuthController::class, 'viewProfile'])->name('profile.user');
    //Route::post('/logout', [AuthController::class, 'logout']);
});



//Route::post('logout', [AuthController::class, 'logout']);

//Route::post('details', [AuthController::class, 'details']);

Route::group(['middleware' => [ 'auth:api']], function () {
    //  Route::post('register', [AuthController::class, 'register']);
   // Route::post('login', [AuthController::class, 'login']);
  //  Route::post('logout', [AuthController::class, 'logout']);
   Route::post('details', [AuthController::class, 'details']);
    //Route::post('refreshtoken', [AuthController::class, 'refreshtoken']);
});

Route::post('unauthorized', [AuthController::class, 'unauthorized']);
//Route::post('details', [AuthController::class, 'details']);
//Route::get('getuser', [AuthController::class, 'getuser']);
//Route::post('details', [AuthController::class, 'details']);

Route::group(['middleware' => ['CheckClientCredentials', 'auth:api']], function () {
    //  Route::post('register', [AuthController::class, 'register']);
    //Route::post('login', [AuthController::class, 'login']);
 //  Route::post('logout', [AuthController::class, 'logout']);
//Route::post('details', [AuthController::class, 'details']);
    //Route::post('refreshtoken', [AuthController::class, 'refreshtoken']);
});


Route::post('change_password', [AuthController::class, 'change_password']);
Route::post('login', [AuthController::class, 'login']);

Route::post('register', [AuthController::class, 'register']);
//Route::get('getuser', [AuthController::class, 'getuser']);
Route::post('forgotPassword', [AuthController::class, 'forgotPassword']);
Route::post('changepassword', [AuthController::class, 'changepassword']);
Route::post('resetpassword', [AuthController::class, 'resetpassword']);

Route::get('user/activation/{token}', [AuthController::class, 'userActivation']);


//////////////////////////Shops///////////////////////////////////////////////
Route::group(['prefix' => 'shops', 'middleware' => 'CORS'], function ($router) {
    Route::post('/register', [ShopController::class, 'register'])->name('register.shop');
    // Route::post('/login', [ShopController::class, 'login'])->name('login');
    Route::get('/view-shop', [ShopController::class, 'viewShop'])->name('profile.shop');
  //  Route::get('/logout', [ShopController::class, 'logout'])->name('logout.shop');
});

///////////////Categories//////////////////////////////
Route::prefix('categories')->group(function () {
    Route::get('/', [CategoryController::class, 'index']);
    Route::get('/search', [CategoryController::class, 'search']);
});


//////////////Products/////////////////////////////////////
Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index']);
    Route::post('/', [ProductController::class, 'store']);
    Route::delete('/{id}', [ProductController::class, 'delete']);
    Route::post('/create-product', [ProductController::class, 'createProduct'])->name('product.create');
    Route::get('/me', [ProductController::class, 'me']);
    Route::get('/search', [ProductController::class, 'search']);

    Route::get('cart', [ProductController::class, 'cart'])->name('cart');
    Route::get('add-to-cart/{id}', [ProductController::class, 'addToCart'])->name('add.to.cart');
    Route::patch('update-cart', [ProductController::class, 'updateCart'])->name('update.cart');
    Route::delete('remove-from-cart', [ProductController::class, 'remove'])->name('remove.from.cart');
    Route::post('clear', [ProductController::class, 'clearAllCart'])->name('cart.clear');

});
//////////////Contacts/////////////////////////////////////
Route::prefix('contacts')->group(function () {

    Route::post('/', [ContactController::class, 'store']);
});