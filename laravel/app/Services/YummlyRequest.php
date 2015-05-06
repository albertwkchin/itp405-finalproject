<?php namespace App\Services;


use Illuminate\Support\Facades\Cache;


class YummlyRequest {

    public static function search($request)
    {
        $searchParams = urlencode($request);

        // Check if in cache
        if (Cache::has("rt-$searchParams")) {
            return Cache::get("rt-$searchParams");
        }

        $appID = '63a37004';
        $appKey = '17994c6ca258e4e8fe47717039ba9e6a';
        $url = 'http://api.yummly.com/v1/api/recipes?_app_id=' . $appID . '&_app_key=' . $appKey . '&q=' . $searchParams;
        $json = file_get_contents($url);

        $recipeMatches = json_decode($json, true);


        $data = array();

        // Make 2nd API call to get more specific info for each recipe

        //dd ($recipeMatches['matches']);
        foreach($recipeMatches['matches'] as $recipe) {
            $recipe_id = $recipe['id'];
            $new_url = 'http://api.yummly.com/v1/api/recipe/' . $recipe_id . '?_app_id=' . $appID . '&_app_key=' . $appKey;
            $new_json = file_get_contents($new_url);

            $data[] = json_decode($new_json, true);
        }

        //dd ($data);

        Cache::put("rt-$searchParams", $data, 60);
        return $data;
    }

  };