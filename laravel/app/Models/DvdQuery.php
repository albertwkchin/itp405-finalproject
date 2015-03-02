<?php namespace App\Models;

use DB;
use Validator;

class DvdQuery {

    public function search($params) {


        $query =  DB::table('dvds')
            ->select(
                DB::raw('dvds.id,
                         title,
                         rating_name,
                         genre_name,
                         label_name,
                         sound_name,
                         format_name,
                         DATE_FORMAT(release_date,"%m/%d/%Y") as release_date_f')
            )
            ->join('ratings', 'ratings.id', '=', 'dvds.rating_id')
            ->join('genres', 'genres.id', '=', 'dvds.genre_id')
            ->join('labels', 'labels.id', '=', 'dvds.label_id')
            ->join('sounds', 'sounds.id', '=', 'dvds.sound_id')
            ->join('formats', 'formats.id', '=', 'dvds.format_id');

        $params = (object) $params;

        $query->where('title', 'LIKE', '%' . $params->title . '%');

        if (isset($params->genre_id) && $params->genre_id != 0) {
            $query->where('genre_id', 'LIKE', '%' . $params->genre_id . '%');
        }

        if (isset($params->rating_id) && $params->rating_id != 0) {
            $query->where('rating_id', 'LIKE', '%' . $params->rating_id . '%' );
        }

        $query->orderBy('title', 'asc'); // 'asc' = ascending order, can do ascending/descending
        return $query->get();

    }

    public function getDvd($request)
    {
        $query =  DB::table('dvds')
            ->select(
                DB::raw('dvds.id,
                        title,
                        genre_name,
                        rating_name,
                        label_name,
                        sound_name,
                        format_name,
                        DATE_FORMAT(release_date,"%m/%d/%Y") as release_date_f')
            )
            ->join('genres', 'genres.id', '=', 'dvds.genre_id')
            ->join('ratings', 'ratings.id', '=', 'dvds.rating_id')
            ->join('labels', 'labels.id', '=', 'dvds.label_id')
            ->join('sounds', 'sounds.id', '=', 'dvds.sound_id')
            ->join('formats', 'formats.id', '=', 'dvds.format_id');

        //Make sure there is an input
        if($request) {
            if ($request != "" && isset($request)) {
                $query->where('dvds.id', '=', $request);
            }
        }
        $query->orderBy('title', 'asc');
        return $query->get();
    }


    public function getReviews($dvd_id){
        return DB::table('reviews')->where('reviews.dvd_id','=', $dvd_id)->get();
    }


    public function getGenres() {
        return DB::table('genres')->get();
    }


    public function getRatings() {
        return DB::table('ratings')->get();
    }

    public function createReview($input)
    {
        DB::table('reviews')->insert($input);
    }

    public function validate($input)
    {
        return Validator::make($input, [
            'title' => 'required|string|min:5',
            'rating' => 'required|integer|min:1|max:10',
            'description' => 'required|string|min:20',
            'dvd_id' => 'required|numeric'
        ]);
    }



} 