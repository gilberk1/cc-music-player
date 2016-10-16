<?php
    include 'db_connection.php'; 

    $song_id = $_GET['song_id'];
    
    $album_id = $_POST["choose_album"];
    $song_name = $_POST["song_name"];
    $song_name = str_replace("'", "''", $song_name);
    $track = $_POST["track"];

    $sql = "SELECT * FROM songs";

    $result = $conn->query($sql);

    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if($row['id'] == $song_id) {
                $original_file = $row['music'];
            }
        }
    }
    if ($_FILES['music']['size'] == 'undefined') {
        $sql = "UPDATE songs
                SET album_id='$album_id', song_name='$song_name', track = '$track'
                WHERE id='$song_id'";
        if($conn->query($sql) === TRUE) {}
    }
    else {
        $name = $_FILES['music']['name'];
        $original = array(' ', "'");
        $new = array("_", "_");
        $name = str_replace($original, $new, $name);

        $uploadfile = "media/" . $name;

        move_uploaded_file($_FILES['music']['tmp_name'], $uploadfile);

        if(is_file($original_file)) {
            unlink($original_file);
        }

        $sql = "UPDATE songs
                SET album_id='$album_id', song_name='$song_name', track = '$track', music = '$uploadfile'
                WHERE id='$song_id'";
        if($conn->query($sql) === TRUE) {}
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
            <h2 class = "form">You have edited '<?php echo $song_name; ?>' in the music library.</h2>
            <a href="index.php"><h2>Go Back to Library</h2></a>
        </div>
    </body>
</html>