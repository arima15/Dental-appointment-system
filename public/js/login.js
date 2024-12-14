document.addEventListener('DOMContentLoaded', function() {
    const loginButtons = document.querySelectorAll('#login-btn, .logbttn');

    loginButtons.forEach(button => {
        button.addEventListener('click', function() {
            const loginModal = document.getElementById('login-modal');
            loginModal.style.display = 'block';
        });
    });

    const closeModal = document.querySelector('.close');
    closeModal.addEventListener('click', function() {
        const loginModal = document.getElementById('login-modal');
        loginModal.style.display = 'none';
    });

    window.addEventListener('click', function(event) {
        const loginModal = document.getElementById('login-modal');
        if (event.target == loginModal) {
            loginModal.style.display = 'none';
        }
    });

    const loginForm = document.getElementById('login-form');
    loginForm.addEventListener('submit', function(e) {
        e.preventDefault();

        const username = document.getElementById('username').value;
        const password = document.getElementById('password').value;

        // Replace these with your actual credentials
        const correctUsername = 'admin';
        const correctPassword = 'password123';

        if (username === correctUsername && password === correctPassword) {
            // Successful login
            sessionStorage.setItem('loggedIn', 'true');
            window.location.href = '/dashboard'; // Fixed path to redirect to dashboard
        } else {
            // Failed login
            alert('Invalid username or password. Please try again.');
        }
    });
});