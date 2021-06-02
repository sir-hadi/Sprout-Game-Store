<div class="container-fluid">
    <button type="submit"> Publish Game </button>
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner text-center mb-5">
            <div class="carousel-item active">
                <img src="<?= base_url('assets/img/assasinval.jpg'); ?>" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="<?= base_url('assets/img/assasinrog.jpg'); ?> " class="d-block w-80" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <div class="row text-center">
        <?php foreach ($game as $gm) : ?>
            <div class="card ml-5" style="width: 16rem ">
                <img src="<?= base_url('assets/img/') . $gm->gambar ?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title"><?= $gm->nama_game ?></h5>
                    <p class="card-text"><?= $gm->keterangan ?></p>
                    <span class="badge bg-danger">Rp. <?= $gm->harga ?></span>
                    <br>
                    <a href="#" class="btn btn-sm btn-primary">View</a>
                    <a href="#" class="btn btn-sm btn-primary">Buy</a>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>