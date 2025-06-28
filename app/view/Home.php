<?php require __DIR__ . '/components/header.php'; ?>
<?php require __DIR__ . '/components/navbar.php'; ?>

<main class="w-full min-vh-100 d-flex align-items-center justify-content-center">
  <div class="container-fluid border-right">
    <div class="row min-vh-100">
      <div class="col-md-6 d-flex align-items-center justify-content-center bg-white">
        <div class="card border-0 w-100 m-4">
          <div class="card-body p-4">
            <h2 class="mb-2"><?= $model['title'] ?? 'Halaman Utama' ?></h2>
            <p class="text-muted"><?= $model['content'] ?? '' ?></p>
            <hr />
            <p>
              Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
              Perferendis quas blanditiis et dolores. Iure alias nam laudantium 
              facilis suscipit dolor eius asperiores rerum sed, magnam adipisci 
              error velit dicta. Rem.
            </p>
          </div>
        </div>
      </div>

      <div class="col-md-6 d-none d-md-flex align-items-center justify-content-center bg-light">
        <h1 class="text-muted display-4 font-weight-bold">Image Content</h1>
      </div>
    </div>
  </div>
</main>

<?php require __DIR__ . '/components/footer.php'; ?>
