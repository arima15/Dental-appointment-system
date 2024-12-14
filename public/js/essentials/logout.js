document.addEventListener('DOMContentLoaded', function() {
    const logoutLink = document.querySelector('.logout');
    const logoutModal = document.querySelector('#logout-modal');
    const logoutYes = document.querySelector('#confirm-logout');
    const logoutNo = document.querySelector('#cancel-logout');
    const closeModal = document.querySelector('.modal .close');

    logoutLink.addEventListener('click', function(event) {
        event.preventDefault();
        logoutModal.style.display = 'block';
    });

    logoutYes.addEventListener('click', function () {
        // Perform logout action
        sessionStorage.removeItem('loggedIn');
        window.location.href = homeUrl;
    });


    logoutNo.addEventListener('click', function() {
        logoutModal.style.display = 'none';
    });

    closeModal.addEventListener('click', function() {
        logoutModal.style.display = 'none';
    });

    window.addEventListener('click', function(event) {
        if (event.target == logoutModal) {
            logoutModal.style.display = 'none';
        }
    });
});
