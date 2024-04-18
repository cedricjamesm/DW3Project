document.getElementById("signup-form").addEventListener("submit", function(event) {
    event.preventDefault();

    // Get form fields
    var username = document.getElementById("username").value;
    var firstName = document.getElementById("firstName").value;
    var lastName = document.getElementById("lastName").value;
    var password = document.getElementById("password").value;
    var confirmPassword = document.getElementById("confirmPassword").value;

    // Clear previous error messages (if any)
    document.getElementById("error-messages").innerHTML = "";

    // Validate form fields
    var errors = [];
    if (!username.trim()) {
        errors.push("Please enter a username.");
    }
    if (!firstName.trim()) {
        errors.push("Please enter your first name.");
    } else if (!/^[a-zA-Z]+$/.test(firstName)) {
        errors.push("First name must start with a letter.");
    }
    if (!lastName.trim()) {
        errors.push("Please enter your last name.");
    } else if (!/^[a-zA-Z]+$/.test(lastName)) {
        errors.push("Last name must start with a letter.");
    }
    if (!password.trim()) {
        errors.push("Please enter a password.");
    } else if (password.length < 8) {
        errors.push("Password must contain at least 8 characters.");
    }
    if (!confirmPassword.trim()) {
        errors.push("Please confirm your password.");
    } else if (password !== confirmPassword) {
        errors.push("Passwords do not match.");
    }

    // Display error messages, if any
    if (errors.length > 0) {
        var errorMessageElement = document.getElementById("error-messages");
        errors.forEach(function(error) {
            errorMessageElement.innerHTML += "<p>" + error + "</p>";
        });
    } else {
        // Submit the form if no errors
        submitSignupForm();
    }
});

// Function to submit the signup form data via AJAX
function submitSignupForm() {
    var formData = new FormData(document.getElementById('signup-form'));
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
            window.location.href = '../DW3Project-main/index.php';
        } else {
            document.getElementById('error-messages').innerHTML = "<p>" + data.message + "</p>";
        }
    })
    .catch(error => {
        console.error('Error:', error);
        document.getElementById('error-messages').innerHTML = "<p>Error submitting form.</p>";
    });
}