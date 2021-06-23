<div class="container">
    <div class="row mt-5 mb-5">
        <div class="col-md-12">
            <h1 class="text-center">My Transactions</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-hover">
                <thead>
                    <tr class="text-center">
                        <th scope="col">Count</th>
                        <th scope="col">ID Transaction</th>
                        <th scope="col">Nama Game</th>
                        <th scope="col">Game ID</th>
                        <th scope="col">Date</th>
                        <th scope="col">Time</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $count = 0 ?>
                    <?php foreach ($transactions as $transaction) : ?>
                        <tr class="text-center">
                            <th><?= $count++ ?></th>
                            <td><?= $transaction['transaksi_id'] ?></td>
                            <td style="text-transform: uppercase;"><?= $transaction['gameName'] ?></td>
                            <td><?= $transaction['game_id'] ?></td>
                            <td><?= $transaction['date'] ?></td>
                            <td><?= $transaction['time'] ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>