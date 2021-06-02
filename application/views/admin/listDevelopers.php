<div class="container">
    <div class="row mt-5 mb-5">
        <div class="col-md-12">
            <h1 class="text-center">List Developers</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-hover">
                <thead>
                    <tr class="text-center">
                        <th scope="col">No</th>
                        <th scope="col">Developer ID</th>
                        <th scope="col">User ID</th>
                        <th scope="col">Developer Name</th>
                        <th scope="col">Developer Email</th>

                    </tr>
                </thead>
                <tbody>
                    <?php $count = 1 ?>
                    <?php foreach ($developers as $data) : ?>
                        <tr class="text-center">
                            <th><?= $count++ ?></th>
                            <td>
                                <?= $data['developer_id'] ?>
                            </td>
                            <td>
                                <?= $data['id_user'] ?>
                            </td>
                            <td style="text-transform: uppercase;">
                                <?= $data['developer_name'] ?>
                            </td>
                            <td style="text-transform: uppercase;">
                                <?= $data['developer_email'] ?>
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