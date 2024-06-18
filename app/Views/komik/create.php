<?= $this->extend('layouts/template') ?>

<?= $this->section('content')?>
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <h1 class="my-3">Masukkan Data</h1>
        <form action="/komik/store" method="POST">
          <?php csrf_field() ?>
          <div class="mb-3">
            <label class="form-label">Judul Komik</label>
            <input type="text" class="form-control <?= (isset($validation) && $validation->hasError('judul') ? 'is-invalid' : '')?>" name="judul" value="<?= old('judul') ?>">
            <?php if(isset($validation) && $validation->hasError('judul')) : ?>
              <div id="validationServer03Feedback" class="invalid-feedback">
                <?= $validation->getError('judul') ?>
              </div>
            <?php endif; ?>
          </div>
          <div class="mb-3">
            <label class="form-label">Penulis Komik</label>
            <input type="text" class="form-control <?= (isset($validation) && $validation->hasError('penulis') ? 'is-invalid' : '')?>" name="penulis" value="<?= old('penulis') ?>">
            <?php if(isset($validation) && $validation->hasError('penulis')) : ?>
              <div id="validationServer03Feedback" class="invalid-feedback">
                <?= $validation->getError('penulis') ?>
              </div>
            <?php endif; ?>
          </div>
          <div class="mb-3">
            <label class="form-label">Penerbit Komik</label>
            <input type="text" class="form-control <?= (isset($validation) && $validation->hasError('penerbit') ? 'is-invalid' : '')?>" name="penerbit" value="<?= old('penerbit') ?>">
            <?php if(isset($validation) && $validation->hasError('penerbit')) : ?>
              <div id="validationServer03Feedback" class="invalid-feedback">
                <?= $validation->getError('penerbit') ?>
              </div>
            <?php endif; ?>
          </div>
          <div class="mb-3">
            <label class="form-label">Sampul Komik</label>
            <input type="text" class="form-control <?= (isset($validation) && $validation->hasError('sampul') ? 'is-invalid' : '')?>" name="sampul" value="<?= old('sampul') ?>">
            <?php if(isset($validation) && $validation->hasError('sampul')) : ?>
              <div id="validationServer03Feedback" class="invalid-feedback">
                <?= $validation->getError('sampul') ?>
              </div>
            <?php endif; ?>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>  
    </div>
  </div>
<?= $this->endSection('content') ?>