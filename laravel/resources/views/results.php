<!doctype html>

<html>
<head>
    <title>Results</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
</head>

<body>

<p>
    You searched for <?php echo $dvd_title ?>.
</p>

<table class = "table table-striped">
    <thead>
        <tr>
            <th>Title</th>
            <th>Review Link</th>
            <th>Rating</th>
            <th>Genre</th>
            <th>Label</th>
            <th>Sound</th>
            <th>Format</th>
            <th>Release Date</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($dvds as $dvd) : ?>
            <tr>
                <td><?php echo $dvd->title ?></td>
                <td>
                    <form method="get" action="/dvds/<?php echo $dvd->id?>">
                        <input type="submit" value="Review">
                    </form>
                </td>
                <td><?php echo $dvd->rating_name ?></td>
                <td><?php echo $dvd->genre_name ?></td>
                <td><?php echo $dvd->label_name ?></td>
                <td><?php echo $dvd->sound_name ?></td>
                <td><?php echo $dvd->format_name ?></td>
                <td><?php echo $dvd->release_date_f ?></td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>

</body>

</html>