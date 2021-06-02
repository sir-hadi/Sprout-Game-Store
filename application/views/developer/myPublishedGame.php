<div class="container">
    <div class="row mt-5 mb-5">
        <div class="col-md-12">
            <h1 class="text-center">My Published Games</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-hover">
                <thead>
                    <tr class="text-center">
                        <th scope="col">Count</th>
                        <th scope="col">Game ID</th>
                        <th scope="col">Game Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Description</th>
                        <th scope="col">Image</th>
                        <th scope="col">Status</th>
                        <th scope="col">Sold</th>
                        <th scope="col">Revenue</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $count = 0;
                    $total_revenue = 0;
                    $total_sold = 0; ?>
                    <?php foreach ($games as $game) : ?>

                        <tr class="text-center">
                            <th><?= $count++ ?></th>
                            <td>
                                <?= $game['game_id'] ?>
                            </td>
                            <td>
                                <?= $game['gameName'] ?>
                            </td>
                            <td style="text-transform: uppercase;">
                                <?= $game['price'] ?>
                            </td>
                            <td>
                                <?= $game['description'] ?>
                            </td>
                            <td>
                                <?php if ($game['image'] == NULL) : ?>
                                    <p class="text-muted">NO IMAGE</p>
                                <?php else : ?>
                                    <img class="border border-dark p-1" height="50px" src="<?= base_url('assets/img/game/') . $game['image']  ?>" alt="">
                                <?php endif ?>
                            </td>
                            <td>
                                <?php if ($game['is_publish'] == false) : ?>
                                    <p class="badge badge-warning">NOT PUBLISH</p>
                                <?php else : ?>
                                    <p class="badge badge-success">PUBLISH</p>
                                <?php endif ?>
                            </td>
                            <td>
                                <?php $soldCount = 0 ?>
                                <?php foreach ($transactions as $t) : ?>
                                    <?php if ($t['game_id'] == $game['game_id']) : ?>
                                        <?php $soldCount++ ?>
                                    <?php endif ?>
                                <?php endforeach ?>
                                <?= $soldCount ?>
                            </td>
                            <td>
                                <?php $revenue = $game['price'] * $soldCount ?>
                                Rp. <?= number_format($revenue, 0, ',', '.')  ?>
                            </td>

                        </tr>
                        <?php $total_revenue = $total_revenue + $revenue ?>
                        <?php $total_sold = $total_sold + $soldCount ?>

                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row text-center mt-5">
        <div class="col-md-12">
            <hr style="width: 100%;color: black;height: 2px;">
            <h3 class="text-muted">Your Revenue</h3>
            <h1 style="font-size: 50px;" class="badge badge-success">Rp. <?= number_format($total_revenue, 0, ',', '.') ?></h1>
            <h3 class="text-muted">Sold</h3>
            <p style="font-size: 30px;" class="badge badge-info"><?= $total_sold ?> Games</p>
        </div>
    </div>
</div>