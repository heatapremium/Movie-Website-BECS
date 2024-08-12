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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CINEFLEX</title>
    <link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
/>
    <link rel="stylesheet" href="./css/style.min.css">
</head>
<body>
    <header>
        <div class="container flex">
            <a href="./index.php" class="logo"><h1>CINEFLEX</h1></a>
            <ul>
                <li class="active"><a href="./index.php">Home</a></li>
                <li><a href="./movies.php">Movies</a></li>
                <li><a href="./tvseries.php">TV Shows</a></li>
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
    <section class="main">
        
            <div class="banner">
                <h1>Welcome to <span>Cineflex</span>: Your Ultimate Movie Destination!</h1>
                <h3>Discover, Stream, and Enjoy the Best Movies Online</h3>
            </div>
        <div class="container">
            <h2>Recently Added</h2>
            <div class="swiper">
                <!-- Additional required wrapper -->
                <div class="swiper-wrapper">
                    <?php
                $getMovies = mysqli_query($conn,"SELECT * FROM `movies` ORDER BY year DESC LIMIT 10");
                while($row=mysqli_fetch_array($getMovies)){
                    echo '<div class="swiper-slide">';
                    echo '<img src="'.$row['poster_url'].'"/>';
                    echo '</div>';
                }
                ?>
                </div>
            </div>
            <h2>What People Say About Us?</h2>
            <div class="grid">
                <div class="grid-item">
                    <p>
                    "Cineflex is my go-to platform for movie nights! The variety of films available is incredible, and I love how easy it is to find something new to watch. The streaming quality is top-notch, and the interface is super user-friendly."
                    </p>
                    <h6><span>— </span>Sarah M., Movie Enthusiast</h6>
                </div>
                <div class="grid-item">
                    <p>
                    "I've tried several streaming services, but Cineflex stands out with its curated collections and personalized recommendations. It's like having a film expert guide me through what to watch next!"
                    </p>
                    <h6><span>— </span>James R., Film Critic</h6>
                </div>
                <div class="grid-item">
                    <p>
                    "As a fan of international cinema, Cineflex has been a game-changer for me. The selection of foreign films is fantastic, and I appreciate the attention to detail in the subtitles and translations."
                    </p>
                    <h6><span>— </span>Priya K., World Cinema Aficionado</h6>
                </div>
                <div class="grid-item">
                    <p>
                    "The Cineflex Originals are amazing! I was pleasantly surprised by the quality and storytelling. It’s refreshing to see such creative content exclusive to this platform. Definitely worth the premium membership."
                    </p>
                    <h6><span>— </span>Liam T., Cineflex Premium Member</h6>
                </div>
                <div></div>
                <div class="grid-item">
                    <p>
                    "Cineflex makes movie watching a breeze. The seamless streaming experience and the ability to download movies for offline viewing are just what I needed for my busy lifestyle. Highly recommend!"
                    </p>
                    <h6><span>— </span>Emily S., Busy Professional</h6>
                </div>
                <div class="grid-item">
                    <p>
                    "I’ve been using Cineflex for a while now, and it just keeps getting better. The customer support is excellent, and I love the community aspect where I can read reviews and join discussions about my favorite films."
                    </p>
                    <h6><span>— </span>Michael D., Longtime User</h6>
                </div>
            </div>
            <h2>Cineflex Frequently Asked Questions (FAQ)</h2>
            <div class="faq">
                <label>
                    <div class="que">
                        <h4>What is Cineflex?</h4>
                        <span>+</span>
                    </div>
                    <input type="checkbox">
                    <p class="ans">
                    Cineflex is an online platform where you can discover, watch, and discuss movies from various genres and languages. We provide high-quality streaming services and up-to-date movie listings.
                    </p>
                </label>
                <label>
                    <div class="que">
                        <h4>How do I create an account on Cineflex?</h4>
                        <span>+</span>
                    </div>
                    <input type="checkbox">
                    <p class="ans">
                    Creating an account is easy! Simply click on the "Sign Up" button on the top right corner of our homepage, fill in the required details, and verify your email address. Once done, you'll be ready to explore Cineflex.
                    </p>
                </label>
                <label>
                    <div class="que">
                        <h4>Do I need to pay to use Cineflex?</h4>
                        <span>+</span>
                    </div>
                    <input type="checkbox">
                    <p class="ans">
                    Cineflex offers both free and premium content. While many movies and features are available for free, subscribing to our premium membership gives you access to exclusive content, ad-free streaming, and early access to new releases.
                    </p>
                </label>
                <label>
                    <div class="que">
                        <h4>Can I watch movies offline?</h4>
                        <span>+</span>
                    </div>
                    <input type="checkbox">
                    <p class="ans">
                    Yes, our premium members can download movies to watch offline. Simply click the "Download" button on the movie's page, and the movie will be saved to your device for offline viewing.
                    </p>
                </label>
                <label>
                    <div class="que">
                        <h4>What should I do if I experience streaming issues?</h4>
                        <span>+</span>
                    </div>
                    <input type="checkbox">
                    <p class="ans">
                    If you're having trouble streaming, try refreshing the page, clearing your browser cache, or checking your internet connection. If the problem persists, visit our Help Center or contact our support team.
                    </p>
                </label>
                <label>
                    <div class="que">
                        <h4>Can I share my Cineflex account with others?</h4>
                        <span>+</span>
                    </div>
                    <input type="checkbox">
                    <p class="ans">
                    Each Cineflex account is intended for individual use. Sharing your account details with others may violate our terms of service. We recommend each user have their own account to ensure the best experience.
                    </p>
                </label>
            </div>
        </div>
    </section>
    <footer>
        <div class="container">
            <p>&copy <span id="year"></span> All Rights Reserved. Designed and Developed by CINEFLEX.INC</p>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        let year = new Date().getFullYear();
        document.getElementById("year").innerHTML = year;
        const swiper = new Swiper('.swiper', {
        // Optional parameters
        freeMode:true,
        direction: 'horizontal',
        slidesPerView: 5,
        spaceBetween: 20,
        loop: true,
        speed:10000,
        autoplay: {
        delay: 0,
        },

        // Navigation arrows
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        });
    </script>
</body>
</html>