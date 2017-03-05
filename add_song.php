<!-- Add Song Page -->

<?php
    include 'db_connection.php'; 

    /* GET the album id to show the Chosen Album */

    $album_id = $_GET['album_id'];
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="styles/style.css">
        <link href="https://fonts.googleapis.com/css?family=Baloo+Paaji" rel="stylesheet">
    </head>
    <body>
        <div class = "overlay2">
            <h1 class = "form">Add Song</h1>

            <!-- Add Song Form -->

            <form action="added_song.php" method="post" enctype = "multipart/form-data">

                <!-- Show Chosen Album -->

                <div>
                    <label for="choose_album">Chosen Album: </label>
                    <select id="choose_album" name = "choose_album" hidden required>
                        <?php
                            /* Grab everything from the albums table.
                                While going through all results,
                                place the album that matches the
                                album id into the album_name
                                variable. Place it into the hidden
                                select and echo the album_name to the
                                screen. */

                            $sql = "SELECT * FROM albums";

                            $result = $conn->query($sql);

                            if($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    if($row['id'] == $album_id) {
                                        $album_name = $row['album_name'];
                            ?>
                                <option value = "<?php echo $album_id; ?>" selected><?php echo $album_name; ?></option>
                            <?php
                                    }
                                }
                            }

                            $conn->close();
                        ?>
                    </select>
                    <h3><?php echo $album_name; ?></h3>
                </div>

                <!-- Enter Song Name -->

                <div>
                    <label for="song_name">Song Name: </label>
                    <input type="text" id="song_name" name="song_name" required/>
                </div>

                <!-- Enter Track Number -->

                <div>
                    <label for="track">Track Number: </label>
                    <input type="number" id="track" name="track" required/>
                </div>

                <!-- Upload Song File -->

                <div>
                    <label for="music">Upload Song File: </label>
                    <input type="file" id="music" name="music" accept = "audio/*" required/>
                </div>
                <div class="button">
                    <button type="submit" name = "submit">Submit</button>
                </div>
            </form>
            <a href="index.php"><h2>Go Back to Library</h2></a>
        </div>
    </body>
</html>