document.addEventListener("DOMContentLoaded", () => {
  const allTvseries = [];
  const API_KEY = "da9fb976";
  const SEARCH_TERM = "batman";

  // Fetch movies
  const fetchMovies = async (page = 1) => {
    try {
      const response = await fetch(`http://www.omdbapi.com/?s=${SEARCH_TERM}&apikey=${API_KEY}&page=${page}`);
      const data = await response.json();
      console.log(data);
      if (data.Response === "True") {
        return data.Search || [];
      } else {
        console.error("Error fetching data:", data.Error);
        return [];
      }
    } catch (error) {
      console.error("Fetch error:", error);
      return [];
    }
  };

  // Get 20 movies
  const get20Movies = async () => {
    try {
      const moviesPage1 = await fetchMovies(1);
      const moviesPage2 = await fetchMovies(2);
      allTvseries.push(...moviesPage1, ...moviesPage2);
      console.log(allTvseries);
    } catch (error) {
      console.error("Error getting movies:", error);
    }
  };

  get20Movies().then(() => {
    const comedySection = document.querySelector(".category:nth-child(1) .shows");
    const horrorSection = document.querySelector(".category:nth-child(2) .shows");

    // Clear sections before rendering
    comedySection.innerHTML = '';
    horrorSection.innerHTML = '';

    allTvseries.forEach((movie) => {
      const div = document.createElement("div");
      div.classList.add("show-card");

      const imgLink = document.createElement("a");
      imgLink.href = movie.TrailerLink || "#"; // Use a fallback if TrailerLink is not available
      imgLink.classList.add("imgLink");

      const img = document.createElement("img");
      img.src = movie.Poster;
      imgLink.appendChild(img);

      imgLink.addEventListener('click', (event) => {
        event.preventDefault();
        openModal(movie);
      });

      const titleLink = document.createElement("a");
      titleLink.href = movie.TrailerLink || "#"; // 
      titleLink.textContent = movie.Title;
      titleLink.classList.add("title-link");

      div.appendChild(imgLink);
      div.appendChild(titleLink);

      // Adjust condition to categorize movies
      comedySection.appendChild(div);
      horrorSection.appendChild(div);
    });
  }).catch((error) => {
    console.error("Error in processing movies:", error);
  });

  // Create the modal
  const modal = document.createElement('div');
  modal.classList.add('modal');
  document.body.appendChild(modal);

  const modalContent = document.createElement('div');
  modalContent.classList.add('modal-content');
  modal.appendChild(modalContent);

  const closeButton = document.createElement('span');
  closeButton.classList.add('close');
  closeButton.textContent = '×';
  modalContent.appendChild(closeButton);

  function openModal(movie) {
    console.log(movie);
    modalContent.innerHTML = `
      <img src="${movie.Poster}" style="width: 100%; max-width: 300px; height: auto;">
      <div class="pop-details">
      <h2>${movie.Title}</h2>
      <p>Year: ${movie.Year}</p>
      <p>IMDB Rating: ${movie.imdbRating || 'N/A'}</p>
      </div>
    `;
    modal.style.display = "block";
  }

  closeButton.addEventListener('click', () => {
    modal.style.display = "none";
  });

  window.addEventListener('click', (event) => {
    if (event.target === modal) {
      modal.style.display = "none";
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
