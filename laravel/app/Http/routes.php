<?php

use App\User;

Route::get('/', 'RecipeController@onStart');
Route::post('/', 'RecipeController@calculate');
Route::get('/add_recipe', 'RecipeController@add_page');
Route::get('/bookmarks', 'RecipeController@show_bookmarks');
Route::post('/add_recipe', 'RecipeController@add_recipe');
Route::get('/search', 'RecipeController@search_page');
Route::get('/search_results', 'RecipeController@yummly_search');

Route::group(['middleware' => 'auth'], function(){
    Route::post('/results', 'RecipeController@bookmark_recipe');
    Route::post('bookmark_recipe', 'RecipeController@bookmark_recipe');
    Route::post('/bookmarks', 'RecipeController@remove_bookmark');
});

/*~~~~~~~~~~~~~~~~~~~~~~~BEGIN USER MANAGEMENT FUNCTIONS~~~~~~~~~~~~~~~~~~~~~~~~~*/

Route::get('signup', function()
{
    return view('signup');
});


Route::post('signup', function()
{
    $validation = User::validate(Request::all());

    if ($validation->passes()) {
        $user = new User();
        $user->name = Request::input('name');
        $user->email = Request::input('email');
        $user->password = Hash::make(Request::input('password'));
        $user->save();

        Auth::loginUsingId($user->id);
        return redirect('dashboard');
    }

    return redirect('signup')->withInput()->withErrors($validation->errors());
});


Route::get('login', function()
{
    return view('login');
});


Route::post('login', function()
{
    $credentials = [
        'email' => Request::input('email'),
        'password' => Request::input('password')
    ];

    $remember_me = Request::input('remember_me') === 'on' ? true : false;

    if (Auth::attempt($credentials, $remember_me)) {

        if(Request::input('email') == "dtang@usc.edu" ||  Request::input('email') == "david@usc.edu" || Request::input('email') == "albertwkchin@gmail.com" )
        {
            return redirect('admin');
        }

        return redirect()->intended();
    }

    return redirect('login');
});


Route::get('admin', function()
{
    if(Auth::check())
    {
        return view('admin');
    }
    return redirect('login');
});


Route::get('dashboard', function()
{
    if (Auth::check()) {
        return view('dashboard');
    }

    return redirect('login');
});



Route::get('logout', function()
{
    Auth::logout();
    return redirect('login');
});

Route::get('manage', function()
{
    $users = User::all();

    return view('manage_users', [
        'users' => $users
    ]);
});

Route::get('user/create', function()
{
    return view('create_user');
});

Route::post('user/create', function()
{
    $validation = User::validate(Request::all());

    if ($validation->passes()) {
        $user = new User();
        $user->name = Request::input('name');
        $user->email = Request::input('email');
        $user->password = Hash::make(Request::input('password'));
        $user->save();

        return redirect('manage')
            ->with('success', '"' . $user->name . '" inserted successfully.');
    }
    return redirect('user/create')->withInput()->withErrors($validation->errors());
});

Route::get('user/{id}/edit', function($id)
{
    return view('edit_user');
});

Route::post('user/{id}/edit', function($id)
{
    $user = User::find($id);
    $user->name = Request::input('name');
    $user->email = Request::input('email');
    $user->password = Hash::make(Request::input('password'));
    $user->save();
    return redirect('manage')
        ->with('success', '"' . $user->name . '" edited successfully.');
});

Route::get('user/{id}/delete', function($id)
{
    $user = User::find($id);
    $user->delete();
    return redirect('manage')
        ->with('success', '"' . $user->name . '" deleted successfully.');
});