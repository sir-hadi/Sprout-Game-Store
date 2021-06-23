<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('AdminModel');
        // $this->load->model('UserModel');
        // $this->load->model('Model_game');
    }

    public function index()
    {
        $data['title'] = 'Admin';
        // $data['game'] = $this->Model_game->tampil_data()->result();
        $this->load->view('templates/header_admin');
        $this->load->view('templates/sidebar');
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer_admin');
        // $this->load->view('auth/home');
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
        $this->db->set('status', true);
        $this->db->where('id_user', $id);
        $this->db->update('dev_request');
        $this->db->set('role_id', 2);
        $this->db->where('id_user', $id);
        $this->db->update('user');
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
        $this->db->set('is_publish', true);
        $this->db->where('game_id', $id);
        $this->db->update('game');
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
        // $data['users'] = $this->db->get('user')->result_array();
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
        // $data['users'] = $this->db->get('user')->result_array();

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
        // $data['Developers'] = $this->db->get('user')->result_array();
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
        // $data['users'] = $this->db->get('user')->result_array();
    }

    public function deleteGame($id)
    {
        $this->db->where('game_id', $id);
        $query = $this->db->get('game');
        $row = $query->row();
        $this->db->delete('game', array('game_id' => $id));
        return redirect('admin/listGames');
    }
}
