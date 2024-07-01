document.addEventListener("DOMContentLoaded", function () {
    const signInSection = document.querySelector(".sign-in");
    const signUpSection = document.querySelector(".signup");

    const signUpLink = document.getElementById("signup-link");
    const signInLink = document.getElementById("signin-link");

    signUpLink.addEventListener("click", function (e) {
        e.preventDefault();
        signInSection.style.display = "none";
        signUpSection.style.display = "block";
    });

    signInLink.addEventListener("click", function (e) {
        e.preventDefault();
        signUpSection.style.display = "none";
        signInSection.style.display = "block";
    });

// const registerForm = document.getElementById("register-form");
//             registerForm.addEventListener("submit", function (e) {
//                 const password = document.getElementById("pass").value;
//                 const rePass = document.getElementById("re_pass").value;
//                 const warning = document.getElementById("warning");

//                 const strongPasswordPattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%^&+=!]).{6,}$/;

//                 if (password !== rePass) {
//                     e.preventDefault();
//                     warning.textContent = "Passwords do not match!";
//                 } else if (!strongPasswordPattern.test(password)) {
//                     e.preventDefault();
//                     warning.textContent = "Password must be at least 6 characters long and include a mix of uppercase, lowercase, numbers, and special characters.";
//                 } else {
//                     warning.textContent = "";
//                 }
//             });

});