<!-- Added Album Page -->

<?php
    include 'db_connection.php';

    /* POST the artist id and album name */

    $artist_id = $_POST["choose_artist"];
    $album_name = $_POST["album_name"];

    /* When album submit is pressed and the image size of the
        artwork is the correct size, add slashes, get contents,
        and encode the image. */
    
    if(isset($_POST['album_submit'])) {
        if(getimagesize($_FILES['artwork']['tmp_name']) == TRUE) {
            $artwork = addslashes($_FILES['artwork']['tmp_name']);
            $artwork = file_get_contents($artwork);
            $artwork = base64_encode($artwork);
        }
    }

    /* Check to make sure that the album does not exist anywhere
        else in the database through comparison by getting all
        the albums and putting them in an array. Then, compare the
        entered album name with every album name in the database. */

    $sql = "SELECT * FROM albums";

    $check = FALSE;

    $result = $conn->query($sql);
    $resultAlbums = array();

    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $resultAlbums[] = $row;
        }
    }
   
    foreach($resultAlbums as $album) {           
        if(strtolower($album['album_name']) == strtolower($album_name)) {
            $check = TRUE;
        }
    }
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="styles/style.css">
        <link href="https://fonts.googleapis.com/css?family=Baloo+Paaji" rel="stylesheet">
    </head>
    <body>
        <div class = "overlay2">
            <?php

                /* if album already exists */
            
                if($check) {
            ?>

            <!-- Output if the album already exists in the database -->

            <h2 class = "form">'<?php echo $album_name; ?>' already exists in the music library.</h2>
            <?php
                }
                else {

                    /* INSERT the information into the database */

                    $album_name = str_replace("'", "''", $album_name);

                    $sql = "INSERT INTO albums(artist_id, album_name, artwork)
                            VALUES('$artist_id', '$album_name', '$artwork')";
                            
                    if($conn->query($sql) === TRUE) {}
            ?>

            <!-- Output if the album doesn't exist in the database -->

            <h2 class = "form">You have added '<?php echo $album_name; ?>' to the music library.</h2>
            <?php
                }
                $conn->close();
            ?>
            <a href="index.php"><h2>Go Back to Library</h2></a>
        </div>
    </body>
</html>