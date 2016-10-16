<html>
    <head>
        <link rel="stylesheet" type="text/css" href="styles/style.css">
        <link href="https://fonts.googleapis.com/css?family=Baloo+Paaji" rel="stylesheet">
    </head>
    <body>
        <div class = "overlay2">
            <h1 class = "form">Add Artist</h1>
            <form action="added_artist.php" method="post">
                <div>
                    <label for="artist_name">Artist Name: </label>
                    <input type="text" id="artist_name" name="artist_name" required/>
                </div>
                <div class="button">
                    <button type="submit">Submit</button>
                </div>
            </form>
            <a href="index.php"><h2>Go Back to Library</h2></a>
        </div>
    </body>
</html>