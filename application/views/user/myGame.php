<div class="jumbotron jumbotron-fluid" style="padding-top: 100px; background-image: url('https://lh3.googleusercontent.com/proxy/Vs5l341i_oF6h0rnTMmALBs2uNgft6vX8h2_rBebEOoO2JqDIV7zxF7LxGxKq8cxY22gMRUceMGUz0URmtyv3z05606pyJ6TS-SmE2ERUF4S96p9DBPDjRp8T_ZCvHSg-JmgkxZFIYO80n_rHuoDdwhttps://i.pinimg.com/originals/07/94/ea/0794eaa811d63f500f731b1d22fbd741.png');">
    <div class="container">
        <h1 class="display-4 text-center" style="font-size: 80px;font-weight: bolder;font-family: 'Montserrat';padding-bottom: 60px;color: white;">MY GAMES</h1>
        <!-- <p class="lead">This is a modified jumbotron that occupies the entire horizontal space of its parent.</p> -->
    </div>
</div>

<!-- <//?= var_dump($games) ?> -->
<div class="container">
    <div class="row mb-4">
        <div class="col-md-5">
            <a type="button" href="<?= base_url('user/buyGame') ?>" class="btn btn-outline-primary" style="width: 50%;font-weight: bolder;">+ Buy Game</a>
        </div>
    </div>
    <div class="row">
        <!-- start game content List -->
        <?php foreach ($games as $game) : ?>
            <div class="col-md-3 mb-5">
                <div class="card h-100">
                    <a href="#"><img class="card-img-top" src="<?= base_url('assets/img/game/') . $game['image'] ?>" alt="" height="250px" /></a>
                    <div class="card-body">
                        <h4 class="card-title">
                            <a class="text-uppercase" href="#"><?= $game['gameName'] ?></a>
                        </h4>
                        <h5>Rp. <?= number_format($game['price'], 0, ',', '.') ?></h5>
                        <p class="card-text" style="text-transform: capitalize;">
                            <?= $game['description'] ?>
                        </p>
                        <div class="row">
                            <button type="button" class="btn btn-primary btn-block">
                                Play
                            </button>
                        </div>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>