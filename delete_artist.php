<!-- Delete Album Page -->

<?php
    include 'db_connection.php'; 

    /* GET the artist id to Delete Artist */

    $artist_id = $_GET['artist_id'];
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="styles/style.css">
        <link href="https://fonts.googleapis.com/css?family=Baloo+Paaji" rel="stylesheet">
    </head>
    <body>
        <div class = "overlay2">
            <?php
                /* Grab everything from the artists table.
                    While going through all results,
                    place the artist that matches the
                    artist id into the artist_name variable.
                    Echo the artist_name to the screen. */
                $sql = "SELECT * FROM artists";

                $result = $conn->query($sql);

                if($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        if($row['id'] == $artist_id) {
                            $artist_name = $row['artist_name'];
            ?>

            <!-- Delete Confirmation -->

            <h2 class = "you-sure">Are you sure you want to delete '<?php echo $artist_name; ?>'<br/>and the attached albums and songs?</h2>
            <?php
                        }
                    }
                }
                $delete_artist = 'deleted_artist.php?artist_id=' . $artist_id . '';
            ?>
            <div class = "buttons">
                <a href="index.php"><button>No</button></a>
                <a href = "<?php echo $delete_artist; ?>"><button>Yes</button></a>
            </div>
            <a href="index.php"><h2>Go Back to Library</h2></a>
        </div>
    </body>
</html>