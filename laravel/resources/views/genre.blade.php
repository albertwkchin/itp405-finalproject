<!doctype html>

<html>
<head>
    <title>Genre Filter</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
</head>

<body>

@if(isset($dvds))
		<div class = "sideBarResults">
			<table class = "table table-striped">
				<thead>
					<tr>
						<th>Title</th>
                        <th>Genre</th>
						<th>Rating</th>
						<th>Label</th>
					</tr>
				</thead>
				<tbody>
				@foreach ($dvds as $dvd)
                    <tr>
                        <td>{{$dvd->title}}</td>
                        <td>{{$dvd->genre->genre_name}}</td>
                        <td>{{$dvd->rating->rating_name}}</td>
                        <td>{{$dvd->label->label_name}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
@else
        <div class = "errorMessage" >
            ERROR! $dvd was not populated!
        </div>
@endif


</body>

</html>