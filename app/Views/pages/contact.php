<?= $this->extend('layouts/template')  ?>
<?= $this->section('content')  ?>
  <div class="container">
    <div class="col">
      <div class="row">
        <h1>Ini Contact</h1>
        <?php foreach ($contacts as $contact) : ?>
          <ul>
            <li><?= $contact['name'] ?> : <?= $contact['phone'] ?></li>
          </ul>
        <?php endforeach ?>
      </div>
    </div>
  </div>
<?= $this->endSection('content')  ?>