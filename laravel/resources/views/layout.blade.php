<!DOCTYPE html>
<html>
<head>
    <title>RecipeBuilder</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

</head>
<body>

<style>
    * { margin: 0; padding: 0; }

    #content.container {
        background-image: #ffffff url(bg.jpg) no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
    }
</style>

<nav class="navbar navbar-default" role="navigation">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
    </div>
    <a class="navbar-brand" href="/">RecipeBuilder</a>
    <div class="navbar-collapse collapse">
        <ul class="nav navbar-nav navbar-left">
        </ul>
        <ul class="nav navbar-nav navbar-right">

            @if(Auth::check())
            <li><a href="/dashboard">Home</a></li>
            <li><a href="/add_recipe">Add Recipe</a></li>
            <li><a href="/bookmarks">Bookmarked Recipes</a></li>
            <li><a href="/search">Search Recipes</a></li>
            <li><a href="/logout">Logout</a></li>
            @else
            <li><a href="/login">Log In</a></li>
            <li><a href="/signup">Register</a></li>
            @endif

        </ul>
    </div>
</nav>

<div class="container" id="content">
    @yield('content')
</div>

</body>
</html>