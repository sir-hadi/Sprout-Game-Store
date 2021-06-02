<div class="container">
    <div class="row mt-5 mb-5">
        <div class="col-md-12">
            <h1 class="text-center">Developer Request</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-hover">
                <thead>
                    <tr class="text-center">
                        <th scope="col">Game ID</th>
                        <th scope="col">Developer ID</th>
                        <th scope="col">Game Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Description</th>
                        <th scope="col">Image</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $count = 0 ?>
                    <?php foreach ($dataRequests as $dr) : ?>
                        <?php if ($dr['is_publish'] == 0) : ?>
                            <tr class="text-center">
                                <td>
                                    <?= $dr['game_id'] ?>
                                </td>
                                <td>
                                    <?= $dr['developer_id'] ?>
                                </td>
                                <td>
                                    <?= $dr['gameName'] ?>
                                </td>
                                <td style="text-transform: uppercase;">
                                    <?= $dr['price'] ?>
                                </td>
                                <td>
                                    <?= $dr['description'] ?>
                                </td>
                                <td>
                                    <?php if ($dr['image'] == NULL) : ?>
                                        <p class="text-muted">NO IMAGE</p>
                                    <?php else : ?>
                                        <img class="border border-dark p-1" height="50px" src="<?= base_url('assets/img/game/') . $dr['image']  ?>" alt="">
                                    <?php endif ?>
                                </td>
                                <td>
                                    <form action="<?= base_url('admin/publishGame/') . $dr['game_id'] ?>" method="POST">
                                        <input type="text" value="<?= $dr['game_id'] ?>" name="game_id" hidden>
                                        <button type="submit" class="btn btn-primary">PUBLISH</button>
                                    </form>
                                </td>

                            </tr>
                        <?php endif ?>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>