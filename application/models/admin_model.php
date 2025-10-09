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


    public function get_latest_notifications($limit = 5)
{
    // Lost Items (latest)
    $this->db->select("id, item_name AS title, 'lost_item' AS type, created_at");
    $this->db->from("lost_items");
    $this->db->order_by("created_at", "DESC");
    $this->db->limit($limit);
    $lost_items = $this->db->get()->result_array();

    // Claims (latest)
    $this->db->select("id, full_name AS title, 'claim' AS type, created_at");
    $this->db->from("claims");
    $this->db->order_by("created_at", "DESC");
    $this->db->limit($limit);
    $claims = $this->db->get()->result_array();

    // Merge dono results
    $notifications = array_merge($lost_items, $claims);

    // Sort combined array by created_at (latest first)
    usort($notifications, function ($a, $b) {
        return strtotime($b['created_at']) - strtotime($a['created_at']);
    });

    // Sirf last 5 hi return karo
    return array_slice($notifications, 0, $limit);
}


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