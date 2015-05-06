<?php

namespace App\Models;
use DB;
use Validator;
use Auth;

class Recipe
{
    public static function validate($input)
    {
        $required = [
            'recipe_name' => 'required|unique:recipes',
            'servings' => 'required',
            'prep_time' => 'required',
            'ingredient_list' => 'required'
        ];

        return Validator::make($input, $required);
    }

    public static function validateBookmarks($input)
    {
        $user_id = Auth::user()->id;
        $required  = [
            'recipe_name' => 'required|unique:bookmarked_recipes,recipe_name,NULL,id,user_id,' . $user_id,
            'servings' => 'required',
            'prep_time' => 'required',
            'ingredient_list' => 'required'
        ];

        return Validator::make($input, $required);
    }

    public function getRecipes()
    {
        return DB::table('recipes')->get();
    }

    public static function removeBookmarkById($id)
    {
        DB::table('bookmarked_recipes')
            ->select(DB::raw('bookmarked_recipes.id, recipe_name, created_by, image_url, source_url, servings, prep_time, ingredient_list, user_id'))
            ->where('id', '=', $id)
            ->delete();
    }

    public static function getBookmarkedRecipes($user_id)
    {
        $bookmarks = DB::table('bookmarked_recipes')
            ->select(DB::raw('bookmarked_recipes.id, recipe_name, created_by, image_url, source_url, servings, prep_time, ingredient_list, user_id'))
            ->where('user_id', '=', $user_id);

        $bookmarks->orderBy('recipe_name');

        return $bookmarks->get();
    }

    public static function searchName($name)
    {
        $query = DB::table('recipes')
            ->select(DB::raw('recipes.id, recipe_name, created_by, image_url, source_url, servings, prep_time, ingredient_list'));
        if( $name
            && $name != ""
            && $name != "Search...")
        {
            $query->where('recipe_name', 'LIKE', '%'. $name .'%');
        }

        $query->orderBy('recipe_name');
        return $query->get();
    }

    public static function search($term)
    {
        $query = DB::table('recipes')
            ->select(DB::raw('recipes.id, recipe_name, created_by, image_url, source_url, servings, prep_time, ingredient_list'));

        if( $term
         && $term != ""
         && $term != "Search...")
        {
            $query->where('recipe_name', 'LIKE', '%'. $term .'%');
        }

        $query->orderBy('recipe_name');
        return $query->get();
    }

    public static function isInRecipes($recipeName)
    {
        $query = DB::table('recipes')
            ->select(DB::raw('recipes.id, recipe_name, created_by, image_url, source_url, servings, prep_time, ingredient_list'));

        if( $recipeName
            && $recipeName != ""
            && $recipeName != "Search...")
        {
            $query->where('recipe_name', 'LIKE', '%'. $recipeName .'%')
                  ->get();
        }

        if (count($query) > 0)
        {
            return true;
        }
        else
        {
            return false;
        }

    }


    public static function isInBookmarks($recipeName)
    {
        $query = DB::table('bookmarked_recipes')
            ->select(DB::raw('bookmarked_recipes.id, recipe_name, created_by, image_url, source_url, servings, prep_time, ingredient_list, user_id'));

        if( $recipeName
            && $recipeName != ""
            && $recipeName != "Search...")
        {
            $query->where('recipe_name', 'LIKE', '%'. $recipeName .'%')
                  ->where('user_id', '=',  Auth::user()->id)
                  ->get();
        }

        if (count($query) > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public static function searchBookmark($term)
    {
        $query = DB::table('recipes')
            ->select(DB::raw('recipes.id, recipe_name, created_by, image_url, source_url, servings, prep_time, ingredient_list'));

        if( $term
            && $term != ""
            && $term != "Search...")
        {
            $query->where('recipe_name', 'LIKE', '%'. $term .'%');
        }

        $query->orderBy('recipe_name');
        return $query->get();
    }

    public function insert($recipe)
    {
        DB::table('recipes')->insert($recipe);
    }

    public function insertBookmark($recipe)
    {
        DB::table('bookmarked_recipes')->insert($recipe);
    }
}