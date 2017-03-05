<!-- Added Artist Page -->

<?php
    include 'db_connection.php'; 

    /* POST the artist name */

    $artist_name = $_POST["artist_name"];

    /* Check to make sure that the artist does not exist anywhere
        else in the database through comparison by getting all
        the artists and putting them in an array. Then, compare the
        entered artist name with every artist name in the database. */

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
            <?php

                /* if artist already exists */

                if($check) {
            ?>

            <!-- Output if the artist already exists in the database -->

            <h2 class = "form">'<?php echo $artist_name; ?>' already exists in the music library.</h2>
            <?php
                }
                else {

                    /* INSERT the information into the database */

                    $artist_name = str_replace("'", "''", $artist_name);

                    $sql = "INSERT INTO artists(artist_name)
                            VALUES('$artist_name')";

                    if($conn->query($sql) === TRUE) {}
            ?>

            <!-- Output if the artist doesn't exist in the database -->

            <h2 class = "form">You have added '<?php echo $artist_name; ?>' to the music library.</h2>
            <?php
                } 
                
                $conn->close();
            ?>
            <a href="index.php"><h2>Go Back to Library</h2></a>
        </div>
    </body>
</html>