<!DOCTYPE html>
<html>
<head>
    <title>
        DVD Review
    </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
</head>

<body>



    <div class="container">
        <table class="table">
            <thead>
            <tr>
                <th>Title</th>
                <th>Genre</th>
                <th>Rating</th>
                <th>Label</th>
                <th>Sound</th>
                <th>Format</th>
                <th>Release Date</th>
            </tr>
            </thead>
            <tbody>

                <tr>
                    <td>{{ $dvds->title }}</td>
                    <td>{{ $dvds->genre_name }}</td>
                    <td>{{ $dvds->rating_name }}</td>
                    <td>{{ $dvds->label_name }}</td>
                    <td>{{ $dvds->sound_name }}</td>
                    <td>{{ $dvds->format_name }}</td>
                    <td>{{ $dvds->release_date_f }}</td>
                </tr>

            </tbody>
        </table>
    </div>

    @if (Session::has('success'))
        <h2 style="color:black">{{ Session::get('success') }}</h2>
    @endif
    @foreach ($errors->all() as $error)
        <h3 style="color:red">{{ $error }}</h3>
    @endforeach

    <div>
        <h2> Submit a Review: </h2>
        <form action="{{url("dvds")+$id}}" method="get">
            <span> Rating: </span>
            <select name="rating">
                @for ($i=1;$i<=10;$i++)
                    @if ($i == Request::old('rating'))
                        <option  selected="1"  value="{{$i}}">{{$i}}</option>
                    @else
                        <option value="{{$i}}">{{$i}}</option>
                    @endif
                @endfor
            </select>
            <span> Review Title: </span>
            <input name="title" type="text" placeholder="Enter Title" value="{{ Request::old('title') }}">
            <span> Description: </span>
            <input name="description" type="text" placeholder="Please write a description of the DVD here!" value="{{ Request::old('description') }}">
            <input name="dvd_id" type="hidden" value="{{$id}}">
            <input type="submit"name="submit" value="Submit">
        </form>
    </div>


    <div>
        <h2> Complete Reviews: </h2>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Description</th>
                <th>Rating</th>
                <th>DVD_ID</th>
                <th>Review ID</th>
                <th>Title</th>
            </tr>
            </thead>
            <tbody>
            @if (Session::has('reviews'))
                @foreach (Session::get('reviews') as $review)
                <tr>
                    <td>{{$review->description}}</td>
                    <td>{{$review->rating}}</td>
                    <td>{{$review->dvd_id}}</td>
                    <td>{{$review->id}}</td>
                    <td>{{$review->title}}</td>
                </tr>
                @endforeach
            @else
                <tr> <td>There are currently no reviews for this DVD.</td></tr>
            @endif
            </tbody>
        </table>
    </div>

    @if($rottenTomatoes)
    <div>
        <img src="{{$rottenTomatoes['poster']}}">
    </div>
    <table class="table">
        <thead>
        <tr>
            <th>Critic Score</th>
            <th>Audience Score</th>
            <th>Runtime</th>
            <th>Cast</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>{{ $rottenTomatoes['critic_score'] }}</td>
            <td>{{ $rottenTomatoes['audience_score'] }}</td>
            <td>{{ $rottenTomatoes['runtime'] }} m</td>
            <td>{{ $rottenTomatoes['cast'] }}</td>
        </tr>
        </tbody>
    </table>
    @else
    <table class="table">
        <thead>
            <th>Description</th>
        </thead>
        <tbody>
        <tr>
            <td>Rotten Tomatoes was unable to find this movie in its database.</td>
        </tr>
        </tbody>
    </table>
    @endif


</body>




</html>


