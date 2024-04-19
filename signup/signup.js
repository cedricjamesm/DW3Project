document.getElementById("signup-form").addEventListener("submit", function(event) {
    event.preventDefault();
    var errorContainer = document.getElementById("error-messages");
    errorContainer.innerHTML = "";  // Clear previous error messages

    // Gather form data
    var formData = new FormData(document.getElementById('signup-form'));
    var errors = validateFormData(formData);

    // Display error messages or submit the form
    if (errors.length > 0) {
        errors.forEach(function(error) {
            errorContainer.innerHTML += "<p>" + error + "</p>";
        });
    } else {
        submitSignupForm(formData);
    }
});

function validateFormData(formData) {
    var errors = [];
    var username = formData.get('username');
    var firstName = formData.get('firstName');
    var lastName = formData.get('lastName');
    var password = formData.get('password');
    var confirmPassword = formData.get('confirmPassword');

    // Validation logic
    if (!username || !/^[a-zA-Z]+$/.test(username)) {
        errors.push("Username must start with a letter and cannot be empty.");
    }
    if (!firstName || !/^[a-zA-Z]+$/.test(firstName)) {
        errors.push("First name must start with a letter and cannot be empty.");
    }
    if (!lastName || !/^[a-zA-Z]+$/.test(lastName)) {
        errors.push("Last name must start with a letter and cannot be empty.");
    }
    if (!password || password.length < 8) {
        errors.push("Password must contain at least 8 characters.");
    }
    if (password !== confirmPassword) {
        errors.push("Passwords do not match.");
    }
    return errors;
}

function submitSignupForm(formData) {
    fetch('signup.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            window.location.href = 'index.php';
        } else {
            document.getElementById('error-messages').innerHTML = "<p>" + data.message + "</p>";
        }
    })
    .catch(error => {
        console.error('Error:', error);
        document.getElementById('error-messages').innerHTML = "<p>Error submitting form.</p>";
    });
}
