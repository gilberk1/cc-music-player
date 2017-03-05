<!-- Deleted Song Page -->

<?php
    include 'db_connection.php'; 

    /* GET the song id to Delete Song */

    $song_id = $_GET['song_id'];

    /* Grab everything from the songs table. While going through
        all results, place the song that matches the song id
        into the song_name and song_file variables. */

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

    /* DELETE the song chosen */

    $sql = "DELETE FROM songs WHERE id=$song_id";

    if($conn->query($sql) === TRUE) {}

    /* UNLINK the songs that are in the folder */

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

            <!-- Delete Confirmation -->

            <h2 class = "form">You have deleted '<?php echo $song_name; ?>' from the music library.</h2>
            <a href="index.php"><h2>Go Back to Library</h2></a>
        </div>
    </body>
</html>