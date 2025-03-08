// // Function to handle search logic
// function performSearch() {
//   // Get the search input value
//   var query = document.getElementById("searchInput").value;

//   // Basic validation for empty input
//   if (query.trim() === "") {
//     alert("Please enter a search query.");
//     return;
//   }

//   // Simulating search (you can replace this part with actual search logic)
//   var results = "You searched for: " + query;

//   // Display the search results
//   document.getElementById("searchResults").innerText = results;
// }
// document.querySelector(".edit").addEventListener("click", function () {
//   window.location.href = ROOT + "/admin/editPharmacy";
// });
// document.querySelector(".remove").addEventListener("click", function () {
//   window.location.href = ROOT + "/admin/removePharmacy";
// });
document.getElementById('search-form').addEventListener('submit', function(event) {
  event.preventDefault();
  performSearch();
});

function performSearch() {
  var searchTerm = document.getElementById('searchInput').value.toLowerCase();
  var tableRows = document.querySelectorAll('.table-container tbody tr');
  var noResultsMessage = document.querySelector('.no-results');
  var hasResults = false;

  tableRows.forEach(function(row) {
      var rowText = row.textContent.toLowerCase();
      if (rowText.includes(searchTerm)) {
          row.style.display = '';
          hasResults = true;
      } else {
          row.style.display = 'none';
          
      }
  });

  if (hasResults) {
      noResultsMessage.style.display = 'none';
  } else {
      noResultsMessage.style.display = 'block';
  }
}

// function resetSearch() {
//   document.getElementById('searchInput').value = '';
//   var tableRows = document.querySelectorAll('.table-container tbody tr');
//   var noResultsMessage = document.querySelector('.no-results');

//   tableRows.forEach(function(row) {
//       row.style.display = '';
//   });

//   noResultsMessage.style.display = 'none';
// }

function confirmDelete(deleteUrl) {
  const userConfirmed = confirm(
    "Are you sure you want to delete this pharmacy?"
  );
  if (userConfirmed) {
    // Redirect to the delete URL
    window.location.href = deleteUrl;
  } else {
    // Reload the page if the user cancels
    window.location.reload();
  }
}
