<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use App\Events\TestEvent;
use App\Events\UserWasBanned;
use App\User;
use Illuminate\Support\Facades\App;

Route::get('/', function () {
    return view('index');
});

Route::resource('items', 'ItemController',
    ['except' => ['create', 'edit']]);

get('/userbanned', function () {
    $user = new User();
    $user->name = "Tom";

    event(new UserWasBanned($user));

});

get('/broadcast', function() {
    event(new TestEvent('Broadcasting in Laravel using Pusher!'));

    return view('welcome');
});

get('/bridge', function() {
    $pusher = App::make('pusher');

    $pusher->trigger( 'test-channel',
                      'test-event', 
                      array('text' => 'Preparing the Pusher Laracon.eu workshop!'));

    return view('welcome');
});