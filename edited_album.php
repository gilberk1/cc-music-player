<!-- Edited Album Page -->

<?php
    include 'db_connection.php'; 

    /* GET the album id to select the Chosen Album */

    $album_id = $_GET['album_id'];
    
    /* POST the artist id and album name */

    $artist_id = $_POST["choose_artist"];
    $album_name = $_POST["album_name"];
    $album_name = str_replace("'", "''", $album_name);

    /* If artwork was not uploaded, UPDATE artist_id and album_name.
        If artwork was uploaded, UPDATE artist_id, album_name, and artwork. */

    if ($_FILES['artwork']['size'] == 'undefined') {
        $sql = "UPDATE albums
                SET artist_id='$artist_id', album_name='$album_name'
                WHERE id='$album_id'";
        if($conn->query($sql) === TRUE) {}
    }
    else {
        if(isset($_POST['album_update'])) {
            if(getimagesize($_FILES['artwork']['tmp_name']) == TRUE) {
                $artwork = addslashes($_FILES['artwork']['tmp_name']);
                $artwork = file_get_contents($artwork);
                $artwork = base64_encode($artwork);
            }
        }
        $sql = "UPDATE albums
                SET artist_id='$artist_id', album_name='$album_name', artwork='$artwork'
                WHERE id='$album_id'";
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

            <!-- Edit Confirmation -->

            <h2 class = "form">You have edited '<?php echo $album_name; ?>' in the music library.</h2>
            <a href="index.php"><h2>Go Back to Library</h2></a>
        </div>
    </body>
</html>