<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <link rel="stylesheet" href="../static/css/login.css">
  <link rel="stylesheet" href="../static/css/main.css">
</head>
<body>
  <div class="navbar-container">
    <?php include 'navbar.php'; ?>
  </div>

  <div class="login-container">
    <div class="login-box">
      <h2>Login</h2>
      <form id="login-form">
        <input type="text" name="username" placeholder="Username" required>
        <br>
        <input type="password" name="password" placeholder="Password" required>
        <br>
        <input type="submit" value="Log in">
        <br>
        <label class="remember-me"><input type="checkbox"> Remember me</label>
        <br>
        <a href="#" class="register-link">Don't have an account? Register here</a>
      </form>
    </div>

    <div class="registration-box">
      <h2>Registration</h2>
      <form id="register-form">
        <input type="text" name="first_name" placeholder="Name" required>
        <br>
        <input type="text" name="last_name" placeholder="Surname" required>
        <br>
        <input type="text" name="username" placeholder="Username" required>
        <br>
        <input type="email" name="email" placeholder="Email" required>
        <br>
        <input type="password" name="password" placeholder="Password" required>
        <br>
        <input type="password" name="confirm_password" placeholder="Confirm Password" required>
        <br>
        <input type="submit" value="Register">
        <br>
        <a href="#" class="login-link">Already have an account? Login here</a>
      </form>
    </div>
  </div>

  <div id="snackbar"></div>

  <script src="../static/js/snackbar.js"></script>
  <script src="../static/js/login.js"></script>
  <script>
    document.getElementById('login-form').addEventListener('submit', function(e) {
      e.preventDefault();
      const formData = new FormData(e.target);
      const data = Object.fromEntries(formData.entries());

      fetch('/Tehnologii_Web_RoDX/api/login', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(data)
      })
      .then(response => {
        console.log('Response received:', response);
        if (!response.ok) {
          return response.text().then(text => { throw new Error(text) });
        }
        return response.json();
      })
      .then(data => {
        console.log('Parsed JSON data:', data);
        if (data.status === 'success') {
          localStorage.setItem('jwtToken', data.token);
          showSnackbar('Login successful!', 'success');
          setTimeout(() => {
            window.location.href = '/Tehnologii_Web_RoDX/views/home.php';
          }, 3000); // Delay redirection to allow the snackbar to display
        } else {
          console.log('Login failed, message:', data.message);
          showSnackbar(data.message, 'error');
        }
      })
      .catch(error => {
        console.error('Error:', error);
        let errorMessage = 'An error occurred. Please check the console for details.';
        try {
          const errorObj = JSON.parse(error.message);
          if (errorObj.message) {
            errorMessage = errorObj.message;
          }
        } catch (e) {
          // If parsing fails, use the default error message
        }
        showSnackbar(errorMessage, 'error');
      });
    });

    document.getElementById('register-form').addEventListener('submit', function(e) {
      e.preventDefault();
      const formData = new FormData(e.target);
      const data = Object.fromEntries(formData.entries());

      fetch('/Tehnologii_Web_RoDX/api/users', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(data)
      })
      .then(response => {
        console.log('Response received:', response);
        if (!response.ok) {
          return response.text().then(text => { throw new Error(text) });
        }
        return response.json();
      })
      .then(data => {
        console.log('Parsed JSON data:', data);
        if (data.status === 'success') {
          showSnackbar('Registration successful!', 'success');
          setTimeout(() => {
            window.location.href = '/Tehnologii_Web_RoDX/views/login.php';
          }, 3000); // Delay redirection to allow the snackbar to display
        } else {
          console.log('Registration failed, message:', data.message);
          showSnackbar(data.message, 'error');
        }
      })
      .catch(error => {
        console.error('Error:', error);
        let errorMessage = 'An error occurred. Please check the console for details.';
        try {
          const errorObj = JSON.parse(error.message);
          if (errorObj.message) {
            errorMessage = errorObj.message;
          }
        } catch (e) {
          // If parsing fails, use the default error message
        }
        showSnackbar(errorMessage, 'error');
      });
    });
  </script>
</body>
</html>
