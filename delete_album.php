<?php
    include 'db_connection.php'; 

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
                $sql = "SELECT * FROM albums";

                $result = $conn->query($sql);

                if($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        if($row['id'] == $album_id) {
                            $album_name = $row['album_name'];
            ?>
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