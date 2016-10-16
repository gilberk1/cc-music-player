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

    $sql = "SELECT * FROM songs";

    $result = $conn->query($sql);
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

    $sql = "DELETE FROM artists WHERE id=$artist_id";

    if($conn->query($sql) === TRUE) {}

    $sql = "DELETE FROM albums WHERE artist_id=$artist_id";

    if($conn->query($sql) === TRUE) {}

    foreach($resultSongs as $song) {
        $sql = "DELETE FROM songs WHERE id=$song";
        
        if($conn->query($sql) === TRUE) {}
    }

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
            <h2 class = "form">You have deleted '<?php echo $artist_name; ?>' from the music library.</h2>
            <a href="index.php"><h2>Go Back to Library</h2></a>
        </div>
    </body>
</html>