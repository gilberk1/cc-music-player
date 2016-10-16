<?php
    include 'db_connection.php'; 

    $artist_name = $_POST["artist_name"];

    $sql = "SELECT * FROM artists";

    $check = FALSE;

    $result = $conn->query($sql);
    $resultArtists = array();

    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $resultArtists[] = $row;
        }
    }
   
    foreach($resultArtists as $artist) {           
        if(strtolower($artist['artist_name']) == strtolower($artist_name)) {
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
            <h2 class = "form">'<?php echo $artist_name; ?>' already exists in the music library.</h2>
            <?  }
                else {
                    $artist_name = str_replace("'", "''", $artist_name);

                    $sql = "INSERT INTO artists(artist_name)
                            VALUES('$artist_name')";

                    if($conn->query($sql) === TRUE) {}
            ?>
            <h2 class = "form">You have added '<?php echo $artist_name; ?>' to the music library.</h2>
            <?
                } 
                
                $conn->close();
            ?>
            <a href="index.php"><h2>Go Back to Library</h2></a>
        </div>
    </body>
</html>