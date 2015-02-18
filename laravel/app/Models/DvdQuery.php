<?php namespace App\Models;

use DB;

class DvdQuery {

    public function search($params) {


        $query =  DB::table('dvds')
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

    public function getGenres() {
        return DB::table('genres')->get();
    }

    public function getRatings() {
        return DB::table('ratings')->get();
    }

} 