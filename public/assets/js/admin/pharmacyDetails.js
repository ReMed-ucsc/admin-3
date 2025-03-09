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
