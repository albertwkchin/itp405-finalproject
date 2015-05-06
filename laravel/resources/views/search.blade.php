@extends('layout')

@section('title')
Search Recipe
@stop

@section('content')

<h1>Recipe Search</h1>

<?php if (Session::has('success')): ?>
    <p class="success"><?php echo Session::get('success'); ?></p>
<?php endif; ?>

@foreach ($errors->all() as $error)
<p> {{ $error }} </p>
@endforeach

<div>
    <form action="/search_results" method="get">
        <div class="form-group">
            <label for="recipe_name">Recipe Name | Keywords</label>
            <input type="text" id="recipe_name" name="recipe_name" class="form-control" value="{{Request::old('recipe_name')}}">
        </div>
        <input type="submit" value="Search">
    </form>
</div>

@stop