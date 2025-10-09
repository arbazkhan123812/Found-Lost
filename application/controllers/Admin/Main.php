<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $userid = $this->session->userdata('admin_id');
        if (!$userid) {
            redirect('Admin/Auth/signin');
        }
        $this->load->model('Admin_model');
    }
    public function index()
    {
        // Fetch Live Data from Model
        $data['total_lost'] = $this->Admin_model->get_total_lost_items();
        $data['total_found'] = $this->Admin_model->get_total_found_items();
        $data['total_resolved'] = $this->Admin_model->get_total_resolved_cases();

        $data['notifications'] = $this->Admin_model->get_latest_notifications(5);

        // Data for Charts
        $data['category_data'] = $this->Admin_model->get_items_by_category();
        $data['weekly_data'] = $this->Admin_model->get_weekly_reports();
        $data['location_data'] = $this->Admin_model->get_top_locations(4); // Top 4 locations
        $data['status_data'] = $this->Admin_model->get_status_counts();

        $data['title'] = "Admin Dashboard";

        $this->load->view('Admin/template/header', $data);
        $this->load->view('admin/template/sidebar');
        $this->load->view('Admin/Main/dashboard', $data);
        $this->load->view('Admin/template/footer');
    }
    public function claim_requests()
    {
        $crud = new grocery_CRUD();

        $crud->set_table('claims');
        $crud->set_subject('Claim Request');

        // Fields
        $crud->columns('id', 'full_name', 'email', 'phone', 'proof_of_ownership', 'additional_details', 'status', 'created_at');
        $crud->fields('status');

        // File Upload
        $crud->set_field_upload('proof_of_ownership', 'assets/uploads');

        // Display Labels
        $crud->display_as('full_name', 'Full Name')
            ->display_as('email', 'Email Address')
            ->display_as('phone', 'Phone Number')
            ->display_as('proof_of_ownership', 'Image')
            ->display_as('additional_details', 'Additional Details')
            ->display_as('created_at', 'Submitted At');


        // Render output
        $output = $crud->render();

        $data['output'] = $output;


        $this->load->view('Admin/template/header', (array)$output);
        $this->load->view('Admin/template/sidebar');
        $this->load->view('Admin/crud', (array)$data);
        $this->load->view('Admin/template/footer');
    }
    public function lostitems()
    {
        $this->load->library('grocery_CRUD');

        try {
            $crud = new grocery_CRUD();

            $crud->set_table('lost_items');
            $crud->set_subject('Lost Item');

            // add category field
            $crud->columns('item_name', 'category_id', 'description', 'date_lost', 'location_lost', 'status');
            $crud->fields('item_name', 'category_id', 'description', 'date_lost', 'location_lost', 'image', 'status');
            $crud->required_fields('item_name', 'category_id', 'date_lost', 'location_lost');

            // relation for dropdown
            $crud->set_relation('category_id', 'categories', 'category_name');

            $crud->set_field_upload('image', 'assets/uploads');

            $crud->field_type('status', 'dropdown', [
                'Pending'   => 'Pending',
                'Found'     => 'Found',
                'Returned'  => 'Returned'
            ]);

                 $crud->add_action(
            '', 
            '', 
            '', 
            'fa fa-envelope', 
            array($this, 'send_email_callback')
        );
            // Render output
            $output = $crud->render();

            $data['title'] = "Lost Items";
            $data['output'] = $output;

            $this->load->view('Admin/template/header', $data);
            $this->load->view('Admin/template/sidebar', $data);
            $this->load->view('Admin/crud', $data);
            $this->load->view('Admin/template/footer', $data);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function send_email_callback($primary_key, $row)
{
    // Dynamic URL for the "Send Email" action
    return site_url('Admin/Main/send_found_email/' . $primary_key);
}

    public function send_found_email($id)
{
    // Fetch item and user info
    $item = $this->db->get_where('lost_items', ['id' => $id])->row();

    if (!$item) {
        show_error('Item not found.');
        return;
    }

    $to_email  = $item->user_email;
    $user_name = $item->user_name;
    $item_name = $item->item_name;

    // Email configuration
    $config = array(
        'protocol'    => 'smtp',
        'smtp_host'   => 'smtp.gmail.com',
        'smtp_port'   => 587,
        'smtp_user'   => 'foundandlost291@gmail.com',
        'smtp_pass'   => 'ngfx vjci xmec jusq',
        'smtp_crypto' => 'tls',
        'mailtype'    => 'html',
        'charset'     => 'utf-8',
        'newline'     => "\r\n",
        'crlf'        => "\r\n",
        'wordwrap'    => TRUE
    );

    $this->load->library('email');
    $this->email->initialize($config);
    $this->email->from('foundandlost291@gmail.com', 'Lost & Found System');
    $this->email->to($to_email);
    $this->email->subject('Your Lost Item Has Been Found!');

    // Email body
    $email_body = "
        <!DOCTYPE html>
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; }
                .container { max-width: 600px; margin: 0 auto; padding: 20px; }
                .header { background: #0072b5; color: white; padding: 20px; text-align: center; }
                .content { padding: 20px; background: #f9f9f9; }
                .footer { text-align: center; padding: 15px; font-size: 12px; color: #666; }
                .btn { background-color: #0072b5; color: white; padding: 10px 20px; text-decoration: none; border-radius: 4px; }
            </style>
        </head>
        <body>
            <div class='container'>
                <div class='header'>
                    <h2>Lost & Found System</h2>
                </div>
                <div class='content'>
                    <h3>Hello {$user_name},</h3>
                    <p>Good news! Your lost item <strong>\"{$item_name}\"</strong> has been found.</p>
                    <p>Please reach out to the administrator as soon as possible to receive your item.</p>
                </div>
                <div class='footer'>
                    <p>&copy; 2025 Lost & Found System. All rights reserved.</p>
                </div>
            </div>
        </body>
        </html>
    ";

    $this->email->message($email_body);

    if ($this->email->send()) {
        $this->session->set_flashdata('success', 'Email sent successfully to ' . $to_email);
    } else {
        $this->session->set_flashdata('error', 'Failed to send email. Please check email configuration.');
    }

    redirect('Admin/Main/lostitems');
}


    public function founditems()
    {
        $this->load->library('grocery_CRUD');

        try {
            $crud = new grocery_CRUD();

            $crud->set_table('lost_items');
            $crud->set_subject('Found Item');

            // sirf Found status wale records show karo
            $crud->where('status', 'Found');

            // columns jo dikhane hain
            $crud->columns('item_name', 'description', 'date_lost', 'location_lost', 'image', 'status');

            // image ko file ke bajaye preview dikhane ke liye
            $crud->set_field_upload('image', 'assets/uploads');

            // add, edit, delete disable
            $crud->unset_add();
            $crud->unset_edit();
            $crud->unset_delete();

            // view bhi disable karna ho to
            // $crud->unset_read();

            // render
            $output = $crud->render();

            $data['title'] = "Found Items";
            $data['output'] = $output;

            $this->load->view('Admin/template/header', $data);
            $this->load->view('Admin/template/sidebar', $data);
            $this->load->view('Admin/crud', $data);
            $this->load->view('Admin/template/footer', $data);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }
    public function categories()
    {
        $this->load->library('grocery_CRUD');

        try {
            $crud = new grocery_CRUD();

            $crud->set_table('categories');
            $crud->set_subject('Category');

            // jo columns list view mein dikhane hain
            $crud->columns('id', 'category_name');

            // form fields
            $crud->fields('category_name');

            // required fields
            $crud->required_fields('category_name');

            // render output
            $output = $crud->render();

            $data['title'] = "Categories";
            $data['output'] = $output;

            $this->load->view('Admin/template/header', $data);
            $this->load->view('Admin/template/sidebar', $data);
            $this->load->view('Admin/crud', $data);
            $this->load->view('Admin/template/footer', $data);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }



    public function admins()
    {
        $this->load->library('grocery_CRUD');

        try {
            $crud = new grocery_CRUD();

            $crud->set_table('admin');
            $crud->set_subject('Admin User');

            // Columns jo list me dikhani hain
            $crud->columns('username', 'email', 'role', 'status', 'created_at');

            // Fields for add/edit
            $crud->fields('username', 'email', 'password', 'role', 'status');
            $crud->required_fields('username', 'email', 'password', 'role');

            // Password field type
            $crud->change_field_type('password', 'password');

            // Role dropdown
            $crud->field_type('role', 'dropdown', [
                'superadmin' => 'Super Admin',
                'admin'      => 'Admin'
            ]);

            // Status dropdown
            $crud->field_type('status', 'dropdown', [
                '1' => 'Active',
                '0' => 'Inactive'
            ]);

            // created_at ko hide kar do (auto fill hota hai)
            $crud->unset_fields('created_at');

            // Password hashing
            $crud->callback_before_insert([$this, 'hash_password_callback']);
            $crud->callback_before_update([$this, 'hash_password_callback']);

            // render
            $output = $crud->render();

            $data['title'] = "Admins";
            $data['output'] = $output;

            $this->load->view('Admin/template/header', $data);
            $this->load->view('Admin/template/sidebar', $data);
            $this->load->view('Admin/crud', $data);
            $this->load->view('Admin/template/footer', $data);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    // Password hashing callback
    public function hash_password_callback($post_array)
    {
        if (!empty($post_array['password'])) {
            $post_array['password'] = password_hash($post_array['password'], PASSWORD_BCRYPT);
        } else {
            unset($post_array['password']); // agar edit ke time blank chhoda to purana password hi rahe
        }
        return $post_array;
    }
}
