<!DOCTYPE html>
<html>
<head>
    <title>RecipeBuilder</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
</head>
<body>

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
            <li><a href="/admin">Home</a></li>
            <li><a href="{{url('manage')}}">Manage Users</a></li>
            <li><a href="/add_recipe">Add Recipe</a></li>
            <li><a href="/bookmarks">Bookmarked Recipes</a></li>
            <li><a href="/search">Search Recipes</a></li>
            <li><a href="/logout">Logout</a></li>
            @else
            <li><a href="/login">Log In</a></li>
            <li><a href="/signup">Sign Up</a></li>
            @endif

        </ul>
    </div>
</nav>

<div class="container">
    <div class="content" id="content">

        <meta charset="UTF-8">

        <style>
            #page-wrap { width: 180px; margin: 50px auto; padding: 20px; background: white; -moz-box-shadow: 0 0 20px black; -webkit-box-shadow: 0 0 20px black; box-shadow: 0 0 20px black; }
            p { font: 15px/2 Georgia, Serif; margin: 0 0 30px 0; text-indent: 40px; }
            #greetings { width: 400px; margin: 50px auto; padding: 20px; background: darkgrey; -moz-box-shadow: 0 0 20px black; -webkit-box-shadow: 0 0 20px black; box-shadow: 0 0 20px black; }
            p { font: 15px/2 Georgia, Serif; margin: 0 0 30px 0; text-indent: 40px; }}
        </style>
        </head>

        <body>

        <div id="page-wrap">
            <h1>a d m i n</h1>
        </div>

        <div id="greetings">
            <h3><h3>Welcome <?php echo Auth::user()->name?>.</h3></h3>
        </div>

    </div>

    <div class ="container">
        <h2><a href="{{url('logout')}}">Logout</a></h2>
    </div>

</div>

</body>
</html>