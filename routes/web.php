<?php




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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



Route::get('Posts/{category}', 'PostController@showCat');
Route::get('Posts/{category}/{id}', 'PostController@show');
Route::resource('Posts', 'PostController');


Route::get('Replies/create/{post_id}', 'RepliesController@create');
Route::resource('Replies', 'RepliesController');


Route::get('Rank/{id}/ban', 'RankController@showBanUserForm');
Route::put('Rank/{id}/banned', 'RankController@banUser');
Route::resource('Rank', 'RankController');


Route::get('AdminPanel/approve/{id}', 'AdminPanelController@approve');
Route::get('AdminPanel/reject/{id}', 'AdminPanelController@reject');
Route::get('AdminPanel/suspended', 'AdminPanelController@suspended_posts');
Route::resource('AdminPanel', 'AdminPanelController');

Route::resource('Category', 'CategoryController');

// Chat routes

Route::resource('Chat', 'ChatController');


Route::get('Friends/store/{id}', 'FriendsController@store');
Route::resource('Friends', 'FriendsController');


