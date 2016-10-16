<?php
    include 'db_connection.php';

    $album_id = $_POST["choose_album"];
    $song_name = $_POST["song_name"];
    $track = $_POST["track"];

    $name = $_FILES['music']['name'];
    $original = array(' ', "'");
    $new = array("_", "_");
    $name = str_replace($original, $new, $name);

    $uploadfile = "media/" . $name;

    $sql = "SELECT * FROM songs";

    $check = FALSE;

    $result = $conn->query($sql);
    $resultSongs = array();

    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $resultSongs[] = $row;
        }
    }
   
    foreach($resultSongs as $song) {           
        if(strtolower($song['song_name']) == strtolower($song_name)) {
            $check = TRUE;
        }
    }
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="styles/style.css">
        <link href="https://fonts.googleapis.com/css?family=Baloo+Paaji" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
        <script type = "text/javascript" src = "js/main.js"></script>
    </head>
    <body>
        <div class = "overlay2">
            <?
                if($check) {
            ?>
            <h2 class = "form">'<?php echo $song_name; ?>' already exists in the music library.</h2>
            <? }
                else {
                    move_uploaded_file($_FILES['music']['tmp_name'], $uploadfile);

                    $song_name = str_replace("'", "''", $song_name);

                    $sql = "INSERT INTO songs(album_id, track, song_name, music)
                            VALUES('$album_id', '$track', '$song_name', '$uploadfile')";
                                            
                    if($conn->query($sql) === TRUE) {}
            ?>
            <h2 class = "form">You have added '<?php echo $song_name; ?>' to the music library.</h2>
            <?        
                    $conn->close();
                }
            ?>
            <a href="index.php"><h2>Go Back to Library</h2></a>
        </div>
    </body>
</html>