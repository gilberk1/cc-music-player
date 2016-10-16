<?php
    include 'db_connection.php'; 

    $artist_id = $_GET['artist_id'];
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="styles/style.css">
        <link href="https://fonts.googleapis.com/css?family=Baloo+Paaji" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
        <script type = "text/javascript" src = "js/main.js"></script>
    </head>
    <body>
        <div class = "overlay2">
            <h1 class = "form">Add Album</h1>
            <form id = "album_form" action="added_album.php" method="post" enctype = "multipart/form-data">
                <div>
                    <label for="choose_artist">Chosen Artist: </label>
                    <select id="choose_artist" name = "choose_artist" hidden required>
                        <?php
                            $sql = "SELECT * FROM artists";

                            $result = $conn->query($sql);

                            if($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    if($row['id'] == $artist_id) {
                                        $artist_name = $row['artist_name'];
                            ?>
                                <option value = "<?php echo $artist_id; ?>" selected><?php echo $artist_name; ?></option>
                            <?php
                                    }
                                }
                            }

                            $conn->close();
                        ?>
                    </select>
                    <h3><?php echo $artist_name; ?></h3>
                </div>
                <div>
                    <label for="album_name">Album Name: </label>
                    <input type="text" id="album_name" name="album_name" required/>
                </div>
                <div>
                    <label for="artwork">Upload Album Artwork (keep under 1MB): </label>
                    <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
                    <input type="file" id="artwork" name="artwork" accept = "image/*" required/>
                </div>
                <div class="button">
                    <button type="button" name = "album_submit" id = "album_submit">Submit</button>
                </div>
            </form>
            <a href="index.php"><h2>Go Back to Library</h2></a>
        </div>
    </body>
</html>