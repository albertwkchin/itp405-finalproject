@extends('layout')

@section('content')
<div class="content" id="content">

    <meta charset="UTF-8">

    <style>
        #page-wrap { width: 300px; margin: 50px auto; padding: 20px; background: white; -moz-box-shadow: 0 0 20px black; -webkit-box-shadow: 0 0 20px black; box-shadow: 0 0 20px black; }
        p { font: 15px/2 Georgia, Serif; margin: 0 0 30px 0; text-indent: 40px; }
        #greetings { width: 400px; margin: 50px auto; padding: 20px; background: darkgrey; -moz-box-shadow: 0 0 20px black; -webkit-box-shadow: 0 0 20px black; box-shadow: 0 0 20px black; }
        p { font: 15px/2 Georgia, Serif; margin: 0 0 30px 0; text-indent: 40px; }}
    </style>
    </head>

    <body>

    <div id="page-wrap">
        <h1>d a s h b o a r d</h1>

    </div>

    <div id="greetings">
        <h3><h3>Welcome <?php echo Auth::user()->name?>.</h3></h3>
    </div>

</div>
<div class ="container">
    <h2><a href="{{url('logout')}}">Logout</a></h2>
</div>
@stop