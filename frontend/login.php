<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>example.com | Login</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="assets/css/login.css" />
</head>

<body class="main-bg">
  <!-- Login Form -->
  <div class="container">
    <div class="row justify-content-center mt-5">
      <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="card shadow">
          <div class="card-title text-center border-bottom">
            <h2 class="p-3">Login Form</h2>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col">
                <div id="message" class="text-danger"></div>
              </div>
            </div>
            <form id="loginForm" action="#">
              <div class="mb-4">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" />
                <small id="usernameError" class="text-danger"></small>
              </div>
              <div class="mb-4">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" />
                <small id="passwordError" class="text-danger"></small>
              </div>
              <div class="d-grid">
                <button type="submit" class="btn text-light main-bg">Login</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
<script src="assets/js/login.js"></script>
</html>