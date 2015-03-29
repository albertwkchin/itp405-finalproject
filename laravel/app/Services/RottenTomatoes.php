<?php namespace App\Services;


use Illuminate\Support\Facades\Cache;


class RottenTomatoes {

    public function search($dvd)
    {
        $dvd_title = urlencode($dvd);

        // Check if in cache
        if (Cache::has("rt-$dvd_title")) {
            return Cache::get("rt-$dvd_title");
        }

        $apikey = '5xc2hxz9sy245jznzpgzwn57';
        $url = 'http://api.rottentomatoes.com/api/public/v1.0/movies.json?page=1&apikey=' . $apikey . '&q=' . $dvd_title;
        $json = file_get_contents($url);
        $response = json_decode($json, true);
        $data = NULL;

        // Find the corresponding dvd
        foreach($response['movies'] as $movie) {
            if ( strcasecmp($movie['title'], $dvd_title) == 0 ) {
                $cast = '';
                foreach($movie['abridged_cast'] as $castMember) {
                    $cast .= $castMember['name'] . ', ';
                }
                $cast = substr($cast, 0, -2);
                $data =
                    [
                        'cast'              => $cast,
                        'poster'            => $movie['posters']['thumbnail'],
                        'runtime'           => $movie['runtime'],
                        'critic_score'      => $movie['ratings']['critics_score'],
                        'audience_score'    => $movie['ratings']['audience_score']
                    ];
                break;
            }
        }

        Cache::put("rt-$dvd_title", $data, 60);
        return $data;
    }
}