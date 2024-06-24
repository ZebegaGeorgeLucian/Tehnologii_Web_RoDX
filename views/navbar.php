<div class="taskbar">
  <div class="logo">RoDX</div>
  <a href="/Tehnologii_Web_RoDX/views/home.php">Home</a>
  <a href="/Tehnologii_Web_RoDX/views/search.php">Search</a>
  <a href="/Tehnologii_Web_RoDX/views/about.php">About</a>
  <div id="user-section">
    <a href="/Tehnologii_Web_RoDX/views/login.php" id="login-link">Login</a>
  </div>
</div>

<script>
 document.addEventListener('DOMContentLoaded', function() {
    setTimeout(() => {
        const token = localStorage.getItem('jwtToken');
        console.log('Token:', token); // Debugging: Log the token

        if (token) {
            try {
                const payload = JSON.parse(atob(token.split('.')[1]));
                console.log('Payload:', payload); // Debugging: Log the payload

                if (payload.exp * 1000 < Date.now()) {
                    console.log('Token expired');
                    localStorage.removeItem('jwtToken');
                    document.getElementById('user-section').style.visibility = 'visible';
                    return;
                }

                const username = payload.data.username;
                const userSection = document.getElementById('user-section');
                userSection.innerHTML = `
                    <div class="dropdown">
                        <button class="dropbtn">${username}</button>
                        <div class="dropdown-content">
                            <a href="#" id="logout-link">Logout</a>
                        </div>
                    </div>
                `;
                console.log('Username set:', username); // Debugging: Log the username setting

                const logoutLink = document.getElementById('logout-link');
                if (logoutLink) {
                    logoutLink.addEventListener('click', function() {
                        localStorage.removeItem('jwtToken');
                        window.location.href = '/Tehnologii_Web_RoDX/views/login.php';
                    });
                    console.log('Logout link event listener set'); // Debugging: Log setting of the logout link event listener
                } else {
                    console.log('Logout link not found'); // Debugging: Log if the logout link is not found
                }
            } catch (error) {
                console.error('Error parsing token payload:', error); // Debugging: Log any errors
            }
        } else {
            console.log('No token found'); // Debugging: Log if no token is found
        }
        document.getElementById('user-section').style.visibility = 'visible';
    }, 100); // 100ms delay to ensure DOM is ready
});

</script>
