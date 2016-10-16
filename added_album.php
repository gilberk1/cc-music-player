<?php
    include 'db_connection.php';

    $artist_id = $_POST["choose_artist"];
    $album_name = $_POST["album_name"];
    
    if(isset($_POST['album_submit'])) {
        if(getimagesize($_FILES['artwork']['tmp_name']) == TRUE) {
            $artwork = addslashes($_FILES['artwork']['tmp_name']);
            $artwork = file_get_contents($artwork);
            $artwork = base64_encode($artwork);
        }
    }

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
            <?
                if($check) {
            ?>
            <h2 class = "form">'<?php echo $album_name; ?>' already exists in the music library.</h2>
            <?  }
                else {
                    $album_name = str_replace("'", "''", $album_name);

                    $sql = "INSERT INTO albums(artist_id, album_name, artwork)
                            VALUES('$artist_id', '$album_name', '$artwork')";
                            
                    if($conn->query($sql) === TRUE) {}
            ?>
            <h2 class = "form">You have added '<?php echo $album_name; ?>' to the music library.</h2>
            <?
                }
                $conn->close();
            ?>
            <a href="index.php"><h2>Go Back to Library</h2></a>
        </div>
    </body>
</html>