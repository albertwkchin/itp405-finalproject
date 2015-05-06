@extends('layout')

@section('title')
Add Recipe
@stop

@section('content')
<h1>Add a Recipe to the Database</h1>

<?php if (Session::has('success')): ?>
    <p class="success"><?php echo Session::get('success'); ?></p>
<?php endif; ?>

@foreach ($errors->all() as $error)
<p> {{ $error }} </p>
@endforeach

<form method="post">
    <input type="hidden" name="_token" value="{{csrf_token()}}">

    <div class="form-group">
        <label for="recipe_name">Recipe Name</label>
        <input type="text" id="recipe_name" name="recipe_name" class="form-control" value="{{Request::old('recipe_name')}}">
    </div>

    <div class="form-group">
        <label for="servings">Servings</label>
        <input type="text" id="servings" name="servings" class="form-control" value="{{Request::old('servings')}}">
    </div>

    <div class="form-group">
        <label for="prep_time"">Prep Time</label>
        <input type="text" id="prep_time" name="prep_time" class="form-control" value="{{Request::old('prep_time')}}">
    </div>

    <div class="form-group">
        <label for="ingredient_list">Ingredients (list with commas)</label>
        <input type="text" id="ingredient_list" name="ingredient_list" class="form-control" value="{{Request::old('ingredient_list')}}">
    </div>

    <input type="submit" value="Add Recipe" class="btn btn-primary">
</form>
@stop