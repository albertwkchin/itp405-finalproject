<!doctype html>

<html>
<head>
    <title>Dvd Search</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
</head>

<body>



    <div class = "sidebar" style =
        "width: 30%;
        float: left;
        margin-left: 5px;" >
        <h1>Search By Genre</h1>
        <?php foreach($genres as $genre) : ?>
            <div class = "sidebarEntry">
                <a href = "genres/<?php echo $genre->genre_name ?>/dvds">
                    <?php echo $genre->genre_name ?>
                </a>
            </div>
        <?php endforeach ?>
    </div>



    <div class = "normalSearch" style =
          "width: 70%;
          margin-right: 5px;" >
        <h1>Dvd Search</h1>
        <form action="/dvds/results" class = "form">
            <input type="text" name="dvd_title" placeholder="Title">

            <select name="genre_id">
                <?php foreach($genres as $genre) : ?>
                    <option value="<?php echo $genre->id ?>">
                        <?php echo $genre->genre_name ?>
                    </option>
                <?php endforeach ?>
                <option value="0">
                    All
                </option>
            </select>

            <select name="rating_id">
                <?php foreach($ratings as $rating) : ?>
                    <option value="<?php echo $rating->id ?>">
                        <?php echo $rating->rating_name ?>
                    </option>
                <?php endforeach ?>
                <option value="0">
                    All
                </option>
            </select>

            <input type="submit" name="submit">
        </form>
    </div>



</body>

</html>