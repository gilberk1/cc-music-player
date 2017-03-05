<!-- Deleted Artist Page -->

<?php
    include 'db_connection.php';

    /* GET the artist id to Delete Artist */

    $artist_id = $_GET['artist_id'];

    /* Grab everything from the artists table. While going through
        all results, place the artist that matches the artist id
        into the artist_name variable. */

    $sql = "SELECT * FROM artists";

    $result = $conn->query($sql);

    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if($row['id'] == $artist_id) {
                $artist_name = $row['artist_name'];
            }
        }
    }
    
    /* Grab everything from the albums table. While going through
        all results, place the albums in which the artist that
        matches the artist id into the resultAlbums array. */

    $sql = "SELECT * FROM albums";

    $result = $conn->query($sql);
    $resultAlbums = array();

    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if($row['artist_id'] == $artist_id) {
                $resultAlbums[] = $row['id'];
            }
        }
    }

    /* Grab everything from the songs table. While going through
        all results, place the songs in which the album that
        matches the album id into the songFiles and resultSongs
        array. */

    $sql = "SELECT * FROM songs";

    $result = $conn->query($sql);
    $resultSongs = array();
    $songFiles = array();

    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            foreach($resultAlbums as $album) {
                if($row['album_id'] == $album) {
                    $songFiles[] = $row['music'];
                    $resultSongs[] = $row['id'];
                }
            }
        }
    }

    /* DELETE the artist chosen */

    $sql = "DELETE FROM artists WHERE id=$artist_id";

    if($conn->query($sql) === TRUE) {}

    /* DELETE the albums that are under that artist */

    $sql = "DELETE FROM albums WHERE artist_id=$artist_id";

    if($conn->query($sql) === TRUE) {}

    /* DELETE the songs that are under each album under the artist */

    foreach($resultSongs as $song) {
        $sql = "DELETE FROM songs WHERE id=$song";
        
        if($conn->query($sql) === TRUE) {}
    }

    /* UNLINK the songs that are in the folder */

    foreach($songFiles as $song) {
        chmod($song, 0777);
        if(is_file($song)) {
            unlink($song);
        }
    }

    $conn->close();
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="styles/style.css">
        <link href="https://fonts.googleapis.com/css?family=Baloo+Paaji" rel="stylesheet">
    </head>
    <body>
        <div class = "overlay2">

            <!-- Delete Confirmation -->

            <h2 class = "form">You have deleted '<?php echo $artist_name; ?>' from the music library.</h2>
            <a href="index.php"><h2>Go Back to Library</h2></a>
        </div>
    </body>
</html>