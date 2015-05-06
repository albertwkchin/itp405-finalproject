@extends('layout')

@section('title')
Home
@stop

@section('content')

<div class="content" id="content">

        <meta charset="UTF-8">

        <style>
            * { margin: 0; padding: 0; }

            html {
                background: url(bg.jpg) no-repeat center center fixed;
                -webkit-background-size: cover;
                -moz-background-size: cover;
                -o-background-size: cover;
                background-size: cover;
            }

            #page-wrap { width: 380px; margin: 50px auto; padding: 20px; background: white; -moz-box-shadow: 0 0 20px black; -webkit-box-shadow: 0 0 20px black; box-shadow: 0 0 20px black; }
            p { font: 15px/2 Georgia, Serif; margin: 0 0 30px 0; text-indent: 40px; }
        </style>
    </head>

    <body>

    <div id="page-wrap">
        <h1>r e c i p e b u i l d e r</h1>
    </div>

</div>

@stop