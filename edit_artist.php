<?php
    include 'db_connection.php'; 

    $artist_id = $_GET['artist_id'];

    $sql = "SELECT * FROM artists";

    $result = $conn->query($sql);

    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if($row['id'] == $artist_id) {
                $artist_name = $row['artist_name'];
            }
        }
    }
    $edited_artist = 'edited_artist.php?artist_id=' . $artist_id . '';
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="styles/style.css">
        <link href="https://fonts.googleapis.com/css?family=Baloo+Paaji" rel="stylesheet">
    </head>
    <body>
        <div class = "overlay2">
            <h1 class = "form">Edit Artist</h1>
            <form action='<?php echo $edited_artist; ?>' method="post">
                <div>
                    <label for="artist_name">Artist Name: </label>
                    <input type="text" id="artist_name" name="artist_name" value = "<?php echo $artist_name; ?>" required/>
                </div>
                <div class="button">
                    <button type="submit">Submit</button>
                </div>
            </form>
            <a href="index.php"><h2>Go Back to Library</h2></a>
        </div>
    </body>
</html>