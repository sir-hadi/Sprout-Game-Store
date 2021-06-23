<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('UserModel');
        $this->load->model('Model_game');
    }

    public function index()
    {
        $data['title'] = 'Sprout User Page';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['games'] = $this->db->get('game')->result_array();
        if ($data['user']) {
            if ($data['user']['role_id'] == 1) {
                $this->load->view('templates/header_user', $data);
                $this->load->view('user/index', $data);
                $this->load->view('templates/auth_footer');
            } else if ($data['user']['role_id'] == 2) {
                redirect('developer');
            }
        } else {
            redirect('auth');
        }
    }

    public function editProfile()
    {
        $data['title'] = 'Edit Profile Page';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->form_validation->set_rules('name', 'Name', 'trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim');

        if ($data['user']) {
            if ($this->form_validation->run() == false) {
                if ($data['user']['role_id'] == 1) {
                    $this->load->view('templates/header_user', $data);
                } else if ($data['user']['role_id'] == 2) {
                    $this->load->view('templates/header_developer', $data);
                }
                // } else if ($data['user']['role_id'] == 3) {

                //     $this->load->view('templates/header_admin ', $data);
                // }
                $this->load->view('user/editProfile');
                $this->load->view('templates/auth_footer');
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Akun Gagal Dirubah<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button> </div>');
            } else {
                $this->UserModel->updateProfile($data['user']['id_user']);
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Akun Berhasil Dirubah<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button> </div>');
                if ($data['user']['role_id'] == 1) {
                    redirect('user');
                } else if ($data['user']['role_id'] == 2) {
                    redirect('developer');
                }
            }
        } else {
            redirect('auth');
        }
    }

    public function myGame()
    {

        $data['title'] = 'My Games';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(); //id user

        $this->db->select('*');
        $this->db->from('game');
        $this->db->join('transaction', 'game.game_id = transaction.game_id');
        $condition = "transaction.id_user = " . $data['user']['id_user'];
        // $this->db->where('usergame', ['id_user' => $data['user']['id_user']]);
        $this->db->where($condition);
        $data['games'] = $this->db->get()->result_array(); //data Array

        // $data['myId'] = $this->db->get_where('userGame', ['id_user' => $data['user']['id_user']])->row_array(); // id game
        // $data['games'] = $this->db->get_where(['game',['game_id' => $data['myId']['']] ]);

        if ($data['user']['role_id'] == 1) {
            $this->load->view('templates/header_user', $data);
        } else if ($data['user']['role_id'] == 2) {
            $this->load->view('templates/header_developer', $data);
        }
        $this->load->view('user/myGame', $data);
        $this->load->view('templates/auth_footer');
    }

    public function buyGame()
    {
        $data['title'] = 'Buy Games';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['games'] = $this->Model_game->tampil_data();
        $this->form_validation->set_rules('game_id', 'Game', 'required|trim');

        if ($data['user']) {
            if ($this->form_validation->run() == false) {
                if ($data['user']['role_id'] == 1) {
                    $this->load->view('templates/header_user', $data);
                } else if ($data['user']['role_id'] == 2) {
                    $this->load->view('templates/header_developer', $data);
                }
                $this->load->view('user/buyGame', $data);
                $this->load->view('templates/auth_footer');
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Gagal Membeli Game<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button> </div>');
            } else {
                $this->UserModel->buyNewGame();
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Game Berhasil dibeli<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button> </div>');
                if ($data['user']['role_id'] == 1) {
                    redirect('user');
                } else if ($data['user']['role_id'] == 2) {
                    redirect('developer');
                }
            }
        } else {
            redirect('auth');
        }
    }

    public function myTransactions()
    {
        $data['title'] = 'My Transactions';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(); //id user

        $this->db->select('*');
        $this->db->from('transaction');
        $this->db->join('game', 'transaction.game_id = game.game_id ');
        $condition = "transaction.id_user = " . $data['user']['id_user'];
        $this->db->where($condition);
        $data['transactions'] = $this->db->get()->result_array(); //data Array

        // $data['myId'] = $this->db->get_where('userGame', ['id_user' => $data['user']['id_user']])->row_array(); // id game
        // $data['games'] = $this->db->get_where(['game',['game_id' => $data['myId']['']] ]);

        if ($data['user']['role_id'] == 1) {
            $this->load->view('templates/header_user', $data);
        } else if ($data['user']['role_id'] == 2) {
            $this->load->view('templates/header_developer', $data);
        }
        $this->load->view('user/myTransactions', $data);
        $this->load->view('templates/auth_footer');
    }

    public function ubah_photo_profile() //untuk user
    {
        $config['upload_path']          =  './assets/img/profile'; //isi dengan nama folder temoat menyimpan gambar
        $config['allowed_types']        =  'jpg|png'; //isi dengan format/tipe gambar yang diterima
        $config['max_size']             = '2048';  //isi dengan ukuran maksimum yang bisa di upload
        $config['max_width']            =  '2024'; //isi dengan lebar maksimum gambar yang bisa di upload
        $config['max_height']           = '1780'; //isi dengan panjang maksimum gambar yang bisa di upload

        $this->load->library('upload', $config);

        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        // $data['pasien'] = $this->db->get_where('medcek', ['id' => $id])->row_array();

        if (!$this->upload->do_upload('image')) {
            // $data['error'] = $this->upload->display_errors('<div class="alert alert-danger alert-dismissible fade show" role="alert"><a>', '</a><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            $data['title'] = 'Ubah Foto Profile';
            if ($data['user']['role_id'] == 1) {
                $this->load->view('templates/header_user', $data);
            } else if ($data['user']['role_id'] == 2) {
                $this->load->view('templates/header_developer', $data);
            }
            $this->load->view('user/editProfile', $data);
            $this->load->view('templates/auth_footer');
        } else {
            $new_image = $this->upload->data('file_name');
            $this->db->set('image', $new_image);
            $this->db->where('id_user', $data['user']['id_user']);
            $this->db->update('user');
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Foto Profile Berhasil Di Update<button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button> </div>');
            
            if ($data['user']['role_id'] == 1) {
                return redirect('user');
                // $this->load->view('templates/header_user', $data);
            } else if ($data['user']['role_id'] == 2) {
                return redirect('developer');
                // $this->load->view('templates/header_developer', $data);
            }

        }
    }

    public function addToCart($id)
    {
        $user = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(); #mengambil data 
        $game = $this->Model_game->find($id);

        $data = array(
            'id'      => $game->game_id, #wajib
            'qty'     => 1, #wajib
            'price'   => $game->price, #wajib
            'name'    => $game->gameName, #wajib
            'description' => $game->description, #optional
            'id_user' => $user['id_user'], #optional
            "developer_id" => $game->developer_id, #optional
            "image" => $game->image #optional

        );

        $this->cart->insert($data);
        return redirect('user/buyGame');
    }

    public function myCart()
    {
        $data['title'] = 'My Cart';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        if ($data['user']['role_id'] == 1) {
            $this->load->view('templates/header_user', $data);
        } else if ($data['user']['role_id'] == 2) {
            $this->load->view('templates/header_developer', $data);
        }
        $this->load->view('user/myCart', $data);
        $this->load->view('templates/auth_footer');
    }

    public function buyViaCart($rowid)
    {
        $data['title'] = 'My Games';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        // $data['games'] = $this->Model_game->tampil_data();
        $this->form_validation->set_rules('game_id', 'Game', 'required|trim');

        if ($data['user']) {
            if ($this->form_validation->run() == false) {
                if ($data['user']['role_id'] == 1) {
                    $this->load->view('templates/header_user', $data);
                } else if ($data['user']['role_id'] == 2) {
                    $this->load->view('templates/header_developer', $data);
                }
                $this->load->view('user/myCart', $data);
                $this->load->view('templates/auth_footer');
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Gagal Membeli Game<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button> </div>');
            } else {
                $this->UserModel->buyNewGame();
                $this->cart->remove($rowid);
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Game Berhasil dibeli<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button> </div>');
                if ($data['user']['role_id'] == 1) {
                    redirect('user');
                } else if ($data['user']['role_id'] == 2) {
                    redirect('developer');
                }
            }
        } else {
            redirect('auth');
        }
    }

    public function destroyCart()
    {
        $this->cart->destroy();
        redirect('user/myCart');
    }

    public function developerRequest()
    {
        $this->UserModel->devRequest();
        redirect('user/editProfile');
    }
}
