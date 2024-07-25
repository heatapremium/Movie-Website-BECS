<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cineflix</title>
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="stylesheet" href="./css/new-styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>

<body>
    <!-- Header Section -->
    <header>
        <nav>
            <div class="logo">CINEFLIX</div>
            <ul>
                <li><a href="./index.html">Home</a></li>
                <li><a href="./movies.html">Movies</a></li>
                <li><a href="./tv-series.html">TV Shows</a></li>
            </ul>
            <div class="search"> <input type="text" placeholder="Search" class="search-input">
                <div class="profile-icon"></div>
            </div>

        </nav>
    </header>

    <!-- Main Section -->
    <main>
        <section class="featured">
            <div class="featured-content">
                <h1>Beverly Hills Cop: <br>Axel F</h1>
                <p>2024</p>
                <p>Forty years after his unforgettable first case in Beverly Hills, Detroit cop Axel Foley returns to do
                    what he does best: solve crimes and cause chaos.</p>
                <button>Start watching</button>
            </div>
        </section>
        
        <section class="movies">
            <h2>Movies</h2>
            <div class="movie-list">
                <img src="https://image.tmdb.org/t/p/original/xeEw3eLeSFmJgXZzmF2Efww0q3s.jpg" alt="Movie 1">
            </div>
        </section>

        <section class="tv-shows">
            <h2>TV Shows</h2>
            <div class="tv-show-list">
                <img src="https://image.tmdb.org/t/p/original/xeEw3eLeSFmJgXZzmF2Efww0q3s.jpg" alt="TV Show 13">
            </div>
        </section>
    </main>

    <!-- Footer Section -->
    <footer>
        <p>&copy; 2024 Cineflix BECS</p>
    </footer>

    <script src="./js/scripts.js"></script>
</body>

</html>