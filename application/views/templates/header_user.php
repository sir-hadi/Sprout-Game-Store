<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $title; ?></title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url('assets/'); ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css">
    </link>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <!-- Custom styles for this template-->
    <link href="<?= base_url(); ?>assets/css/sb-admin-2.min.css" rel="stylesheet">

    <link href="<?= base_url(); ?>assets/css/style-navbar.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous" />

    <!-- ! Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark ">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url('user') ?>">Sprout Game Store</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active" style="width: 100px;">
                        <a class="nav-link text-white btn btn-outline-warning mr-3" href="<?= base_url('user/buyGame') ?>">Store</a>
                    </li>
                    <li class="nav-item" style="width: 100px;">
                        <a class="nav-link text-white btn btn-outline-warning" href="<?= base_url('user/myCart') ?>">Cart <span class="badge badge-success">

                                <?php $count = 0 ?>
                                <?php foreach ($this->cart->contents() as $game) : ?>
                                    <?php if ($user['id_user'] == $game['id_user']) : ?>
                                        <?php $count++; ?>
                                    <?php endif ?>
                                <?php endforeach ?>
                                <?php echo $count; ?>
                            </span></a>
                    </li>
                </ul>
            </div>

            <div class="collapse navbar-collapse" id="navbarResponsive">
                <?php if ($this->session->has_userdata('email')) : ?>
                    <div class="col-md-12"></div>
                    <p style="color: white;text-align: center;"><?= $user['name'] ?></p>
                    <li class="nav-item dropdown">
                        <a style="margin-top: -25px !important;" class="nav-link dropdown-toggle p-0" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img class='img-profile rounded-circle' width="40px" src="<?= base_url('assets/img/profile/') . $user['image']; ?>">
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="<?= base_url('user/editProfile') ?>">Edit Profile</a></li>
                            <li><a class="dropdown-item" href=" <?= base_url('user/myTransactions') ?>">My Transaction</a></li>
                            <li><a class="dropdown-item" href="<?= base_url('user/myGame') ?>">My Game</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="<?= base_url('auth/logout'); ?> ">Logout</a></li>
                        </ul>
                    </li>
                <?php else : ?>
                    <div class="collapse navbar-collapse" id="navbarResponsive">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item mr-2">
                                <a class="nav-link btn btn-outline-light" href="<?= base_url('auth/login') ?>">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link btn btn-outline-light" href="<?= base_url('auth/registration') ?>">Sign Up</a>
                            </li>
                        </ul>
                    </div>
                <?php endif ?>
            </div>
        </div>
    </nav>