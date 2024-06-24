// snackbar.js
function showSnackbar(message, type = 'info') {
  const snackbar = document.getElementById('snackbar');

  // Set the message and class based on the type
  snackbar.innerText = message;
  snackbar.className = 'show';

  // Remove any existing type classes
  snackbar.classList.remove('info', 'success', 'error');

  // Add the new type class
  snackbar.classList.add(type);

  // After 3 seconds, remove the show class from snackbar
  setTimeout(() => {
      snackbar.className = snackbar.className.replace('show', '');
  }, 3000);
}
