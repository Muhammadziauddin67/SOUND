 added in style.css for search style
/* Position the display container as a dropdown below the search bar */
#display {
  position: absolute;            /* Position it absolutely */
  top: 100%;                     /* Align it right below the search input */
  left: 0;                       /* Align it to the left of the search bar */
  width: 100%;                   /* Match the width of the search bar */
  background-color: var(--white-color);       /* Set background color */
  border: 1px solid #ddd;        /* Add border */
  box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2); /* Add shadow for a dropdown effect */
  z-index: 1000;                 /* Ensure it appears on top */
  display: none;                 /* Default hidden, shown on input */
}

.suggestion-item {
  padding: 10px;
  cursor: pointer;
}

.suggestion-item:hover {
  background-color:gray;
}

.suggestion-link {
  color: inherit;
  text-decoration: none;
}

.no-results {
  padding: 10px;
  color: #888;
}
changed navbar content class below navbar
     

      <div class="navbar_content">
          <!-- Toggle icon -->
          <i id="search-toggle" class="fas fa-search"></i>
       <div class="search_bar" style="display:none; position: relative;">
    <input type="text" id="search" placeholder="Search...">
    <!-- Search Suggestions Dropdown -->
    <div id="display"></div>
</div>
      
        
        <i class="bi bi-grid" id="toggleThemeButton"></i>
        <i class='bx bx-sun' id="darkLight"></i>
        <a href="followartist.php"><i class='bx bx-bell' ></i></a>
      
       
      </div>
and added search.php file to search from database and changed connection to new db to test functionality