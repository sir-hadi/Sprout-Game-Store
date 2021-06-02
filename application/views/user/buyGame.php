<div class="container mt-5">

    <div class="row">
        <div class="col-md-12">
            <h1>Buy New Game</h1>
        </div>
    </div>
    <!-- <//?= var_dump($games) ?> -->
    <div class="row">
        <?php foreach ($games as $game) : ?>
            <?php if ($game['is_publish'] == true) : ?>
                <div class="col-md-3 mb-5">
                    <div class="card h-100">
                        <a href="#"><img class="card-img-top" src="<?= base_url('assets/img/game/') . $game['image'] ?>" alt="" /></a>
                        <div class="card-body">
                            <h4 class="card-title">
                                <a href="#"><?= $game['gameName'] ?></a>
                            </h4>
                            <h5>Rp. <?= number_format($game['price'], 0, ',', '.') ?></h5>
                            <p class="card-text">
                                <?= $game['description'] ?>
                            </p>
                            <div class="row">
                                <a type="button" href="<?= base_url('user/addToCart/') . $game['game_id'] ?>" class="btn btn-primary btn-block">
                                    Add to Cart
                                </a>
                                <button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#buygame<?= $game['game_id'] ?>">
                                    Buy
                                </button>
                            </div>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                        </div>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="buygame<?= $game['game_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel"><?= $game['gameName'] ?></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <img src="https://cdn0-production-images-kly.akamaized.net/crzM7IQFUUm3eEE4-w4w9Ec2ws8=/640x360/smart/filters:quality(75):strip_icc():format(jpeg)/kly-media-production/medias/853262/original/006515100_1429161283-gtavreviewheader.jpg" class="img-thumbnail">
                            <div class="modal-body">
                                <form action="<?= base_url('user/buyGame') ?>" method="POST">

                                    <input type="text" value="<?= $game['game_id'] ?>" name="game_id" hidden>

                                    <div class="form-group">
                                        <label for="gameName">Game Name</label>
                                        <h4><?= $game['gameName'] ?></h4>
                                        <small class="text-muted ml-2">Game By <?= $game['developer_id'] ?></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <h4><?= $game['description'] ?></h4>
                                    </div>
                                    <div class="form-group">
                                        <label for="price">Price</label>
                                        <h4>Rp. <?= number_format($game['price'], 0, ',', '.') ?></h4>
                                    </div>


                                    <button type="submit" class="btn btn-success text-center w-100">BUY</button>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif ?>
        <?php endforeach ?>
    </div>
</div>