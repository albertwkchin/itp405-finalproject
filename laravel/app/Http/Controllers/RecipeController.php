<?php

namespace App\Http\Controllers;

use \App\Models\Recipe;
use \App\Models\Ingredient;
use Illuminate\Http\Request;
use \App\Services\YummlyRequest;
use Auth;

class RecipeController extends Controller
{
    public function onStart()
    {
        $recipes = (new Recipe())->getRecipes();
        $ingredients = (new Ingredient())->getIngredients();

        return view('home_page', [
            'recipes' => $recipes,
            'ingredients' => $ingredients
        ]);
    }

    public function add_page()
    {
        return view('add_recipe');
    }

    public function add_recipe(Request $request)
    {
        $RecipeEntry = new Recipe();

        if($request->all())
        {
            $validator = $RecipeEntry->validate($request->all());
            if($validator->passes())
            {
                $RecipeEntry->insert([
                    'recipe_name' => $request->input('recipe_name'),
                    'created_by' => Auth::user()->name,
                    'image_url' => 'http://lightspeedautomation.com/wp-content/uploads/2013/07/custom-food-group1-150x150.jpg',
                    'source_url' => 'http://archive.firstcoastnews.com/images/640/360/2/assetpool/images/131022095856_dog.jpg',
                    'servings' => $request->input('servings'),
                    'prep_time' => $request->input('prep_time'),
                    'ingredient_list' => $request->input('ingredient_list')
                ]);

                return redirect('add_recipe')
                    ->with('success', '"' . $request->input('recipe_name') . '" was successfully inserted into the database.');
            }

            return redirect('add_recipe')->withErrors($validator)->withInput();

        }


    }

    public function bookmark_recipe(Request $request)
    {
        $recipe = new Recipe();
      //  if (!$recipe->isInBookmarks($request->input('recipe_name')))
      //  {
        if($request->all())
        {
            $validator = $recipe->validateBookmarks($request->all());
            if($validator->passes())
            {
                $recipe->insertBookmark([
                    'user_id' => Auth::user()->id,
                    'recipe_name' => $request->input('recipe_name'),
                    'created_by' => $request->input('created_by'),
                    'image_url' => $request->input('image_url'),
                    'source_url' => $request->input('source_url'),
                    'servings' => $request->input('servings'),
                    'prep_time' => $request->input('prep_time'),
                    'ingredient_list' => $request->input('ingredient_list')
                ]);

                return redirect('bookmarks')
                    ->with('success', '"' . $request->input('recipe_name') . '" was successfully bookmarked.');
            }

            return redirect('bookmarks')->withErrors($validator)->withInput();
        }


      //  }

      //  else
      //  {
      //      return redirect('dashboard');
      //  }
    }

    /*
    public function add_ingredient()
    {
        return view('add_ingredient');
    }

    public function insert_ingredient(Request $request)
    {
        $IngredientEntry = new Ingredient();

        if($request->all())
        {
            $validator = $IngredientEntry->validate($request->all());
            if($validator->passes())
            {
                $IngredientEntry->insert([

                ]);

                return redirect('add_ingredient')
                    ->with('success', '"' . $request->input('name') . '" inserted successfully.');
            }

            return redirect('add_ingredient')->withErrors($validator)->withInput();
        }
    }
    */

    public function search_page()
    {
        return view('search');
    }


    public function search(Request $request)
    {
        $recipes = Recipe::search($request->input('recipe_name'));
    }

    public function yummly_search(Request $request)
    {
        $recipes = YummlyRequest::search($request->input('recipe_name'));
        // dd($recipes);

        // now search the database too
        $dbRecipes = Recipe::searchName($request->input('recipe_name'));

        return view('results', [
            'recipes' => $recipes,
            'dbRecipes' => $dbRecipes
        ]);

    }

    public function show_bookmarks()
    {
        $user_id = Auth::user()->id;

        $bookmarks = Recipe::getBookmarkedRecipes($user_id);
        // dd($bookmarks);

        return view('bookmarks',[
            'bookmarks' => $bookmarks
        ]);
    }

    public function remove_bookmark(Request $request)
    {
        $id = $request->input('id');

        Recipe::removeBookmarkById($id);

        return redirect('bookmarks');
    }

}