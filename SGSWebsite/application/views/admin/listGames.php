<div class="container">
    <div class="row mt-5 mb-5">
        <div class="col-md-12">
            <h1 class="text-center">List Games</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-hover">
                <thead>
                    <tr class="text-center">
                        <th scope="col">No</th>
                        <th scope="col">Game ID</th>
                        <th scope="col">Developer ID</th>
                        <th scope="col">Game Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Description</th>
                        <th scope="col">Image</th>
                        <th scope="col">Status</th>

                    </tr>
                </thead>
                <tbody>
                    <?php $count = 1 ?>
                    <?php foreach ($games as $game) : ?>
                        <tr class="text-center">
                            <th><?= $count++ ?></th>
                            <td>
                                <?= $game['game_id'] ?>
                            </td>
                            <td>
                                <?= $game['developer_id'] ?>
                            </td>
                            <td style="text-transform: uppercase;">
                                <?= $game['gameName'] ?>
                            </td>
                            <td style="text-transform: uppercase;">
                                <?= $game['price'] ?>
                            </td>
                            <td style="text-transform: uppercase;">
                                <?= $game['description'] ?>
                            </td>
                            <td style="text-transform: uppercase;">
                                <?php if ($game['image'] == NULL) : ?>
                                    <p class="text-muted">NO IMAGE</p>
                                <?php else : ?>
                                    <img class="border border-dark p-1" height="50px" src="<?= base_url('assets/img/game/') . $game['image']  ?>" alt="">
                                <?php endif ?>
                            </td>
                            <td style="text-transform: uppercase;">
                                <?php if ($game['is_publish'] == false) : ?>
                                    <p class="badge badge-warning">NOT PUBLISH</p>
                                <?php else : ?>
                                    <p class="badge badge-success">PUBLISH</p>
                                <?php endif ?>
                            </td>
                            <td>
                                <a type="button" href="<?= base_url('admin/deleteGame/' . $game["game_id"]) ?>" class="btn btn-danger">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
            <hr>
            <?php
            echo $this->pagination->create_links();
            ?>
        </div>
    </div>
</div>