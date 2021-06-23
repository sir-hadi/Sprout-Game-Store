<!-- Page Content -->


<div class="container" id="padded-nav-top">
    <div class="row">
        <h3></h3>
        <h3>Welcome , <?= $user['name']; ?></h3>
        <hr />
        <!-- ! Carousel -->
        <div class="col">
            <div id="carouselExampleControls" class="carousel slide mb-5" data-bs-ride="carousel">
                <div class="carousel-inner bg-light">

                    <!-- ! Carousel Items -->
                    <!-- <div class="carousel-item active">
                        <img src= class="d-block w-100" alt="..." />
                        <div class="carousel-caption">
                            <h3>Price : 778k</h3>
                            <p>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                Perspiciatis, eaque? Blanditiis minima repudiandae
                                praesentium at veritatis similique vero iste! Possimus
                                beatae illum consequuntur illo laudantium harum.
                            </p>
                            <button type="button" class="btn btn-primary">View</button>
                            <button type="button" class="btn btn-success">Buy</button>
                        </div>
                    </div> -->
                    <?php for ($i = 0; $i < 2; $i++) : ?>
                        <?php if ($i == 0) : ?>
                            <div class="carousel-item active">
                                <img class="d-block w-100" src="<?= base_url('assets/img/game/') . $games[$i]['image'] ?>" alt="" style="max-height: 400px " />
                                <div class="carousel-caption">
                                    <h3>Rp. <?= number_format($games[$i]['price'], 0, ',', '.') ?></h3>
                                    <p>
                                        <?= $games[$i]['description'] ?>
                                    </p>
                                    <button type="button" class="btn btn-primary">View</button>
                                    <button type="button" class="btn btn-success">Buy</button>
                                </div>
                            </div>
                        <?php else :  ?>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="<?= base_url('assets/img/game/') . $games[$i]['image'] ?>" alt="" style="max-height: 400px " />
                                <div class="carousel-caption ">
                                    <h3>Rp. <?= number_format($games[$i]['price'], 0, ',', '.') ?></h3>
                                    <p>
                                        <?= $games[$i]['description'] ?>
                                    </p>
                                    <button type="button" class="btn btn-primary">View</button>
                                    <button type="button" class="btn btn-success">Buy</button>
                                </div>
                            </div>
                        <?php endif ?>
                    <?php endfor ?>

                    <!--  End of Carousel Items -->

                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        <!-- ! Treanding Game List -->
        <h4>Trending Game List</h4>
        <hr />
        <div class="row">
            <?php foreach ($games as $game) : ?>
                <?php if ($game['is_publish'] == true) : ?>
                    <div class="col-md-4 mb-5">
                        <div class="card h-100">
                            <a href="#"><img height="
                            250px" class="card-img-top" src="<?= base_url('assets/img/game/') . $game['image'] ?>" alt="" /></a>
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
                                    <!-- mengirim game_id ke function yang ada di controller User untuk nanti digunakan pada fungsi tersebut -->
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
                                <img class="card-img-top img-thumbnail" src="<?= base_url('assets/img/game/') . $game['image'] ?>" alt="">
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
        <!-- ! ENd of content game List -->


        <!-- ! End of Treanding Game List -->
        <!-- /.row -->

    </div>
    <!-- /.col -->
</div>
<!-- /.row -->
</div>
<!-- /.container -->

<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
    -->