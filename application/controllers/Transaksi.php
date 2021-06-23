<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
* Representasikan Controller Transaksi
* Mengembalikan dan menyusun view header user, page transaksi
* dan footer, serta mengembalikan data title
*
* @author Abdullah Hadi
* @version 1.0
* @since 2021-05-04
*/

class Transaksi extends CI_Controller
{

    public function index()
    {
        $data['title'] = 'Sprout User Transaction Page';
        $this->load->view('templates/header_user', $data);
        $this->load->view('auth/transaksi');
        $this->load->view('templates/auth_footer');
    }
}
