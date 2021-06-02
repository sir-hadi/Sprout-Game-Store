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
                        <th scope="col">Count</th>
                        <th scope="col">ID Request</th>
                        <th scope="col">ID User</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $count = 0 ?>
                    <?php foreach ($dataRequests as $dr) : ?>
                        <?php if ($dr['status'] == 0) : ?>
                            <tr class="text-center">
                                <th><?= $count++ ?></th>
                                <td>
                                    <?= $dr['id_req'] ?>
                                </td>
                                <td>
                                    <?= $dr['id_user'] ?>
                                </td>
                                <td style="text-transform: uppercase;">
                                    <?= $dr['name'] ?>
                                </td>
                                <td>
                                    <?= $dr['email'] ?>
                                </td>
                                <td>
                                    <form action="<?= base_url('admin/allowRequest/') . $dr['id_user'] ?>" method="POST">
                                        <input type="text" value="<?= $dr['id_user'] ?>" name="id_user" hidden>
                                        <input type="text" value="<?= $dr['name'] ?>" name="developer_name" hidden>
                                        <input type="text" value="<?= $dr['email'] ?>" name="developer_email" hidden>
                                        <button type="submit" class="btn btn-primary">ALLOW</button>
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