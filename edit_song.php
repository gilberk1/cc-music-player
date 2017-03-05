<!-- Edit Song Page -->

<?php
    include 'db_connection.php'; 

    /* GET the song id to get the Chosen Song */

    $song_id = $_GET['song_id'];

    /* Grab everything from the songs table.
        While going through all results,
        place the song that matches the
        song id into the album_id, song_name,
        track, and music variable. */

    $sql = "SELECT * FROM songs";

    $result = $conn->query($sql);

    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if($row['id'] == $song_id) {
                $album_id = $row['album_id'];
                $track = $row['track'];
                $song_name = $row['song_name'];
                $music = $row['music'];
            }
        }
    }
    $edited_song = 'edited_song.php?song_id=' . $song_id . '';
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="styles/style.css">
        <link href="https://fonts.googleapis.com/css?family=Baloo+Paaji" rel="stylesheet">
    </head>
    <body>
        <div class = "overlay2">
            <h1 class = "form">Edit Song</h1>

            <!-- Edit Song Form -->

            <form action="<?php echo $edited_song; ?>" method="post" enctype = "multipart/form-data">

                <!-- Show Chosen Album in Dropdown -->

                <div>
                    <label for="choose_album">Choose Album: </label>
                    <select id="choose_album" name = "choose_album" required>
                        <?php
                            /* Grab everything from the albums table.
                                While going through all results,
                                place the album that matches the
                                album id into the album_name
                                variable. Place the album_id into the
                                one that matches. However, if it does
                                not match, place it in the other_album_id. The one that matches will show up as the selected option
                                in the dropdown. */

                            $sql = "SELECT * FROM albums";

                            $result = $conn->query($sql);

                            if($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    $other_album_id = $row['id'];
                                    $album_name = $row['album_name'];
                                    if($row['id'] == $album_id) {
                            ?>
                                <option value = "<?php echo $album_id; ?>" selected><?php echo $album_name; ?></option>
                            <?php
                                    }
                                    else {
                            ?>
                                <option value = "<?php echo $other_album_id; ?>"><?php echo $album_name; ?></option>
                            <?php
                                    }
                                }
                            }

                            $conn->close();
                        ?>
                    </select>
                </div>

                <!-- Edit Song Name -->

                <div>
                    <label for="song_name">Song Name: </label>
                    <input type="text" id="song_name" name="song_name" value = "<?php echo $song_name; ?>" required/>
                </div>

                <!-- Edit Track Number -->

                <div>
                    <label for="track">Track Number: </label>
                    <input type="number" id="track" name="track" value = "<?php echo $track; ?>" required/>
                </div>

                <!-- Override Song File -->

                <div>
                    <label for="music">Update Song File: </label>
                    <input type="file" id="music" name="music" accept = "audio/*"/>
                </div>

                <!-- Show Current Song File -->

                <div>
                    <audio controls id = "<?php echo $song_name; ?>" src = "/<?php echo $music; ?>"></audio>
                    <h2>Current Song File<h2>
                </div>
                <div class="button">
                    <button type="submit" name = "submit">Submit</button>
                </div>
            </form>
            <a href="index.php"><h2>Go Back to Library</h2></a>
        </div>
    </body>
</html>