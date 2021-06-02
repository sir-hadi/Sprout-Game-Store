<div class="container">
    <div class="row mt-5 mb-5">
        <div class="col-md-12">
            <h1 class="text-center">List Transaction</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-hover">
                <thead>
                    <tr class="text-center">
                        <th scope="col">Transaction ID</th>
                        <th scope="col">Game ID</th>
                        <th scope="col">User ID</th>
                        <th scope="col">Email</th>
                        <th scope="col">Date</th>
                        <th scope="col">Time</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($transactions as $game) : ?>
                        <tr class="text-center">
                            <td>
                                <?= $game['transaksi_id'] ?>
                            </td>
                            <td>
                                <?= $game['game_id'] ?>
                            </td>
                            <td style="text-transform: uppercase;">
                                <?= $game['id_user'] ?>
                            </td>
                            <td style="text-transform: uppercase;">
                                <?= $game['email'] ?>
                            </td>
                            <td style="text-transform: uppercase;">
                                <?= $game['date'] ?>
                            </td>
                            <td style="text-transform: uppercase;">
                                <?= $game['time'] ?>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
            <hr>
            <nav aria-label="Page navigation">
                <?php echo $this->pagination->create_links(); ?>
            </nav>
        </div>
    </div>
</div>