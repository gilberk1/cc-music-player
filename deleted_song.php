<?php
    include 'db_connection.php'; 

    $song_id = $_GET['song_id'];

    $sql = "SELECT * FROM songs";

    $result = $conn->query($sql);

    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if($row['id'] == $song_id) {
                $song_name = $row['song_name'];
                $song_file = $row['music'];
            }
        }
    }

    $sql = "DELETE FROM songs WHERE id=$song_id";

    if($conn->query($sql) === TRUE) {}

    if(is_file($song_file)) {
        unlink($song_file);
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
            <h2 class = "form">You have deleted '<?php echo $song_name; ?>' from the music library.</h2>
            <a href="index.php"><h2>Go Back to Library</h2></a>
        </div>
    </body>
</html>