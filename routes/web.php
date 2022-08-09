<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BidController;
use App\Mail\TestMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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

Route::get('/sendmail', function () {
    $mailData = ['name' => 'Diana', 'age' => '26'];
    
    Mail::to('hello@example.com')->send(new TestMail($mailData));

    dd('Mail sent successfully');
});

Auth::routes();

//homecontroller
//intro page
Route::get('/', [HomeController::class, 'index']);


Route::middleware('auth')->group(function () {   
    
    //bid routes
    Route::controller(BidController::class)->group(function () {
 
    //read
    Route::get('/home', 'index')->name('bids');

    //create
    Route::get('/create', 'create')->name('bids');//post inputs
    Route::post('/create', 'store')->name('bids');//post inputs

    //edit

    //delete
    Route::get('/delete/{bid}', 'destroy')->name('bids');//delete selected
    });

});