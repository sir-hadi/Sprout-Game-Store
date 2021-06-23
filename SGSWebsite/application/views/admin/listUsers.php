<div class="container">
    <div class="row mt-5 mb-5">
        <div class="col-md-12">
            <h1 class="text-center">List Users</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-hover">
                <thead>
                    <tr class="text-center">
                        <th scope="col">No</th>
                        <th scope="col">User ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Image</th>
                        <th scope="col">Role</th>

                    </tr>
                </thead>
                <tbody>
                    <?php $count = 1 ?>
                    <?php foreach ($users as $data) : ?>
                        <tr class="text-center">
                            <th><?= $count++ ?></th>
                            <td>
                                <?= $data['id_user'] ?>
                            </td>
                            <td style="text-transform: uppercase;">
                                <?= $data['name'] ?>
                            </td>
                            <td style="text-transform: uppercase;">
                                <?= $data['email'] ?>
                            </td>
                            <td style="text-transform: uppercase;">
                                <?php if ($data['image'] == NULL) : ?>
                                    <p class="text-muted">NO IMAGE</p>
                                <?php else : ?>
                                    <img class="border border-dark p-1" height="50px" src="<?= base_url('assets/img/profile/') . $data['image']  ?>" alt="">
                                <?php endif ?>
                            </td>
                            <td style="text-transform: uppercase;">
                                <?php if ($data['role_id'] == 1) : ?>
                                    <p class="text-muted">USER</p>
                                <?php else : ?>
                                    <p class="text-muted">DEVELOPER</p>
                                <?php endif ?>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
            <nav aria-label="Page navigation">
                <?php echo $this->pagination->create_links(); ?>
            </nav>
        </div>
    </div>
</div>