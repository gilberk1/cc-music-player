<!-- Deleted Album Page -->

<?php
    include 'db_connection.php'; 

    /* GET the album id to Delete Album */

    $album_id = $_GET['album_id'];

    /* Grab everything from the albums table. While going through
        all results, place the album that matches the album id
        into the album_name variable. */

    $sql = "SELECT * FROM albums";

    $result = $conn->query($sql);

    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if($row['id'] == $album_id) {
                $album_name = $row['album_name'];
            }
        }
    }

    /* Grab everything from the songs table. While going through
        all results, place the songs in which the album that
        matches the album id into the songFiles array. */

    $sql = "SELECT * FROM songs";

    $result = $conn->query($sql);
    $songFiles = array();

    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if($row['album_id'] == $album_id) {
                $songFiles[] = $row['music'];
            }
        }
    }

    /* DELETE the album chosen */

    $sql = "DELETE FROM albums WHERE id=$album_id";

    if($conn->query($sql) === TRUE) {}

    /* DELETE the songs that are under that album */

    $sql = "DELETE FROM songs WHERE album_id=$album_id";

    if($conn->query($sql) === TRUE) {}

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

            <h2 class = "form">You have deleted '<?php echo $album_name; ?>' from the music library.</h2>
            <a href="index.php"><h2>Go Back to Library</h2></a>
        </div>
    </body>
</html>