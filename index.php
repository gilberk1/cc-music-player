<html>
    <head>
        <link rel="stylesheet" type="text/css" href="styles/style.css">
        <link href="https://fonts.googleapis.com/css?family=Baloo+Paaji" rel="stylesheet">
    </head>
    <body>
        <div class = "overlay">
            <h1>Music Player<button onclick = "window.location.href = 'add_artist.php'">Add Artist</button></h1>
            <?php
                include 'db_connection.php';

                $sql = "SELECT * FROM artists
                        ORDER BY artist_name";
                $result = $conn->query($sql);
                $resultArtists = array();

                if($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $resultArtists[] = $row;
                    }
                }

                $sql = "SELECT * FROM albums
                        ORDER BY album_name";
                $result = $conn->query($sql);
                $resultAlbums = array();

                if($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $resultAlbums[] = $row;
                    }
                }

                $sql = "SELECT * FROM songs
                        ORDER BY track";
                $result = $conn->query($sql);
                $resultSongs = array();

                if($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $resultSongs[] = $row;
                    }
                }

                foreach($resultArtists as $artist) {
                    $add_artist = 'add_album.php?artist_id='.$artist['id'].'';
                    $edit_artist = 'edit_artist.php?artist_id='.$artist['id'].'';
                    $delete_artist = 'delete_artist.php?artist_id='.$artist['id'].'';
                ?>
                <hr><h2><?php echo $artist['artist_name']; ?>
                <a href = "<?php echo $add_artist; ?>"><button>Add Album</button></a>
                <a href = "<?php echo $edit_artist; ?>"><button>Edit Artist</button></a>
                <a href = "<?php echo $delete_artist; ?>"><button>Delete Artist</button></a></h2><hr>
                <?    
                    foreach($resultAlbums as $album) {
                        if($artist['id'] == $album['artist_id']) {
                        $add_album = 'add_song.php?album_id='.$album['id'].'';
                        $edit_album = 'edit_album.php?album_id='.$album['id'].'';
                        $delete_album = 'delete_album.php?album_id='.$album['id'].'';
                ?>
                <div class = "album">
                    <img src = "data:artwork;base64,<?php echo $album['artwork']; ?>">
                    <h3><?php echo $album['album_name']; ?></h3>
                    <div class = "buttons">
                        <a href = "<?php echo $add_album; ?>"><button>Add Song</button></a>
                        <a href = "<?php echo $edit_album; ?>"><button>Edit Album</button></a>
                        <a href = "<?php echo $delete_album; ?>"><button>Delete Album</button></a>
                    </div>
                </div>
                <?
                            foreach($resultSongs as $song) {
                                if($album['id'] == $song['album_id']) {
                                $edit_song = 'edit_song.php?song_id='.$song['id'].'';
                                $delete_song = 'delete_song.php?song_id='.$song['id'].'';
                ?>
                <div class = "music">
                    <h4><?php echo $song['track'] . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $song['song_name']?></h4>
                    <audio controls id = "<?php echo $song['song_name']; ?>" src = "/<?php echo $song['music']; ?>"></audio>
                </div>
                <div class = "buttons">
                    <a href = "<?php echo $edit_song; ?>"><button>Edit Song</button></a>
                    <a href = "<?php echo $delete_song; ?>"><button>Delete Song</button></a>
                </div>
                <?
                                }
                            }
                        }
                    }
                }

                $conn->close();
            ?>
            <h5>All items in this music player are licensed under Creative Commons Attribution License on Soundcloud.<br/>
                This music player is created purely for educational purposes.<br/>
                Any songs added after launching are left to the user and I ask for them to be Creative Commons only.</h5>
            <hr style="margin-bottom: 0">
        </div>
    </body>
</html>