<div class="container mt-3" style="min-height: 38vw;">
    <div class="row">
        <!-- <//?php if (validation_errors()) : ?>
            <div class="col-md-12">
                <div class="text-center">
                    <//?= $this->session->flashdata('pesan'); ?>
                </div>
            </div>
        <//?php endif; ?> -->
    </div>
    <h2>Ubah Data</h2>
    <hr>
    <div class="img-profile">
        <div class="row">
            <div class="col-md-4">
                <img src="<?= base_url('assets/img/profile/') . $user['image'] ?>" class="img-thumbnail" width="130">
                <button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#changePhoto<?= $user['id_user'] ?>">
                    Change Photo
                </button>
            </div>
        </div>
    </div>
    <?= form_open('user/editProfile') ?>
    <div class="form-group">
        <?= form_label('Name') ?>
        <?= form_input(['name' => 'name', 'class' => 'form-control', 'value' => $user['name']]) ?>
    </div>
    <div class="form-group">
        <?= form_label('Email') ?>
        <?= form_input(['name' => 'email', 'class' => 'form-control', 'value' => $user['email'], 'readonly' => 'true']) ?>
    </div>
    <div class="form-group">
        <a href="<?= site_url('User') ?>" class="btn btn-success">Back</a>
        <?= form_submit('submit', 'Update', ['class' => 'btn btn-warning']) ?>
    </div>
    <?= form_close() ?>
    <div class="row">
        <div class="col-md-12 text-center">
            <form method="POST" action="<?= base_url('user/developerRequest') ?>">
                <input type="text" name="id_user" value="<?= $user['id_user'] ?>">
                <input type="text" name="name" value="<?= $user['name'] ?>">
                <input type="text" name="email" value="<?= $user['email'] ?>">
                <button href="#" type="submit" class="btn btn-primary w-100"><b>Developer Request</b></button>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="changePhoto<?= $user['id_user'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Photo Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <img src="https://cdn0-production-images-kly.akamaized.net/crzM7IQFUUm3eEE4-w4w9Ec2ws8=/640x360/smart/filters:quality(75):strip_icc():format(jpeg)/kly-media-production/medias/853262/original/006515100_1429161283-gtavreviewheader.jpg" class="img-thumbnail">
            <div class="modal-body">

                <div class="container">
                    <div class="row">
                        <div class="col-md-10 mx-auto">
                            <div class="img-profile">
                                <div class="card" style="width: 18rem;">
                                    <img src="<?= base_url('assets/img/profile/') . $user['image'] ?>" class="card-img-top img-thumbnail">
                                    <div class="card-body">

                                        <?php echo form_open_multipart('user/ubah_photo_profile'); ?>
                                        <input type="file" name="image" class="mb-4" />
                                        <br />
                                        <div class="col-md-12">
                                            <div class="d-flex justify-content-center">
                                                <input type="submit" value="Ubah" class="btn btn-primary" />
                                            </div>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>