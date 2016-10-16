<?php
    include 'db_connection.php'; 

    $album_id = $_GET['album_id'];

    $sql = "SELECT * FROM albums";

    $result = $conn->query($sql);

    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if($row['id'] == $album_id) {
                $artist_id = $row['artist_id'];
                $album_name = $row['album_name'];
                $artwork = $row['artwork'];
            }
        }
    }
    $edited_album = 'edited_album.php?album_id=' . $album_id . '';
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="styles/style.css">
        <link href="https://fonts.googleapis.com/css?family=Baloo+Paaji" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
        <script type = "text/javascript" src = "js/main.js"></script>
    </head>
    <body>
        <div class = "overlay">
            <h1 class = "form">Edit Album</h1>
            <form id = "album_form" action='<?php echo $edited_album; ?>' method="post" enctype = "multipart/form-data">
                <div>
                    <label for="choose_artist">Choose Artist: </label>
                    <select id="choose_artist" name = "choose_artist" required>
                        <?php
                            $sql = "SELECT * FROM artists";

                            $result = $conn->query($sql);

                            if($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    $other_artist_id = $row['id'];
                                    $artist_name = $row['artist_name'];
                                    if($row['id'] == $artist_id) {
                            ?>
                                <option value = "<?php echo $artist_id; ?>" selected><?php echo $artist_name; ?></option>
                            <?php
                                    }
                                    else {
                            ?>
                                <option value = "<?php echo $other_artist_id; ?>"><?php echo $artist_name; ?></option>
                            <?php
                                    }
                                }
                            }

                            $conn->close();
                        ?>
                    </select>
                </div>
                <div>
                    <label for="album_name">Album Name: </label>
                    <input type="text" id="album_name" name="album_name" value = "<?php echo $album_name; ?>" required/>
                </div>
                <div>
                    <label for="artwork">Update Album Artwork (keep under 1MB): </label>
                    <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
                    <input type="file" id="artwork" name="artwork" accept = "image/*"/>
                </div>
                <div>
                    <img src = "data:artwork;base64,<?php echo $artwork; ?>">
                    <h2>Current Album Artwork<h2>
                </div>
                <div class="button">
                    <button type="button" name = "album_update" id = "album_update">Submit</button>
                </div>
            </form>
            <a href="index.php"><h2>Go Back to Library</h2></a>
            <hr style="margin-bottom: 0">
        </div>
    </body>
</html>