<?php

class RecipeTest extends TestCase {

    public function testValidateReturnsFalseIfRecipeNameIsMissing()
    {
        $validation = \App\Models\Recipe::validate([]);
        $this->assertEquals($validation->passes(), false);
    }

    public function testValidateReturnsTrueIfAllParametersAreValid()
    {
        $validation = \App\Models\Recipe::validate(
            [
                'recipe_name' => 'test_recipe',
                'servings' => 15,
                'prep_time' => 50,
                'ingredient_list' => 'tests, tests on tests, tests on tests on tests'
            ]);
        $this->assertEquals($validation->passes(), true);
    }


}