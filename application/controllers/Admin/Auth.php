<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // $userid = $this->session->userdata('admin_id');
        // if (!$userid) {
        //     redirect('');
        // }
        // $this->load->library('grocery_CRUD');
        $this->load->model('Admin_model');
    }

    public function register()
    {
        if ($this->input->post()) {

            // Validation Rules
            $this->form_validation->set_rules('username', 'Username', 'required|min_length[3]');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[admin.email]');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
            $this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|matches[password]');

            if ($this->form_validation->run() == TRUE) {
                $data = [
                    'username' => $this->input->post('username'),
                    'email'    => $this->input->post('email'),
                    'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
                    'role'     => 'admin',
                    'status'   => 1
                ];

                $this->Admin_model->insert_admin($data);
                $this->session->set_flashdata('success', 'Admin registered successfully!');
                redirect('Admin/auth/register');
            }
        }

        $this->load->view('Admin/Auth/register');
    }

    public function signin()
    {

        $this->load->view('Admin/Auth/signin');
    }

    public function login()
    {
        if ($this->input->method() == 'post') {
            $this->form_validation->set_rules('username', 'Username/Email', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->load->view('Admin/Auth/signin');
            } else {
                $username = $this->input->post('username');
                $password = $this->input->post('password');

                $admin = $this->Admin_model->check_login($username, $password);

                if ($admin) {
                    $this->session->set_userdata('admin_id', $admin->admin_id);
                    $this->session->set_userdata('admin_name', $admin->username);

                    redirect('Admin/Main');
                } else {
                    $this->session->set_flashdata('error_msg', 'Invalid Username/Password');
                    redirect('Admin/Auth/login');
                }
            }
        } else {
            $this->load->view('Admin/Auth/signin');
        }
    }

    // ==== LOGOUT ====
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('Welcome');
    }
}
