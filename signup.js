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
        document.getElementById("signup-form").submit();
    }
});

// AJAX for real-time validation
document.getElementById("username").addEventListener("keyup", function() {
    var username = this.value;
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "validate_username.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            document.getElementById("error-messages").innerHTML = xhr.responseText;
        }
    };
    xhr.send("username=" + username);
});

function validatePassword() {
    var password = document.getElementById("password").value;
    var confirmPassword = document.getElementById("confirmPassword").value;
    var errorMessageElement = document.getElementById("error-messages");

    if (password !== confirmPassword) {
        errorMessageElement.innerHTML = "<p>Passwords do not match.</p>";
    } else {
        errorMessageElement.innerHTML = ""; // Clear error message
    }
}