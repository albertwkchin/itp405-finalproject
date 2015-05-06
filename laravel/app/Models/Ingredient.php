<?php

namespace App\Models;
use DB;
use Validator;
//use \App\Services\YummlyApi;

class Ingredient
{
    public static function validate($input)
    {
        $required = [
            'ingredient_name' => 'required',
            'measure' => 'required|integer',
            'units' => 'required',
        ];

        return Validator::make($input, $required);
    }

    public function getIngredients()
    {
        return DB::table('ingredients')->get();
    }

    public function search($term)
    {
        $query = DB::table('ingredients')
            ->select(DB::raw('ingredients.id, ingredient_name, measure, units'));

        if($term
        && $term != ""
        && $term != "Search...")
        {
            $query->where('ingredient_name', 'LIKE', '%'. $term .'%');
        }

        $query->orderBy('ingredient_name');
        return $query->get();
    }

    public function insert($ingredient)
    {
        DB::table('ingredients')->insert($ingredient);
    }
}