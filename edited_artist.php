<?php
    include 'db_connection.php'; 

    $artist_id = $_GET['artist_id'];
    
    $artist_name = $_POST["artist_name"];
    $artist_name = str_replace("'", "''", $artist_name);

    $sql = "UPDATE artists
            SET artist_name='$artist_name'
            WHERE id='$artist_id'";

    if($conn->query($sql) === TRUE) {}

    $conn->close();
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="styles/style.css">
        <link href="https://fonts.googleapis.com/css?family=Baloo+Paaji" rel="stylesheet">
    </head>
    <body>
        <div class = "overlay2">
            <h2 class = "form">You have edited '<?php echo $artist_name; ?>' in the music library.</h2>
            <a href="index.php"><h2>Go Back to Library</h2></a>
        </div>
    </body>
</html>