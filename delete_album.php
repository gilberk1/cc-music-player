<!-- Delete Album Page -->

<?php
    include 'db_connection.php'; 

    /* GET the album id to Delete Album */

    $album_id = $_GET['album_id'];
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="styles/style.css">
        <link href="https://fonts.googleapis.com/css?family=Baloo+Paaji" rel="stylesheet">
    </head>
    <body>
        <div class = "overlay2">
            <?php
                /* Grab everything from the albums table.
                    While going through all results,
                    place the album that matches the
                    album id into the album_name variable.
                    Echo the album_name to the screen. */

                $sql = "SELECT * FROM albums";

                $result = $conn->query($sql);

                if($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        if($row['id'] == $album_id) {
                            $album_name = $row['album_name'];
            ?>

            <!-- Delete Confirmation -->

            <h2 class = "you-sure">Are you sure you want to delete '<?php echo $album_name; ?>'<br/>and the attached songs?</h2>
            <?php
                        }
                    }
                }
                $delete_album = 'deleted_album.php?album_id=' . $album_id . '';
            ?>
            <div class = "buttons">
                <a href="index.php"><button>No</button></a>
                <a href = "<?php echo $delete_album; ?>"><button>Yes</button></a>
            </div>
            <a href="index.php"><h2>Go Back to Library</h2></a>
        </div>
    </body>
</html>