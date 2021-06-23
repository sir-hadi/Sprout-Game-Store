<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    /**
     * Pada kelas controller Developer ini akan mengatur beberapa fungsi yang akan dipanggil dari sisi Developer,
     * Mulai dari halaman utama developer, formgamerequest, my publishedgame / revenue dan uploadimage game.
     * Data yang diolah merupakan database yang diambil melalui database.php yang kemudian 
     * Akan ditambah database nya berupa database developer itu sendiri. Selain itu 
     * Ada juga data berupa templates view dari header, halaman utama dan footer untuk developer.
     * @author Aditya Ramadhan
     * @version 1.0
     * @since 2021 - 02 - 20
     */

    /** 
     * Method construct ini digunakan karena dalam setiap method yang ada di class ini 
     * akan menggunakan model AdminModel, sehingga dibuatlah function construct 
     * agar dalam setiap method tidak perlu lagi memanggil model berkalikali
     *
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('AdminModel');
    }
    /** 
     * Method index ini digunakan untuk membuat sebuah halaman utama dengan 
     * menghubungkan views yang telah dibuat, yaitu header, sidebar, body, dan footer dari
     * halaman admin
     */
    public function index()
    {
        $data['title'] = 'Admin';
        $this->load->view('templates/header_admin');
        $this->load->view('templates/sidebar');
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer_admin');
    }
    /** 
     * Method devRequest ini digunakan untuk menghubungkan antara tampilan
     * yang ingin menjadi developer dan mengolah data dengan AdminModel untuk 
     * memanggil dataDevRequest untuk menampilkan data tersebut
     */
    public function devRequest()
    {
        $data['dataRequests'] = $this->AdminModel->getDataDevRequest();
        $this->load->view('templates/header_admin');
        $this->load->view('templates/sidebar');
        $this->load->view('admin/developerRequest', $data);
        $this->load->view('templates/footer_admin');
    }
    /** 
     * Method allowRequest ini digunakan untuk memasukkan data developer baru
     * melalui halaman admin dengan model AdminModel yang menjalankan addNewDeveloper
     * memanggil dataDevRequest untuk menampilkan data tersebut
     */
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
    /** 
     * Method listGameRequest ini digunakan untuk menampilkan data 
     * request publish game di halaman admin dengan data requests yang
     * diambil dari model AdminModel dengan method getRequestPublishGame()
     */
    public function listGameRequest()
    {
        $data['dataRequests'] = $this->AdminModel->getRequestPublishGame();
        $this->load->view('templates/header_admin');
        $this->load->view('templates/sidebar');
        $this->load->view('admin/publishGame', $data);
        $this->load->view('templates/footer_admin');
    }
    /** 
     * Method publishGame ini digunakan untuk mengubah database game
     * yang berkolom is_publish menjadi true, sehingga nantinya dapat ditampilkan di store
     */
    public function publishGame($id)
    {
        $this->db->set('is_publish', true);
        $this->db->where('game_id', $id);
        $this->db->update('game');
        redirect('admin/listGameRequest');
    }
    /** 
     * Method listGames ini digunakan untuk memperlihatkan game apa saja yang ada di database
     * pada halaman listGames milik Admin
     * dengan memanggil model AdminModel dengan countGames
     */
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
    /** 
     * Method listUsers ini digunakan untuk memperlihatkan user apa saja yang ada di database
     * pada halaman listUsers milik Admin
     * dengan memanggil model AdminModel dengan countUsers
     */
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
    /** 
     * Method listDeveloper ini digunakan untuk memperlihatkan developer apa saja yang ada di database
     * pada halaman listDeveloper milik Admin
     * dengan memanggil model AdminModel dengan countDevelopers
     */
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
    /** 
     * Method listTransaction ini digunakan untuk memperlihatkan transaksi apa saja yang ada di database
     * pada halaman listTransactions milik Admin
     * dengan memanggil model AdminModel dengan countTransactions
     */
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
    /** 
     * Method deleteGame ini digunakan untuk menghapus game yang diinginkan yang ada di database
     * dengan tombol delete pada halaman listGames milik Admin
     * dengan langsung memanggil delete milik CI
     */
    public function deleteGame($id)
    {
        $this->db->where('game_id', $id);
        $query = $this->db->get('game');
        $row = $query->row();
        $this->db->delete('game', array('game_id' => $id));
        return redirect('admin/listGames');
    }
}
