document.addEventListener("DOMContentLoaded", () => {
  const allTvseries = [];

// Fetch movies
async function fetchData() {
  try {
    const response = await fetch('fetch_allmovies.php');
    const data = await response.json();
    allTvseries.push(...data); // Use spread operator to avoid nested arrays
    console.log(data);
  } catch (error) {
    console.error('Error fetching data:', error);
  }
}

// Get 20 movies
const get20Movies = async () => {
  try {
    await fetchData(); // Await fetchData to ensure it's resolved before proceeding
    console.log("Fetched the data");
  } catch (error) {
    console.error("Error getting movies:", error);
  }
};

get20Movies().then(() => {
  console.log("Doing something with the fetched data");
  const comedySection = document.querySelector(".category:nth-child(1) .shows");
  const horrorSection = document.querySelector(".category:nth-child(2) .shows");

  // Clear sections before rendering
  comedySection.innerHTML = '';
  horrorSection.innerHTML = '';

  allTvseries.forEach((movie) => {
    console.log(movie.poster_url)
    const div = document.createElement("div");
    div.classList.add("show-card");

    const imgLink = document.createElement("a");
    imgLink.href = movie.TrailerLink || "#"; // Use a fallback if TrailerLink is not available
    imgLink.classList.add("imgLink");

    const img = document.createElement("img");
    img.src = movie.poster_url;
    imgLink.appendChild(img);

    imgLink.addEventListener('click', (event) => {
      event.preventDefault();
      openModal(movie);
    });

    const titleLink = document.createElement("a");
    titleLink.href = movie.TrailerLink || "#"; 
    titleLink.textContent = movie.Title;
    titleLink.classList.add("title-link");

    div.appendChild(imgLink);
    div.appendChild(titleLink);

    // Adjust condition to categorize movies (example categorization)
    // if (movie.genre && movie.genre.includes("Comedy")) {
      comedySection.appendChild(div);
    // } else if (movie.genre && movie.genre.includes("Horror")) {
      horrorSection.appendChild(div);
    // }
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
