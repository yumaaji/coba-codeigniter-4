<?= $this->extend('layouts/template') ?>

<?= $this->section('content')?>
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <h1 class="my-3">Masukkan Data</h1>
        <form action="/komik/update/<?= $komik['id'] ?>" method="POST" enctype="multipart/form-data">
          <?php csrf_field() ?>
          <input type="hidden" name="id" value="<?= $komik['id'] ?>"> 
          <input type="hidden" name="slug" value="<?= $komik['slug'] ?>"> 
          <input type="hidden" name="sampulLama" value="<?= $komik['sampul'] ?>">
          <div class="mb-3">
            <label class="form-label">Judul Komik</label>
            <input type="text" class="form-control <?= (isset($validation) && $validation->hasError('judul') ? 'is-invalid' : '')?>" name="judul" value=" <?= (old('judul') ? old('judul') : $komik['judul'] )?>">
            <?php if(isset($validation) && $validation->hasError('judul')) : ?>
              <div id="validationServer03Feedback" class="invalid-feedback">
                <?= $validation->getError('judul') ?>
              </div>
            <?php endif; ?>
          </div>
          <div class="mb-3">
            <label class="form-label">Penulis Komik</label>
            <input type="text" class="form-control <?= (isset($validation) && $validation->hasError('penulis') ? 'is-invalid' : '')?>" name="penulis" value="<?= (old('penulis') ? old('penulis') : $komik['penulis'] ) ?>">
            <?php if(isset($validation) && $validation->hasError('penulis')) : ?>
              <div id="validationServer03Feedback" class="invalid-feedback">
                <?= $validation->getError('penulis') ?>
              </div>
            <?php endif; ?>
          </div>
          <div class="mb-3">
            <label class="form-label">Penerbit Komik</label>
            <input type="text" class="form-control <?= (isset($validation) && $validation->hasError('penerbit') ? 'is-invalid' : '')?>" name="penerbit" value="<?= (old('penerbit') ? old('penerbit') : $komik['penerbit'] ) ?>">
            <?php if(isset($validation) && $validation->hasError('penerbit')) : ?>
              <div id="validationServer03Feedback" class="invalid-feedback">
                <?= $validation->getError('penerbit') ?>
              </div>
            <?php endif; ?>
          </div>
          <div class="mb-3">
            <div class="col-md-2">
              <img src="/img/<?= $komik['sampul'] ?>" class="img-thumbnail img-preview">
            </div>
            <div class="input-group mb-3">
              <input type="file" class="form-control <?= (isset($validation) && $validation->hasError('sampul') ? 'is-invalid' : '')?> sampul" id="inputGroupFile02" name="sampul" onchange="previewImg()">
              <label class="input-group-text" for="inputGroupFile02">Upload</label>
              <?php if(isset($validation) && $validation->hasError('sampul')) : ?>
                <div id="validationServer03Feedback" class="invalid-feedback">
                  <?= $validation->getError('sampul') ?>
                </div>
              <?php endif; ?>
            </div>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>  
    </div>
  </div>
<?= $this->endSection('content') ?>