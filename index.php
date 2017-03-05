<!-- Library Page -->

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

                /* Grab all artists ordered by artist name
                    and save them into a resultArtists array. */

                $sql = "SELECT * FROM artists
                        ORDER BY artist_name";
                $result = $conn->query($sql);
                $resultArtists = array();

                if($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $resultArtists[] = $row;
                    }
                }

                /* Grab all albums ordered by album name
                    and save them into a resultAlbums array. */

                $sql = "SELECT * FROM albums
                        ORDER BY album_name";
                $result = $conn->query($sql);
                $resultAlbums = array();

                if($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $resultAlbums[] = $row;
                    }
                }

                /* Grab all songs ordered by track number
                    and save them into a resultSongs array. */

                $sql = "SELECT * FROM songs
                        ORDER BY track";
                $result = $conn->query($sql);
                $resultSongs = array();

                if($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $resultSongs[] = $row;
                    }
                }

                /* Create Add Album, Edit Artist, and Delete Artist
                    links for each artist in the library. */

                foreach($resultArtists as $artist) {
                    $add_artist = 'add_album.php?artist_id='.$artist['id'].'';
                    $edit_artist = 'edit_artist.php?artist_id='.$artist['id'].'';
                    $delete_artist = 'delete_artist.php?artist_id='.$artist['id'].'';
                ?>

                <!-- Place Add Album, Edit Artist, and Delete Artist
                    buttons for each artist in the library. -->

                <hr><h2><?php echo $artist['artist_name']; ?>
                <a href = "<?php echo $add_artist; ?>"><button>Add Album</button></a>
                <a href = "<?php echo $edit_artist; ?>"><button>Edit Artist</button></a>
                <a href = "<?php echo $delete_artist; ?>"><button>Delete Artist</button></a></h2><hr>
                <?php    

                    /* Create Add Song, Edit Album, and Delete 
                    Album links for each album in the library. */

                    foreach($resultAlbums as $album) {
                        if($artist['id'] == $album['artist_id']) {
                        $add_album = 'add_song.php?album_id='.$album['id'].'';
                        $edit_album = 'edit_album.php?album_id='.$album['id'].'';
                        $delete_album = 'delete_album.php?album_id='.$album['id'].'';
                ?>

                <!-- Place Album Artwork, Add Song, Edit Album, and
                Delete Album buttons for each album in the library. -->
                
                <div class = "album">
                    <img src = "data:artwork;base64,<?php echo $album['artwork']; ?>">
                    <h3><?php echo $album['album_name']; ?></h3>
                    <div class = "buttons">
                        <a href = "<?php echo $add_album; ?>"><button>Add Song</button></a>
                        <a href = "<?php echo $edit_album; ?>"><button>Edit Album</button></a>
                        <a href = "<?php echo $delete_album; ?>"><button>Delete Album</button></a>
                    </div>
                </div>
                <?php

                            /* Create Edit Song and Delete Song
                            links for each song in the library. */

                            foreach($resultSongs as $song) {
                                if($album['id'] == $song['album_id']) {
                                $edit_song = 'edit_song.php?song_id='.$song['id'].'';
                                $delete_song = 'delete_song.php?song_id='.$song['id'].'';
                ?>

                <!-- Place Song File, Edit Song, and Delete Album
                buttons for each album in the library. -->

                <div class = "music">
                    <h4><?php echo $song['track'] . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $song['song_name']?></h4>
                    <audio controls id = "<?php echo $song['song_name']; ?>" src = "/<?php echo $song['music']; ?>"></audio>
                </div>
                <div class = "buttons">
                    <a href = "<?php echo $edit_song; ?>"><button>Edit Song</button></a>
                    <a href = "<?php echo $delete_song; ?>"><button>Delete Song</button></a>
                </div>
                <?php
                                }
                            }
                        }
                    }
                }

                $conn->close();
            ?>
            <hr style="margin-bottom: 0">
        </div>
    </body>
</html>