<?php

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\TestController;
use App\Http\Controllers\InvokeController;

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
    return view('welcome');
});

Route::get('/command-make-user', function () {
    Artisan::call('command:make-user', [
        'name' => 'ndk',
        '--email' => 'ndk2@gmail.com'
    ]);
});

Route::get('/caching', function () {
    $value = Cache::remember('users', 600, function () {
        return DB::table('users')->get();
    });
    dd($value);
});

Route::get('/collections', function () {
    //Create collection
    $collectionExam = collect([1, 2, 3, 4]);

    //Macro
    Collection::macro('toUpperWithArg', function ($arg) {
        return $this->map(function ($value) use ($arg) {
            return Str::upper($value . $arg);
        });
    });
    $collection = collect(['first', 'second']);
    $upper = $collection->toUpperWithArg('Arg');

    //Method
});

//Controller
Route::get('/index', [TestController::class, 'index']);
Route::get('/invoke', InvokeController::class);
Route::resource('test-resource', \App\Http\Controllers\TestResourceController::class);
