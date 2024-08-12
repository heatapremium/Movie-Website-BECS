<?php
session_start();
if(!isset($_SESSION['email'])){
    session_destroy();
    header("location: login.php");
}
include("connect.php");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>CINEFLIX</title>
    <link rel="stylesheet" href="./css/movies.css" />
    <link rel="stylesheet" href="./css/style.min.css">
  </head>

  <body>
    <header>
        <div class="container flex">
            <a href="./index.php" class="logo"><h1>CINEFLEX</h1></a>
            <ul>
                <li><a href="./index.php">Home</a></li>
                <li><a href="./movies.php">Movies</a></li>
                <li class="active"><a href="./tvseries.php">TV Shows</a></li>
            </ul>
            <div class="user">
            <p>
                Hello, <?php 
                if(isset($_SESSION['email'])){
                    $email=$_SESSION['email'];
                    $query=mysqli_query($conn, "SELECT * FROM `users` WHERE email='$email'");
                    while($row=mysqli_fetch_array($query)){
                        echo $row['fname'].'!';
                    }
                }
                ?>
                </p>
                <a class="btn" href="logout.php">Logout</a>
            </div>
        </div>
    </header>
    <main>
      <div class="search-sec">
        <h2>Looking For Something?</h2>
        <input
              type="text"
              placeholder="Browse Here"
              class="search-input"
              id="search-input"
            />
      </div>
      <div class="container">
      <div class="categories">
        <section class="category">
          <div class="arrow-left" id="left-arrow-1">&#9664;</div>
          <h2>Action</h2>
          <div class="shows" id="shows-0"></div>
          <div class="arrow-right" id="right-arrow-1">&#9654;</div>
        </section>

        <section class="category">
          <div class="arrow-left" id="left-arrow-1">&#9664;</div>
          <h2>Adventure</h2>
          <div class="shows" id="shows-1"></div>
          <div class="arrow-right" id="right-arrow-1">&#9654;</div>
        </section>

        <section class="category">
          <div class="arrow-left" id="left-arrow-1">&#9664;</div>
          <h2>Animation</h2>
          <div class="shows" id="shows-2"></div>
          <div class="arrow-right" id="right-arrow-1">&#9654;</div>
        </section>

        <section class="category">
          <div class="arrow-left" id="left-arrow-1">&#9664;</div>
          <h2>Comedy</h2>
          <div class="shows" id="shows-3"></div>
          <div class="arrow-right" id="right-arrow-1">&#9654;</div>
          
        </section>

        <section class="category">
          <div class="arrow-left" id="left-arrow-1">&#9664;</div>
          <h2>Horror</h2>
          <div class="shows" id="shows-4"></div>
          <div class="arrow-right" id="right-arrow-1">&#9654;</div>
        </section>

      </div>

      <section class="search" id="search">
        <!-- <h2>Serach Result</h2> -->
        <div class="shows" id="search-result"></div>
      </section>
      </div>

    </main>
    <div class="loading-spinner" id="loading-spinner">
        <div class="spinner"></div>
      </div>
      <footer>
        <div class="container">
            <p>&copy <span id="year"></span> All Rights Reserved. Designed and Developed by CINEFLEX.INC</p>
        </div>
    </footer>
    <script>
      let year = new Date().getFullYear();
      document.getElementById("year").innerHTML = year;
    </script>
    <script src="./js/tv-series.js"></script>
  </body>
</html>
