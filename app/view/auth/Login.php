<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../public/index.css">
  <link rel="stylesheet" href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
  <title><?= $model['title'] ?? null ?></title>
</head>
<body>
  <div class="container col-xl-10 col-xxl-8 px-4 py-5">
    <div class="row align-items-center g-lg-5 py-5">
      <h1 class="display-4 fw-bold lh-1 mb-3">Login Management</h1>
      <p class="col-lg-10 fs-4">by <a target="_blank" href="">login</a></p>
    </div>
    <div class="col-md-10 mx-auto col-lg-5">
      <div class="p-4 p-md-5 border rounded-3 bg-light">
        <div class="form-floating mb-3">
          <a href="/users/register" class="w-100 btn btn-lg btn-primary">register</a>
        </div>
        <div class="form-floating mb-3">
          <a href="/users/login" class="w-100 btn btn-lg btn-primary">login</a>
        </div>
      </div>
    </div>
  </div>
  <script src="vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../../public/js/script.js"></script>
</body>
</html>