<div class="d-flex justify-content-center align-items-center min-vh-100 bg-light">
  <div class="card border rounded-4 w-100" style="max-width: 480px;">
    <div class="card-body p-4">

      <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($model['error'])): ?>
        <div class="row">
          <div class="alert alert-danger text-center" role="alert">
            <?= htmlspecialchars($model['error']) ?>
          </div>
        </div>
      <?php endif; ?>

      <h2 class="text-center fw-bold mb-4 text-primary">Masukan Akun</h2>

      <form method="POST" action="<?= htmlspecialchars($model['form_action'] ?? '') ?>">
        <div class="mb-3">
          <label for="id" class="form-label fw-semibold">User ID</label>
          <input type="text" class="form-control rounded-3" id="id" name="id"
            value="<?= htmlspecialchars($_POST['id'] ?? '') ?>" required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label fw-semibold">Kata Sandi</label>
          <input type="password" class="form-control rounded-3" id="password" name="password" value="<?php  // htmlspecialchars($_POST['password']) ?? '' ?>" required>
        </div>
        <button type="submit" class="btn btn-primary w-100 rounded-pill shadow-sm mt-3">
          <i class="bi bi-person-plus-fill me-2"></i><?= $model['alternate_button'] ?? 'Login' ?>
        </button>
      </form>

      <div class="text-center mt-3 small text-muted">
          <?= $model['alternate_text'] ?? '' ?> <a href="<?= $model['alternate_link'] ?? '' ?>" class="text-decoration-none">
          <?= strpos($model['form_action'] ?? '', 'login') !== false ? 'Daftar di sini' : 'Masuk di sini' ?>
        </a>
      </div>

    </div>
  </div>
</div>
