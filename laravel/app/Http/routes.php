<?php

use App\Models\Dvd;
use App\Models\Genre;
use App\Models\Label;
use App\Models\Rating;
use App\Models\Sound;
use App\Models\Format;


use Illuminate\Http\Request;

Route::get('/', 'WelcomeController@index');

Route::post('/dvds', function(Request $request) {
    $dvd = new Dvd();
    $dvd->title = $request->input('title');
    $dvd->genre_id = $request->input('genre_id');
    $dvd->format_id = $request->input('format_id');
    $dvd->rating_id = $request->input('rating_id');
    $dvd->sound_id = $request->input('sound_id');
    $dvd->label_id = $request->input('label_id');
    if ($dvd->save()) {
        return redirect('dvds/create')->with('success', 'Dvd added to database successfully.');
    }
    else {
        return redirect('dvds/create')->withInput();
    }
});

//Route::get('/dvds/search', 'DvdController@search');
Route::get('/', 'DvdController@search');
Route::get('/dvds/search', function() {
    $allGenres = Genre::all();
    $allRatings = Rating::all();
    return view('search', [
       'genres' => $allGenres,
       'ratings' => $allRatings
    ]);
});

//Route::get('/dvds/create', 'DvdController@create');
Route::get('/dvds/create', function() {
    $allGenres = Genre::all();
    $allLabels = Label::all();
    $allRatings = Rating::all();
    $allSounds = Sound::all();
    $allFormats = Format::all();

    return view('create', [
       'genres' => $allGenres,
       'labels' => $allLabels,
       'ratings' => $allRatings,
       'sounds' => $allSounds,
       'formats' => $allFormats
    ]);
});


Route::get('/genres/{genre_name}/dvds', function($genre_name) {
    $genre = Genre::where('genre_name', '=', $genre_name)->first();
    $dvds = Dvd::where('genre_id', '=', $genre->id)
                ->with('rating')
                ->with('genre')
                ->with('label')
                ->with('sound')
                ->with('format')
                ->get();

    return view('genre',[
        'dvds' => $dvds,
        'genre' => $genre
    ]);
});


Route::get('/dvds/results', 'DvdController@results');
Route::get('/dvds/{id}', 'DvdController@review');
