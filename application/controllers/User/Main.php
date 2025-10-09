<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('user_model');
        $this->load->model('user_model');
        $this->load->library('email');
        $this->load->library('session');
        $this->load->helper('string');
    }

    public function index()
    {
        $data['title'] = "Lost & Found | User Panel";
        $data['lost_items'] = $this->user_model->get_lost_items();

        $data['found_items'] = $this->user_model->get_found_items();
        $data['categories'] = $this->user_model->get_all_categories();
        $this->load->view('User/Main/index', $data);
    }

    public function get_filtered_items()
    {
        $tab = $this->input->get('tab');
        $category = $this->input->get('category');
        $location = $this->input->get('location');
        $date_from = $this->input->get('date_from');
        $date_to = $this->input->get('date_to');
        $sort_by = $this->input->get('sort_by');
        $search = $this->input->get('search');

        $this->db->select('lost_items.*, categories.category_name');
        $this->db->from('lost_items');
        $this->db->join('categories', 'categories.id = lost_items.category_id', 'left');

        // Tab-based filtering
        if ($tab === 'lost') {
            $this->db->where('lost_items.status', 'Pending');
        } elseif ($tab === 'found') {
            $this->db->where('lost_items.status', 'Found');
        }

        // Category filter
        if (!empty($category) && $category != 'all') {
            $this->db->where('lost_items.category_id', $category);
        }

        // Location filter
        if (!empty($location)) {
            $this->db->like('lost_items.location_lost', $location);
        }

        // Date range filter
        if (!empty($date_from) && !empty($date_to)) {
            $this->db->where('lost_items.date_lost >=', $date_from);
            $this->db->where('lost_items.date_lost <=', $date_to);
        } elseif (!empty($date_from)) {
            $this->db->where('lost_items.date_lost >=', $date_from);
        } elseif (!empty($date_to)) {
            $this->db->where('lost_items.date_lost <=', $date_to);
        }

        // Search filter
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('lost_items.item_name', $search);
            $this->db->or_like('lost_items.description', $search);
            $this->db->or_like('categories.category_name', $search);
            $this->db->or_like('lost_items.location_lost', $search);
            $this->db->group_end();
        }

        // Sorting
        if ($sort_by == 'oldest') {
            $this->db->order_by('lost_items.date_lost', 'ASC');
        } elseif ($sort_by == 'updated') {
            $this->db->order_by('lost_items.updated_at', 'DESC');
        } else {
            $this->db->order_by('lost_items.date_lost', 'DESC');
        }

        $query = $this->db->get();
        $result = $query->result();

        // Send JSON response
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($result));
    }

    public function send_email($oc_id)
    {



        $config = array(
            'protocol'  => 'smtp',
            'smtp_host' => 'smtp.gmail.com',   // Gmail SMTP host
            'smtp_port' => 587,                // TLS Port (465 for SSL)
            'smtp_user' => 'found&lost291@gmail.com', // Apna email
            'smtp_pass' => 'ducv-ermd-pykb-fcqe',   // Gmail App Password (16 char)
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'newline'   => "\r\n",
            'smtp_crypto' => 'tls',  // 'ssl' if using port 465
        );


        // $config = [
        //     'protocol' => 'smtp',
        //     'smtp_host' => 'proservices.softologics.com',
        //     'smtp_port' => 465,
        //     'smtp_user' => 'info@proservices.softologics.com',
        //     'smtp_pass' => 'Google1234@@@',
        //     'smtp_crypto' => 'ssl',
        //     'mailtype' => 'html',
        //     'charset' => 'utf-8',
        //     'newline' => "\r\n",
        //     'wordwrap' => true
        // ];

        $this->email->initialize($config);

        $this->email->from('found&lost291@gmail.com', 'PFI Payments System');
        $this->email->to('arbaznadeem3130@gmail.com');
        $this->email->subject('OTP FOR Registering Your Lost');

        $email_body = "";

        $this->email->message($email_body);

        if ($this->email->send()) {
            $this->email->clear(TRUE); 


            $this->session->set_flashdata('success', 'Email sent successfully to');
        } else {
            $this->session->set_flashdata('error', 'Failed to send email. Error: ');
        }

        // Controller function mein
        $this->session->set_flashdata('success', 'Email has been sent successfully');
        redirect('User/Main/index');
    }



    public function submit_lost_item()
    {
        header('Content-Type: application/json');

        try {
            // Validate required fields
            $required_fields = ['item_name', 'category_id', 'date_lost', 'location_lost', 'user_name', 'user_email', 'user_phone'];
            foreach ($required_fields as $field) {
                if (empty($this->input->post($field))) {
                    throw new Exception("Please fill all required fields.");
                }
            }

            // Generate random 6-digit OTP
            $otp = random_string('numeric', 6);
            
            // Handle file upload
            $image_path = null;
            if (!empty($_FILES['image']['name'])) {
                $config['upload_path'] = 'assets/uploads/';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size'] = 2048; // 2MB
                $config['encrypt_name'] = true;

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $upload_data = $this->upload->data();
                    $image_path = $upload_data['file_name'];
                } else {
                    throw new Exception($this->upload->display_errors());
                }
            }
            
            // Prepare data for temporary storage (session or temporary table)
            $report_data = [
                'item_name' => $this->input->post('item_name'),
                'category_id' => $this->input->post('category_id'),
                'description' => $this->input->post('description'),
                'date_lost' => $this->input->post('date_lost'),
                'location_lost' => $this->input->post('location_lost'),
                'image' => $image_path,
                'user_name' => $this->input->post('user_name'),
                'user_email' => $this->input->post('user_email'),
                'user_phone' => $this->input->post('user_phone'),
                'otp' => $otp,
                'created_at' => date('Y-m-d H:i:s'),
                'status' => 'pending_verification'
            ];

            // Store in session (you might want to use a temporary database table instead)
            $this->session->unset_userdata('pending_reports');
            $pending_reports = $this->session->userdata('pending_reports') ?? [];
            $report_id = uniqid();
            $pending_reports[$report_id] = $report_data;
            $this->email->clear(TRUE);
            $this->session->set_userdata('pending_reports', $pending_reports);

            // Send OTP email
            $email_sent = $this->send_otp_email($report_data['user_email'], $otp, $report_data['user_name']);

            if (!$email_sent) {
                echo $this->email->print_debugger(['headers']);
                throw new Exception("Failed to send OTP email. Please try again.");
            }

            echo json_encode([
                'success' => true,
                'report_id' => $report_id,
                'email' => $report_data['user_email'],
                'otp' => $otp,
                'message' => 'OTP sent to your email for verification.'
            ]);
        } catch (Exception $e) {
            echo json_encode([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    // Verify OTP and save to database
  public function verify_otp()
{
    header('Content-Type: application/json');

    $report_id   = $this->input->post('report_id');
    $entered_otp = $this->input->post('otp');

    $pending_reports = $this->session->userdata('pending_reports') ?? [];

    if (!isset($pending_reports[$report_id])) {
        echo json_encode([
            'success' => false,
            'message' => 'Invalid report session. Please submit the form again.'
        ]);
        return;
    }

    $report_data = $pending_reports[$report_id];

    // ✅ Fix: cast to string for comparison
    if ((string)$report_data['otp'] === (string)$entered_otp) {
        $lost_item_data = [
            'item_name'   => $report_data['item_name'],
            'category_id' => $report_data['category_id'],
            'description' => $report_data['description'],
            'date_lost'   => $report_data['date_lost'],
            'location_lost' => $report_data['location_lost'],
            'image'       => $report_data['image'],
            'user_name'   => $report_data['user_name'],
            'user_email'  => $report_data['user_email'],
            'user_phone'  => $report_data['user_phone'],
            'status'      => 'Pending',
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s')
        ];

        $this->db->insert('lost_items', $lost_item_data);
        $insert_id = $this->db->insert_id();

        if ($insert_id) {
            unset($pending_reports[$report_id]);
            $this->session->set_userdata('pending_reports', $pending_reports);
             $this->send_item_listed_email(
                $report_data['user_email'],
                $report_data['user_name'],
                $report_data['item_name']
            );

            echo json_encode([
                'success' => true,
                'message' => 'Your lost item has been reported successfully!'
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Failed to save report. Please try again.'
            ]);
        }
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Invalid OTP. Please try again.',
            'email'   => $report_data['user_email']
        ]);
    }
}


    // Resend OTP
    public function resend_otp()
    {
        header('Content-Type: application/json');

        $report_id = $this->input->post('report_id');
        $pending_reports = $this->session->userdata('pending_reports') ?? [];

        if (!isset($pending_reports[$report_id])) {
            echo json_encode([
                'success' => false,
                'message' => 'Invalid report session.'
            ]);
            return;
        }

        $report_data = $pending_reports[$report_id];

        // Generate new OTP
        $new_otp = random_string('numeric', 6);
        $pending_reports[$report_id]['otp'] = $new_otp;
        $this->session->set_userdata('pending_reports', $pending_reports);

        // Send new OTP
        $email_sent = $this->send_otp_email($report_data['user_email'], $new_otp, $report_data['user_name']);

        if ($email_sent) {
            echo json_encode([
                'success' => true,
                'message' => 'New OTP sent successfully.'
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Failed to resend OTP.'
            ]);
        }
    }

    public function submit_claim()
{
    // File upload config
    $proof_path = null;
    if (!empty($_FILES['proof_of_ownership']['name'])) {
        $config['upload_path']   = 'assets/uploads';
        $config['allowed_types'] = 'jpg|jpeg|png|pdf';
        $config['max_size']      = 2048; // 2MB
        $config['encrypt_name']  = true;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('proof_of_ownership')) {
            $upload_data = $this->upload->data();
            $proof_path = $upload_data['file_name'];
        } else {
            $this->session->set_flashdata('error', $this->upload->display_errors());
            redirect('User/Main/index');
        }
    }

    // Insert data into claims table
    $data = [
        'lost_item_id'      => $this->input->post('lost_item_id'), // modal open karte waqt pass karna hoga
        'full_name'         => $this->input->post('full_name'),
        'email'             => $this->input->post('email'),
        'phone'             => $this->input->post('phone'),
        'proof_of_ownership'=> $proof_path,
        'additional_details'=> $this->input->post('additional_details'),
        'status'            => 'Pending',
        'created_at'        => date('Y-m-d H:i:s'),
        'updated_at'        => date('Y-m-d H:i:s')
    ];

    $insert = $this->db->insert('claims', $data);

    if ($insert) {
        $this->session->set_flashdata('success', 'Your claim has been submitted successfully!');
    } else {
        $this->session->set_flashdata('error', 'Failed to submit your claim. Please try again.');
    }

    redirect('User/Main/index');
}

    // Delete pending report
    public function delete_pending_report()
    {
        $report_id = $this->input->post('report_id');
        $pending_reports = $this->session->userdata('pending_reports') ?? [];

        if (isset($pending_reports[$report_id])) {
            // Delete uploaded file if exists
            if (!empty($pending_reports[$report_id]['image'])) {
                $file_path = './assets/uploads/' . $pending_reports[$report_id]['image'];
                if (file_exists($file_path)) {
                    unlink($file_path);
                }
            }

            unset($pending_reports[$report_id]);
            $this->session->set_userdata('pending_reports', $pending_reports);
        }

        echo json_encode(['success' => true]);
    }

    // Send OTP Email
    private function send_otp_email($to_email, $otp, $user_name)
    {
        $config = array(
            'protocol'    => 'smtp',
            'smtp_host'   => 'smtp.gmail.com',
            'smtp_port'   => 587,
            'smtp_user'   => 'foundandlost291@gmail.com',
            'smtp_pass' => 'ngfx vjci xmec jusq',
            'smtp_crypto' => 'tls',  // 👈 yahan zaroori hai
            'mailtype'    => 'html',
            'charset'     => 'utf-8',
            'newline'     => "\r\n",
            'crlf'        => "\r\n",
            'wordwrap'    => TRUE
        );


        // $config = [
        //     'protocol' => 'smtp',
        //     'smtp_host' => 'proservices.softologics.com',
        //     'smtp_port' => 465,
        //     'smtp_user' => 'info@proservices.softologics.com',
        //     'smtp_pass' => 'Google1234@@@',
        //     'smtp_crypto' => 'ssl',
        //     'mailtype' => 'html',
        //     'charset' => 'utf-8',
        //     'newline' => "\r\n",
        //     'wordwrap' => true
        // ];
        $this->email->initialize($config);

        $this->email->from('found&lost291@gmail.com', 'Lost & Found System');
        $this->email->to($to_email);
        $this->email->subject('OTP Verification - Lost Item Report');

        $email_body = "
            <!DOCTYPE html>
            <html>
            <head>
                <style>
                    body { font-family: Arial, sans-serif; }
                    .container { max-width: 600px; margin: 0 auto; padding: 20px; }
                    .header { background: #3498db; color: white; padding: 20px; text-align: center; }
                    .content { padding: 20px; background: #f9f9f9; }
                    .otp-code { font-size: 32px; font-weight: bold; text-align: center; color: #3498db; margin: 20px 0; }
                    .footer { text-align: center; padding: 20px; font-size: 12px; color: #666; }
                </style>
            </head>
            <body>
                <div class='container'>
                    <div class='header'>
                        <h2>Lost & Found System</h2>
                    </div>
                    <div class='content'>
                        <h3>Hello {$user_name},</h3>
                        <p>Thank you for reporting your lost item. Please use the following OTP to verify your report:</p>
                        <div class='otp-code'>{$otp}</div>
                        <p>This OTP is valid for 10 minutes. If you didn't request this, please ignore this email.</p>
                    </div>
                    <div class='footer'>
                        <p>&copy; 2024 Lost & Found System. All rights reserved.</p>
                    </div>
                </div>
            </body>
            </html>
        ";

        $this->email->message($email_body);

        return $this->email->send();
    }
    private function send_item_listed_email($to_email, $user_name, $item_name)
{
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

    $this->email->initialize($config);
    $this->email->from('foundandlost291@gmail.com', 'Lost & Found System');
    $this->email->to($to_email);
    $this->email->subject('Your Lost Item Has Been Successfully Listed');

    $email_body = "
        <!DOCTYPE html>
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; }
                .container { max-width: 600px; margin: 0 auto; padding: 20px; }
                .header { background: #28a745; color: white; padding: 20px; text-align: center; }
                .content { padding: 20px; background: #f9f9f9; }
                .footer { text-align: center; padding: 20px; font-size: 12px; color: #666; }
            </style>
        </head>
        <body>
            <div class='container'>
                <div class='header'>
                    <h2>Lost & Found System</h2>
                </div>
                <div class='content'>
                    <h3>Hello {$user_name},</h3>
                    <p>Your lost item <strong>\"{$item_name}\"</strong> has been successfully listed in our system.</p>
                    <p>Our team and community will now help in finding it as soon as possible.</p>
                    <p>Thank you for trusting the <strong>Lost & Found System</strong>.</p>
                </div>
                <div class='footer'>
                    <p>&copy; 2025 Lost & Found System. All rights reserved.</p>
                </div>
            </div>
        </body>
        </html>
    ";

    $this->email->message($email_body);
    return $this->email->send();
}

}
