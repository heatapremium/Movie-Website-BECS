document.addEventListener("DOMContentLoaded", () => {
  const allData = [];

  // loading spinner
  const loadingSpinner = document.querySelector('.loading-spinner');

  //================================================================================================
  // Fetch shows data
  async function fetchData() {
    try {
      const response = await fetch('http://localhost:3000/backend/fetch_allTvshows.php');
      const data = await response.json();
      allData.push(...data); 
    } catch (error) {
      console.error('Error fetching data:', error);
    } finally {
      
      loadingSpinner.style.display = 'none';
    }
  }

  // Render movies================================================================================================
  function renderShows() {
    const actionSection = document.querySelector(".category:nth-child(1) .shows");
    const animationSection = document.querySelector(".category:nth-child(2) .shows");
    const comedySection = document.querySelector(".category:nth-child(3) .shows");


    // Clear sections before rendering
    actionSection.innerHTML = '';
    animationSection.innerHTML = '';
    comedySection.innerHTML = '';


    allData.forEach((show) => {
      // Creating the show card
      const div = document.createElement("div");
      div.classList.add("show-card");

      // Creating the image link
      const imgLink = document.createElement("a");
      imgLink.classList.add("imgLink");

      // Creating the image
      const img = document.createElement("img");
      img.src = show.poster_url;
      imgLink.appendChild(img);

      // Add modal to each div
      imgLink.addEventListener('click', (event) => {
        event.preventDefault();
        openModal(show);
      });

      const titleLink = document.createElement("a");
      titleLink.textContent = show.name;
      titleLink.classList.add("title-link");

      div.appendChild(imgLink);
      div.appendChild(titleLink);

      // Adjust condition to categorize movies based on category
      switch (show.category) {
        case "action":
          actionSection.appendChild(div);
          break;
        case "animation":
          animationSection.appendChild(div);
          break;
        case "comedy":
          comedySection.appendChild(div);
          break;
        default:
          console.log("No category found");
      }
    });
  }

  //== Call the functions================================================================================================
  fetchData().then(() => {
    renderShows();
  }).catch((error) => {
    console.error("Error in processing movies:", error);
  });


  //================================================================================================
  // Create the modal
  const modal = document.createElement('div');
  modal.classList.add('modal');
  document.body.appendChild(modal);

  const insideContent = document.createElement('div');
  insideContent.classList.add('modal-content');
  modal.appendChild(insideContent);


  function openModal(show) {
    insideContent.innerHTML = `
      <div>
      <img src="${show.poster_url}" style="width: 100%; max-width: 300px; height: auto;">
      </div>
      <div class="pop-details">
        <h2>${show.name}</h2>
        <p>Year: ${show.year}</p>
        <p>IMDB Rating: ${show.rating || 'N/A'}</p>
        <p>Genre: ${show.category}</p>
        <p>Description: ${show.description}</p>
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

  //================================================================================================

  // Search functionality
function searchShowsRender(result) {
  const searchSection = document.getElementById('search');
  searchSection.innerHTML = '';

  result.forEach((show) => {
    // Creating the show card
    const div = document.createElement('div');
    div.classList.add('show-card');

    // Creating the image link
    const imgLink = document.createElement('a');
    imgLink.classList.add('imgLink');

    // Creating the image
    const img = document.createElement('img');
    img.src = show.poster_url;
    imgLink.appendChild(img);

    // Add modal to each div
    imgLink.addEventListener('click', (event) => {
      event.preventDefault();
      openModal(show);
    });

    const titleLink = document.createElement('a');
    titleLink.textContent = show.name;
    titleLink.classList.add('title-link');

    div.appendChild(imgLink);
    div.appendChild(titleLink);

    searchSection.appendChild(div); // Append to search section
  });
}

const searchInput = document.getElementById('search-input');
const categoriesSection = document.querySelector('.categories');
const searchSection = document.getElementById('search');

searchInput.addEventListener('input', (e) => {
  const query = e.target.value.toLowerCase();
  const filteredShows = allData.filter(show => show.name.toLowerCase().includes(query));

  if (query) {
    categoriesSection.style.display = 'none'; 
    searchSection.style.display = 'flex';
    
    // Clear previous search results
    searchSection.innerHTML = '';

    if (filteredShows.length === 0) {
      searchSection.innerHTML = `<h2>No results found for "${query}"</h2>`;
    } else {
      searchShowsRender(filteredShows);
    }
  } else {
    categoriesSection.style.display = 'block'; 
    searchSection.style.display = 'none';
  }
});



//================================================================================================
  // Arrow for Scrolling
  const scrollContainers = document.querySelectorAll('.category .shows');
  const leftArrows = document.querySelectorAll('.arrow-left');
  const rightArrows = document.querySelectorAll('.arrow-right');
  console.log(scrollContainers);
  
  scrollContainers.forEach((container, i) => {
   
    leftArrows[i].addEventListener('click', () => {
      container.scrollBy({ left: -150, behavior: 'smooth' }); // Scroll left
    });

    rightArrows[i].addEventListener('click', () => {
      container.scrollBy({ left: 150, behavior: 'smooth' }); // Scroll right
    });
  });
});
