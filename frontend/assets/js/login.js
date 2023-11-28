(function () {
  const loginForm = document.getElementById("loginForm");
  loginForm.addEventListener("submit", function (event) {
    event.preventDefault();

    const username = document.getElementById("username").value;
    const password = document.getElementById("password").value;
    const usernameError = document.getElementById("usernameError");
    const passwordError = document.getElementById("passwordError");
    const message = document.getElementById("message");

    usernameError.textContent = "";
    passwordError.textContent = "";
    message.textContent = "";
    let validation = true;

    if (username.trim() === "") {
      usernameError.textContent = "Username is required";
      validation = false;
    }

    if (password.trim() === "") {
      passwordError.textContent = "Password is required";
      validation = false;
    }

    if (validation) {
      fetch("/backend/login.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({ username: username, password: password }),
      })
        .then((response) => {
          if (!response.ok) {
            throw new Error("Network response was not ok");
          }
          return response.json();
        })
        .then((data) => {
          if (data.status) {
            const expirationTime = new Date();
            const expiresInSeconds = data.data.oauth.expires_in;
            const expirationMillis = expiresInSeconds * 1000;
            expirationTime.setTime(expirationTime.getTime() + expirationMillis);

            // save token
            document.cookie = `access_token=${
              data.data.oauth.access_token
            }; expires=${expirationTime.toUTCString()}; path=/; samesite=strict;`;
            window.location = "/frontend/list.php";
          } else {
            message.textContent = data.message || "Login failed";
          }
        })
        .catch((error) => {
          message.textContent = "Error: " + error.message;
        });
    }
  });
})();
