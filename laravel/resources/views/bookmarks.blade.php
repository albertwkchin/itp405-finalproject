@extends('layout')

@section('title')
Add Food
@stop

@section('content')

<h1>Bookmarked Recipes</h1>

<?php if (Session::has('success')): ?>
    <p class="success"><?php echo Session::get('success'); ?></p>
<?php endif; ?>

@foreach ($errors->all() as $error)
<p> {{ $error }} </p>
@endforeach

@if($bookmarks)

<head>
    <link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
    <style type="text/css">
        * {
            margin: 0;
            padding: 0;
        }
        body {
            background: url(images/noise_light-grey.jpg);
            font-family: 'Helvetica Neue', arial, sans-serif;
            font-weight: 200;
        }

        h1 {
            font-family: 'Oswald', sans-serif;
            font-size: 4em;
            font-weight: 400;
            margin: 0 0 20px;
            text-align: center;
            text-shadow: 1px 1px 0 #fff, 2px 2px 0 #bbb;
        }
        hr {
            border-top: 1px solid #ccc;
            border-bottom: 1px solid #fff;
            margin: 25px 0;
            clear: both;
        }
        .centered {
            text-align: center;
        }
        .wrapper {
            width: 100%;
            padding: 30px 0;
        }
        .container {
            width: 1200px;
            margin: 0 auto;
        }
        ul.grid-nav {
            list-style: none;
            font-size: .85em;
            font-weight: 200;
            text-align: center;
        }
        ul.grid-nav li {
            display: inline-block;
        }
        ul.grid-nav li a {
            display: inline-block;
            background: #999;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 4px;
            -moz-border-radius: 4px;
            -webkit-border-radius: 4px;
        }
        ul.grid-nav li a:hover {
            background: #7b0;
        }
        ul.grid-nav li a.active {
            background: #333;
        }
        .grid-container {
            display: none;
        }
        /* ----- Image grids ----- */
        ul.rig {
            list-style: none;
            font-size: 0px;
            margin-left: -2.5%; /* should match li left margin */
        }
        ul.rig li {
            display: inline-block;
            padding: 10px;
            margin: 0 0 2.5% 2.5%;
            background: #fff;
            border: 1px solid #ddd;
            font-size: 16px;
            font-size: 1rem;
            vertical-align: top;
            box-shadow: 0 0 5px #ddd;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
        }
        ul.rig li img {
            max-width: 100%;
            height: auto;
            margin: 0 0 10px;
        }
        ul.rig li h3 {
            margin: 0 0 5px;
        }
        ul.rig li p {
            font-size: .9em;
            line-height: 1.5em;
            color: #999;
        }
        /* class for 2 columns */
        ul.rig.columns-2 li {
            width: 47.5%; /* this value + 2.5 should = 50% */
        }
        /* class for 3 columns */
        ul.rig.columns-3 li {
            width: 30.83%; /* this value + 2.5 should = 33% */
        }
        /* class for 4 columns */
        ul.rig.columns-4 li {
            width: 22.5%; /* this value + 2.5 should = 25% */
        }

        @media (max-width: 1199px) {
            .container {
                width: auto;
                padding: 0 10px;
            }
        }

        @media (max-width: 480px) {
            ul.grid-nav li {
                display: block;
                margin: 0 0 5px;
            }
            ul.grid-nav li a {
                display: block;
            }
            ul.rig {
                margin-left: 0;
            }
            ul.rig li {
                width: 100% !important; /* over-ride all li styles */
                margin: 0 0 20px;
            }
        }
    </style>
</head>

<body>

<div class="wrapper">
    <div class="container">
        <ul class="grid-nav">
            <li><a href="#" data-id="two-columns" class="active">2 Columns</a></li>
            <li><a href="#" data-id="three-columns">3 Columns</a></li>
            <li><a href="#" data-id="four-columns">4 Columns</a></li>
        </ul>

        <hr />

        <div id="two-columns" class="grid-container" style="display:block;">
            <ul class="rig columns-2">
                @foreach ($bookmarks as $bookmark)
                <li>
                    <img src="<?php echo $bookmark->image_url?>"/>
                    <h3><a href="<?php echo $bookmark->source_url ?>"><?php echo $bookmark->recipe_name ?></a></h3>
                    <h5>Serves {{$bookmark->servings}}; Prep Time: {{$bookmark->prep_time/60}} minutes</h5>
                    <h5>Recipe By: {{$bookmark->created_by}}</h5>
                    <h6>Ingredients: </h6>
                    <p><?php echo $bookmark->ingredient_list ?></p>
                    <form method="post">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input type="hidden" name="id" value="{{$bookmark->id}}">
                        <button type="submit" class="bookmark">Remove Bookmark</button>
                    </form>
                </li>
                @endforeach
            </ul>
        </div>
        <!--/#two-columns-->

        <div id="three-columns" class="grid-container">
            <ul class="rig columns-3">
                @foreach ($bookmarks as $bookmark)
                <li>
                    <img src="<?php echo $bookmark->image_url?>"/>
                    <h3><a href="<?php echo $bookmark->source_url ?>"><?php echo $bookmark->recipe_name ?></a></h3>
                    <h5>Serves {{$bookmark->servings}}; Prep Time: {{$bookmark->prep_time/60}} minutes</h5>
                    <h5>Recipe By: {{$bookmark->created_by}}</h5>
                    <h6>Ingredients: </h6>
                    <p><?php echo $bookmark->ingredient_list ?></p>
                    <form method="post">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input type="hidden" name="id" value="{{$bookmark->id}}">
                        <button type="submit" class="bookmark">Remove Bookmark</button>
                    </form>
                </li>
                @endforeach
            </ul>
        </div>
        <!--/#three-columns-->

        <div id="four-columns" class="grid-container">
            <ul class="rig columns-4">
                @foreach ($bookmarks as $bookmark)
                <li>
                    <img src="<?php echo $bookmark->image_url?>"/>
                    <h3><a href="<?php echo $bookmark->source_url ?>"><?php echo $bookmark->recipe_name ?></a></h3>
                    <h5>Serves {{$bookmark->servings}}; Prep Time: {{$bookmark->prep_time/60}} minutes</h5>
                    <h5>Recipe By: {{$bookmark->created_by}}</h5>
                    <h6>Ingredients: </h6>
                    <p><?php echo $bookmark->ingredient_list ?></p>
                    <form method="post">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input type="hidden" name="id" value="{{$bookmark->id}}">
                        <button type="submit" class="bookmark">Remove Bookmark</button>
                    </form>
                </li>
                @endforeach
            </ul>
        </div>
        <!--/#four-columns-->

        <hr />

    </div>
    <!--/.container-->
</div>
<!--/.wrapper-->

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.grid-nav li a').on('click', function(event){
            event.preventDefault();
            $('.grid-container').fadeOut(500, function(){
                $('#' + gridID).fadeIn(500);
            });
            var gridID = $(this).attr("data-id");

            $('.grid-nav li a').removeClass("active");
            $(this).addClass("active");
        });
    });
</script>

</body>


@else
<h1>Looks like you don't have any bookmarked recipes yet. Why not search up some recipes to add to your bookmarks?</h1>
<a href="search"> Find some recipes! </a>
@endif

@stop