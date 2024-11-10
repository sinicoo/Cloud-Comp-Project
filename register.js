document.addEventListener('DOMContentLoaded', () => {
    const registrationForm = document.getElementById('registrationForm');

    // Handle form submission
    registrationForm.addEventListener('submit', function (event) {
        event.preventDefault(); // Prevent default form submission

        // Get form values
        const formData = new FormData(registrationForm);
        const userGender = formData.get('gender');

        // Store the gender in localStorage
        localStorage.setItem('userGender', userGender);

        // Redirect to the home page
        window.location.href = 'index.html';
    });
});
