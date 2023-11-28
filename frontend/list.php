
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>example.com | Data List</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="assets/css/list.css" />
</head>

<body class="main-bg">
  <div class="container">
    <div class="row mt-5">
      <div class="col-lg-12 mb-4">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
          Display Image
        </button>
      </div>
      <div class="col-lg-12">
        <div class="card shadow">
          <div class="card-title text-center border-bottom">
            <h2 class="p-3">Data List</h2>
          </div>
          <div class="card-body">
          <input type="text" id="searchInput" class="form-control mb-3" placeholder="Search...">

          <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Task</th>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
              </tr>
            </thead>
            <tbody id="tableBody">
              
            </tbody>
          </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Select an Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="file" id="imageInput" accept="image/*">
                <img src="" alt="Selected Image" id="selectedImage" style="max-width: 100%; display: none;">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="saveChanges()">Save changes</button>
            </div>
        </div>
    </div>
</div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/list.js"></script>
</body>
</html>