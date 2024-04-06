document.querySelector('.register-link').addEventListener('click', function(event) {
  event.preventDefault();
  document.querySelector('.login-box').style.opacity = 0;
  setTimeout(function() {
    document.querySelector('.login-box').style.display = 'none';
    document.querySelector('.registration-box').style.display = 'block';
    setTimeout(function() {
      document.querySelector('.registration-box').style.opacity = 1;
    }, 100);
  }, 500);
});
