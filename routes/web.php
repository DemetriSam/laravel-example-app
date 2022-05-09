<?php

use Illuminate\Support\Facades\Route;
use App\Models\Ingredient;
use Illuminate\Http\Request;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\RecipeController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
   $url = URL::to("/");
   echo $url ? $url."<br>" : "неа<br>";

    $users = DB::table('users')->get();
    if ($users) {
        var_dump($users);
        foreach ($users as $user) {
            echo $user->name;
        }
    } else {
        echo "Users table is empty. ";
    }

    $response = "Hello world 2".view('welcome');
    return $response;
});



//ИНГРЕДИЕНТЫ
Route::controller(IngredientController::class)->group(function () {
    Route::prefix('ingredients')->group(function () {
        Route::name('ingredients.')->group(function () {
            
            Route::get (            '/', 'index')->name( 'index');
            Route::get (      '/create', 'create')->name('create');
            Route::post( '/create/post', 'store')->name( 'create.store');
            Route::get ('/{ingredient}', 'show')->name(  'show');
    
        });
    
    });
});

//РЕЦЕПТЫ
Route::controller(RecipeController::class)->group(function () {
    Route::prefix('recipes')->group(function () {
        Route::name('recipes.')->group(function () {
            
            Route::get (               '/', 'index')->name( 'index');
            Route::get (         '/create', 'create')->name('create');
            Route::post(    '/create/post', 'store')->name( 'create.store');
            Route::get (       '/{recipe}', 'show')->name(  'instance');
            Route::get ('/update/{recipe}', 'updateRecipe')->name('update.recipe');
            Route::post ('/update', 'update')->name('update');
    
        });
    
    });
});






