<?php
    include 'db_connection.php'; 

    $song_id = $_GET['song_id'];
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="styles/style.css">
        <link href="https://fonts.googleapis.com/css?family=Baloo+Paaji" rel="stylesheet">
    </head>
    <body>
        <div class = "overlay2">
            <?php
                $sql = "SELECT * FROM songs";

                $result = $conn->query($sql);

                if($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        if($row['id'] == $song_id) {
                            $song_name = $row['song_name'];
            ?>
            <h2 class = "you-sure">Are you sure you want to delete '<?php echo $song_name; ?>'?</h2>
            <?php
                        }
                    }
                }
                $delete_song = 'deleted_song.php?song_id=' . $song_id . '';
            ?>
            <div class = "buttons">
                <a href="index.php"><button>No</button></a>
                <a href = "<?php echo $delete_song; ?>"><button>Yes</button></a>
            </div>
            <a href="index.php"><h2>Go Back to Library</h2></a>
        </div>
    </body>
</html>