<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('AdminModel');
    }

    public function index()
    {
        $data['title'] = 'Admin';
        $this->load->view('templates/header_admin');
        $this->load->view('templates/sidebar');
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer_admin');
    }

    public function devRequest()
    {
        $data['dataRequests'] = $this->AdminModel->getDataDevRequest();
        $this->load->view('templates/header_admin');
        $this->load->view('templates/sidebar');
        $this->load->view('admin/developerRequest', $data);
        $this->load->view('templates/footer_admin');
    }

    public function allowRequest($id)
    {
        $this->db->set('status', true)->where('id_user', $id)->update('dev_request');
        $this->db->set('role_id', 2)->where('id_user', $id)->update('user');
        $this->AdminModel->addNewDeveloper();
        redirect('admin/devRequest');
    }

    public function listGameRequest()
    {
        $data['dataRequests'] = $this->AdminModel->getRequestPublishGame();
        $this->load->view('templates/header_admin');
        $this->load->view('templates/sidebar');
        $this->load->view('admin/publishGame', $data);
        $this->load->view('templates/footer_admin');
    }

    public function publishGame($id)
    {
        # Edit by hadi 2/6/2021
        $this->db->set('is_publish', true)->where('game_id', $id)->update('game');
        redirect('admin/listGameRequest');
    }

    public function listGames()
    {
        $jumlah_data = $this->AdminModel->countGames();
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'admin/listGames/';
        $config['total_rows'] = $jumlah_data;
        $config['per_page'] = 10;
        $from = $this->uri->segment(3);
        $this->pagination->initialize($config);
        $data['games'] = $this->AdminModel->listGames($config['per_page'], $from);

        $this->load->view('templates/header_admin');
        $this->load->view('templates/sidebar');
        $this->load->view('admin/listGames', $data);
        $this->load->view('templates/footer_admin');
    }

    public function listUsers()
    {
        $jumlah_data = $this->AdminModel->countUsers();
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'admin/listUsers/';
        $config['total_rows'] = $jumlah_data;
        $config['per_page'] = 10;
        $from = $this->uri->segment(3);
        $this->pagination->initialize($config);
        $data['users'] = $this->AdminModel->listUsers($config['per_page'], $from);

        $this->load->view('templates/header_admin');
        $this->load->view('templates/sidebar');
        $this->load->view('admin/listUsers', $data);
        $this->load->view('templates/footer_admin');

    }

    public function listDevelopers()
    {
        $jumlah_data = $this->AdminModel->countDevelopers();
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'admin/listDevelopers/';
        $config['total_rows'] = $jumlah_data;
        $config['per_page'] = 10;
        $from = $this->uri->segment(3);
        $this->pagination->initialize($config);
        $data['developers'] = $this->AdminModel->listDevelopers($config['per_page'], $from);

        $this->load->view('templates/header_admin');
        $this->load->view('templates/sidebar');
        $this->load->view('admin/listDevelopers', $data);
        $this->load->view('templates/footer_admin');
    }

    public function listTransactions()
    {
        $jumlah_data = $this->AdminModel->countTransactions();
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'admin/listTransactions/';
        $config['total_rows'] = $jumlah_data;
        $config['per_page'] = 10;
        $from = $this->uri->segment(3);
        $this->pagination->initialize($config);
        $data['transactions'] = $this->AdminModel->listTransactions($config['per_page'], $from);

        $this->load->view('templates/header_admin');
        $this->load->view('templates/sidebar');
        $this->load->view('admin/listTransactions', $data);
        $this->load->view('templates/footer_admin');
    }
}
