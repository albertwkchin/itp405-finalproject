<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DvdQuery;

class DvdController extends Controller {

    public function search() {

        $genres = (new DvdQuery)->getGenres();
        $ratings = (new DvdQuery)->getRatings();
        return view('search', [
            'genres' => $genres,
            'ratings' => $ratings
        ]);
    }

    public function results(Request $request) {
        if (!$request->input('dvd_title')) {
            return redirect('/dvds/search');
        }

        $query = new DvdQuery();
        $dvds = $query->search([
            'title' => $request->input('dvd_title'),
            'genre_id' => $request->input('genre_id'),
            'rating_id' => $request->input('rating_id')
        ]);

        return view('results', [
            'dvd_title' => $request->input('dvd_title'),
            'dvds' => $dvds
        ]);
    }

}
