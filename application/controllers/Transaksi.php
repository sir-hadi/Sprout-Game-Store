<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
