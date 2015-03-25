<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dvd;
use Validator;
use App\Services\RottenTomatoes;


class DvdController extends Controller {

    public function search() {

        $genres = (new Dvd)->getGenres();
        $ratings = (new Dvd)->getRatings();
        return view('search', [
            'genres' => $genres,
            'ratings' => $ratings
        ]);
    }

    public function results(Request $request) {
        if (!$request->input('dvd_title')) {
            return redirect('/dvds/search');
        }

        $query = new Dvd();
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

    public function review(Request $request){

        $dvdID = $request->segment(2);
        $path = $request->path();
        $dvdQuery = new Dvd();
        $dvds = $dvdQuery->getDvd($dvdID);
        $rottenTomatoes = (new RottenTomatoes)->search($dvds->title);

        //dd($dvd);
        if($request->all()){
            $validator = $dvdQuery->validate($request->all());
            if ($validator->passes()) {
                $dvdQuery->createReview([
                    'title' => $request->input('title'),
                    'rating' => $request->input('rating'),
                    'dvd_id' => $request->input('dvd_id'),
                    'description' => $request->input('description')
                ]);

                $reviews = $dvdQuery->getReviews($request->input('dvd_id'));
                return redirect($path)->with([
                    'reviews' => $reviews,
                    'success' => 'Review added to database.'
                ]);
            }
            // if it fails pass back error messages to display in red
            else {
                return redirect($path)->withErrors($validator)->withInput();
            }
        }
        else{
            return view('review', [
                'rottenTomatoes' => $rottenTomatoes,
                'dvds' => $dvds,
                'id' => $dvdID
            ]);
        }
    }

    public function create(Request $request) {


        return view('create', [

        ]);
    }


}
