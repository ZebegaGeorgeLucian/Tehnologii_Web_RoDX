document.addEventListener("DOMContentLoaded", function() {
  fetch('/Tehnologii_Web_RoDX/views/navbar.php')
    .then(response => response.text())
    .then(data => {
      document.querySelector('.navbar-container').innerHTML = data;
    })
    .catch(error => console.error('Error loading navbar:', error));
});
