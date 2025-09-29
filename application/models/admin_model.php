<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{

    
      public function insert_admin($data) {
        return $this->db->insert('admin', $data);
    }
    public function check_login($username, $password) {
        $this->db->where('username', $username);
        $this->db->or_where('email', $username);
        $query = $this->db->get('admin');

        if ($query->num_rows() == 1) {
            $admin = $query->row();
            if (password_verify($password, $admin->password)) {
                return $admin;
            }
        }
        return false;
    }

     public function get_total_lost_items()
    {
        // Total pending/unresolved lost items
        return $this->db->where('status', 'Pending')->from('lost_items')->count_all_results();
    }

    public function get_total_found_items()
    {
        // Total items that have been marked as found (found by the system, not reported by the user)
        // Assuming 'Found' status means it was a reported lost item that has been found.
        return $this->db->where('status', 'Found')->from('lost_items')->count_all_results();
    }
    
    public function get_total_resolved_cases()
    {
        // Total resolved cases (assuming a 'Resolved' status for completed cases)
        return $this->db->where('status', 'Resolved')->from('lost_items')->count_all_results();
    }



    // Admin_model.php mein add karein

// 1. Top Locations Data
public function get_top_locations($limit = 5)
{
    $this->db->select('location_lost, COUNT(id) as report_count');
    $this->db->from('lost_items');
    $this->db->group_by('location_lost');
    $this->db->order_by('report_count', 'DESC');
    $this->db->limit($limit);
    return $this->db->get()->result_array();
}

// 2. Status Comparison Data
public function get_status_counts()
{
    $total = $this->db->from('lost_items')->count_all_results();
    $pending = $this->db->where('status', 'Pending')->from('lost_items')->count_all_results();
    $resolved = $this->db->where('status', 'Resolved')->from('lost_items')->count_all_results();
    $found = $this->db->where('status', 'Found')->from('lost_items')->count_all_results();

    return [
        'Total' => $total,
        'Pending' => $pending,
        'Resolved' => $resolved,
        'Found' => $found,
    ];
}
    public function get_items_by_category()
    {
        $this->db->select('c.category_name, COUNT(l.id) as item_count');
        $this->db->from('lost_items l');
        $this->db->join('categories c', 'c.id = l.category_id', 'left');
        $this->db->group_by('c.category_name');
        $this->db->order_by('item_count', 'DESC');
        return $this->db->get()->result_array();
    }

    public function get_weekly_reports()
    {
        // Get reports for the last 7 days
        $this->db->select("DATE(created_at) as date, COUNT(id) as total_reports");
        $this->db->where('created_at >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)');
        $this->db->group_by('date');
        $this->db->order_by('date', 'ASC');
        return $this->db->get('lost_items')->result_array();
    }

}