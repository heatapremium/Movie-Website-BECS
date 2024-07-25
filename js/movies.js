document.addEventListener("DOMContentLoaded", () => {
  const allData = [];

  // Fetch movies
  async function fetchData() {
    try {
      const response = await fetch('http://localhost:3000/backend/fetch_allmovies.php');
      const data = await response.json();
      allData.push(...data); // Use spread operator to avoid nested arrays
    } catch (error) {
      console.error('Error fetching data:', error);
    }
  }

  function renderMovies() {
    const actionSection = document.querySelector(".category:nth-child(1) .shows");
    const adventureSection = document.querySelector(".category:nth-child(2) .shows");
    const animationSection = document.querySelector(".category:nth-child(3) .shows");
    const comedySection = document.querySelector(".category:nth-child(4) .shows");
    const horrorSection = document.querySelector(".category:nth-child(5) .shows");

    // Clear sections before rendering
    actionSection.innerHTML = '';
    adventureSection.innerHTML = '';
    animationSection.innerHTML = '';
    comedySection.innerHTML = '';
    horrorSection.innerHTML = '';

    allData.forEach((movie) => {
      // Creating the show card
      const div = document.createElement("div");
      div.classList.add("show-card");

      // Creating the image link
      const imgLink = document.createElement("a");
      imgLink.classList.add("imgLink");

      // Creating the image
      const img = document.createElement("img");
      img.src = movie.poster_url;
      imgLink.appendChild(img);

      // Add modal to each div
      imgLink.addEventListener('click', (event) => {
        event.preventDefault();
        openModal(movie);
      });

      const titleLink = document.createElement("a");
      titleLink.textContent = movie.name;
      titleLink.classList.add("title-link");

      div.appendChild(imgLink);
      div.appendChild(titleLink);

      // Adjust condition to categorize movies (example categorization)
      switch (movie.category) {
        case "action":
          actionSection.appendChild(div);
          break;
        case "adventure":
          adventureSection.appendChild(div);
          break;
        case "animation":
          animationSection.appendChild(div);
          break;
        case "comedy":
          comedySection.appendChild(div);
          break;
        case "horror":
          horrorSection.appendChild(div);
          break;
        default:
          console.log("No category found");
      }
    });
  }

  fetchData().then(() => {
    renderMovies();
  }).catch((error) => {
    console.error("Error in processing movies:", error);
  });

  // Create the modal
  const modal = document.createElement('div');
  modal.classList.add('modal');
  document.body.appendChild(modal);

  const insideContent = document.createElement('div');
  insideContent.classList.add('modal-content');
  modal.appendChild(insideContent);

  function openModal(movie) {
    insideContent.innerHTML = `
      <img src="${movie.poster_url}" style="width: 100%; max-width: 300px; height: auto;">
      <div class="pop-details">
        <h2>${movie.name}</h2>
        <p>Year: ${movie.year}</p>
        <p>IMDB Rating: ${movie.rating || 'N/A'}</p>
        <p>Genre: ${movie.category}</p>
        <p>Description: ${movie.description}</p>
      </div>
      <span class="close">&times;</span>
    `;
    modal.style.display = "block";
  }

  window.addEventListener('click', (event) => {
    if (event.target === modal) {
      modal.style.display = "none";
    }
  });

  document.addEventListener('click', (event) => {
    if (event.target.classList.contains('close')) {
      modal.style.display = "none";
    }
  });

  // Search functionality
  function searchMoviesRender(result) {
    const searchSection = document.getElementById("search");
    searchSection.innerHTML = '';

    result.forEach((movie) => {
      // Creating the show card
      const div = document.createElement("div");
      div.classList.add("show-card");

      // Creating the image link
      const imgLink = document.createElement("a");
      imgLink.classList.add("imgLink");

      // Creating the image
      const img = document.createElement("img");
      img.src = movie.poster_url;
      imgLink.appendChild(img);

      // Add modal to each div
      imgLink.addEventListener('click', (event) => {
        event.preventDefault();
        openModal(movie);
      });

      const titleLink = document.createElement("a");
      titleLink.textContent = movie.name;
      titleLink.classList.add("title-link");

      div.appendChild(imgLink);
      div.appendChild(titleLink);

      searchSection.appendChild(div); // Append to search section
    });
  }

  const searchInput = document.getElementById('search-input');
  const categoriesSection = document.querySelector('.categories');

  searchInput.addEventListener('input', (e) => {
    const query = e.target.value.toLowerCase();
    const filteredMovies = allData.filter(movie => movie.name.toLowerCase().includes(query));

    if (query) {
      categoriesSection.style.display = 'none'; 
      document.getElementById("search").style.display = 'flex'; 
      searchMoviesRender(filteredMovies);
    } else {
      categoriesSection.style.display = 'block'; 
      document.getElementById("search").style.display = 'none'; 
    }
  });

  // Scroll bar functionality
  const shows = document.querySelectorAll(".shows");

  shows.forEach((show) => {
    let isDown = false;
    let startX;
    let scrollLeft;

    show.addEventListener("mousedown", (e) => {
      isDown = true;
      show.classList.add("active");
      startX = e.pageX - show.offsetLeft;
      scrollLeft = show.scrollLeft;
    });

    show.addEventListener("mouseleave", () => {
      isDown = false;
      show.classList.remove("active");
    });

    show.addEventListener("mouseup", () => {
      isDown = false;
      show.classList.remove("active");
    });

    show.addEventListener("mousemove", (e) => {
      if (!isDown) return;
      e.preventDefault();
      const x = e.pageX - show.offsetLeft;
      const walk = (x - startX) * 3; // scroll-fast
      show.scrollLeft = scrollLeft - walk;
    });
  });
});
