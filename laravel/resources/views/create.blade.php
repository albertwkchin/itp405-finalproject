<!doctype html>

<html>
<head>
    <title>Add DVD</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
</head>

<body>


<div class="container">
    <div class="row">
        <div>
            @foreach ($errors->all() as $error)
            <div class="alert alert-danger" role="alert"> {{ $error }} </div>
            @endforeach
            @if (Session::has('success'))
            <div class="alert alert-success" role="alert"> {{ Session::get('success') }} </div>
            @endif
            <form method="post" class="dvd-create" action="{{ url('dvds') }}">
                <div class="input-group dvd-create">

                    <input type="hidden"  name="_token" value="{{ csrf_token() }}">

                    <input type="text" class="form-control" name="title" placeholder="DVD Title">


                        <select name="genre_id" class="selectpicker">
                            <option value="0">
                                Genres
                            </option>
                            @foreach($genres as $genre)
                            <option value="{{ $genre->id }}"> {{ $genre->genre_name }}</option>;
                            @endforeach
                        </select>
                        <select name="label_id" class="selectpicker">
                            <option value="0">
                                Labels
                            </option>
                            @foreach($labels as $label)
                            <option value="{{ $label->id }}"> {{ $label->label_name }}</option>;
                            @endforeach
                        </select>
                        <select name="rating_id" class="selectpicker">
                            <option value="0">
                                Ratings
                            </option>
                            @foreach($ratings as $rating)
                            <option value="{{ $rating->id }}"> {{ $rating->rating_name }}</option>;
                            @endforeach
                        </select>
                        <select name="format_id" class="selectpicker">
                            <option value="">
                                Formats
                            </option>
                            @foreach($formats as $format)
                            <option value="{{ $format->id }}"> {{ $format->format_name }}</option>;
                            @endforeach
                        </select>
                        <select name="sound_id" class="selectpicker">
                            <option value="0">
                                Sounds
                            </option>
                            @foreach($sounds as $sound)
                            <option value="{{ $sound->id }}"> {{ $sound->sound_name }}</option>;
                            @endforeach
                        </select>



                    <button class="btn btn-default" type="submit" name="submit">
                        Add DVD
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>




</body>

</html>