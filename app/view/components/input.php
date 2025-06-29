<div class="mb-3">
  <label for="id" class="form-label fw-semibold">User ID</label>
  <input type="text" class="form-control rounded-3" id="id" name="id"
    value="<?= htmlspecialchars($_POST['id'] ?? '') ?>" required>
</div>

<div class="mb-3">
  <label for="name" class="form-label fw-semibold">Nama</label>
  <input type="text" class="form-control rounded-3" id="name" name="name"
    value="<?= htmlspecialchars($_POST['name'] ?? '') ?>" required>
</div>

<div class="mb-3">
  <label for="password" class="form-label fw-semibold">Kata Sandi</label>
  <input type="password" class="form-control rounded-3" id="password" name="password" value="<?= htmlspecialchars($_POST['']) ?>" required>
</div>
