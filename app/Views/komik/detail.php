<?= $this->extend('layouts/template') ?>

<?= $this->section('content')?>
  <div class="container">
    <div class="row">
      <div class="col">
        <h1 class="my-3">Detail Komik</h1>
        <div class="card mb-3" style="max-width: 540px;">
          <div class="row g-0">
            <div class="col-md-4">
              <img src="/img/<?= $komik['sampul'] ?>" class="img-fluid rounded-start" alt="Image">
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h5 class="card-title"><?= $komik['judul'] ?></h5>
                <p class="card-text">Penulis: <?= $komik['penulis'] ?></p>
                <p class="card-text"><small class="text-body-secondary">Penerbit: <?= $komik['penerbit'] ?></small></p>
                <div class="mb-3">
                  <a href="/komik/edit/<?= $komik['slug'] ?>" class="btn btn-warning">Edit</a>
                  <form action="/komik/<?= $komik['id'] ?>" method="POST" class="d-inline">
                    <?= csrf_field() ?>
                    <input type="hidden" name="_method" value="Delete">
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin?')">Delete</button>
                  </form>
                  <a href="/komik" class="btn btn-secondary">Back</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?= $this->endSection('content') ?>