<?php
include "koneksi.php";
session_start();
$userid = $_SESSION['userid'];
if (!isset($_SESSION['userid'])) {
    header("location:login.php");
}
?>

</html>

<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
</head>

<body>
<nav  class="navbar navbar-expand-sm bg-dark navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">Website Gallery Photo</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav me-auto">
                    <?php
                    if (!isset($_SESSION['userid'])) {
                    ?>
                        <a href="register.php" class="btn btn-outline-success m-1">Register</a>
                        <a href="login.php" class="btn btn-outline-primary m-1">Login</a>
                    <?php
                    } else {
                    ?>
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="home.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="album.php">Album</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="foto.php">Photo</a>
                        </li>

                    </ul>
                    <div class="d-flex align-items-right">
                            <a href="logout.php">
                            <button type="button" class="btn btn-outline-danger me-2">
                                Log out
                            </button>
                            </a>
                        </div>                 
                        
                    <?php
                    }
                    ?>
                </div>

            </div>
        </div>
    </nav>
    <div class="container mt-3">
        Album:
        <?php
        $album = mysqli_query($conn, "select * from album where userid='$userid'");
        while ($row = mysqli_fetch_array($album)) { ?>
            <a href="home.php?albumid=<?php echo $row['albumid'] ?>" class="btn btn-outline-secondary"><?php echo $row['namaalbum'] ?></a>
        <?php } ?>
        <div class="row">
            <?php
            if (isset($_GET['albumid'])) {
                $albumid = $_GET['albumid'];
                $query = mysqli_query($conn, "select * from foto where userid='$userid' and albumid='$albumid'");
                while ($data = mysqli_fetch_array($query)) { ?>
                    <div class="col-md-3 mt-2">
                        <div class="card">
                            <img src="gambar/<?= $data['lokasifile'] ?>" class="card-img-top" title="" style="height: 20rem;" alt="">
                            <div class="card-footer text-center">
                                <?php
                                $fotoid = $data['fotoid'];
                                $ceksuka = mysqli_query($conn, "select * from likefoto where fotoid='$fotoid' and userid='$userid'");
                                if (mysqli_num_rows($ceksuka) == 1) { ?>
                                    <a href="like.php?fotoid=<?= $data['fotoid'] ?>" name="batalsuka"><i class="fa fa-heart"></i></a>
                                <?php } else { ?>
                                    <a href="like.php?fotoid=<?= $data['fotoid'] ?>" name="suka"><i class="fa-regular fa-heart"></i></a>
                                <?php }
                                $like = mysqli_query($conn, "select * from likefoto where fotoid='$fotoid'");
                                echo mysqli_num_rows($like) . ' Suka';
                                ?>
                                <a href="komentar.php?fotoid=<?= $data['fotoid'] ?>"><i class="fa-regular fa-comment"></i></a>Comment
                            </div>
                        </div>
                        <br>
                    </div>
                <?php }
            } else {
                $sql = mysqli_query($conn, "select * from foto where userid='$userid'");
                while ($data = mysqli_fetch_array($sql)) {
                ?>
                    <div class="col-md-3 mt-2">
                        <div class="card">
                            <img src="gambar/<?= $data['lokasifile'] ?>" class="card-img-top" title="" style="height: 20rem;" alt="">
                            <div class="card-footer text-center">
                                <?php
                                $fotoid = $data['fotoid'];
                                $ceksuka = mysqli_query($conn, "select * from likefoto where fotoid='$fotoid' and userid='$userid'");
                                if (mysqli_num_rows($ceksuka) == 1) { ?>
                                    <a href="like.php?fotoid=<?= $data['fotoid'] ?>" name="batalsuka"><i class="fa fa-heart"></i></a>
                                <?php } else { ?>
                                    <a href="like.php?fotoid=<?= $data['fotoid'] ?>" name="suka"><i class="fa-regular fa-heart"></i></a>
                                <?php }
                                $like = mysqli_query($conn, "select * from likefoto where fotoid='$fotoid'");
                                echo mysqli_num_rows($like) . ' Suka';
                                ?>
                                <a href="komentar.php?fotoid=<?= $data['fotoid'] ?>"><i class="fa-regular fa-comment"></i></a> Comment
                            </div>
                        </div>
                        <br>
                    </div>
            <?php
                }
            }
            ?>
        </div>
    </div>


    <footer class="d-flex justify-content-center border-top mt-3 bg-light fixed-bottom">
    <p>&copy; Selamat Datang Di Website Photo Gallery | Yuli Astuti UKK 2024</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>