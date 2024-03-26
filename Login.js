function submitForm(event) {
    event.preventDefault(); 
    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;


    fetch('login.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'username=' + encodeURIComponent(username) + '&password=' + encodeURIComponent(password),
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            window.location.href = 'Home.php';
        } else {
            alert('Login failed. Please check your credentials or sign up.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}
