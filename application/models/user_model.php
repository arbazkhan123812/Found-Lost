<?php
defined('BASEPATH') or exit('No direct script access allowed');

class user_model extends CI_Model
{
public function get_lost_items()
{
    $this->db->select('lost_items.*, categories.category_name as category'); // dono table ka data
    $this->db->from('lost_items');
    $this->db->join('categories', 'categories.id = lost_items.category_id', 'left'); // join
    $this->db->order_by('lost_items.date_lost', 'DESC');
    $this->db->where('lost_items.status','Pending');

    return $this->db->get()->result();
}
public function get_found_items()
{
    $this->db->select('lost_items.*, categories.category_name as category'); // dono table ka data
    $this->db->from('lost_items');
    $this->db->join('categories', 'categories.id = lost_items.category_id', 'left'); // join
    $this->db->order_by('lost_items.date_lost', 'DESC');
    $this->db->where('lost_items.status','Found');

    return $this->db->get()->result();
}
 public function get_all_categories() {
        return $this->db->get('categories')->result();
    }

    

    public function filter_items($category, $location, $date_from, $date_to, $sort_by, $search = null)
{
    $this->db->select('lost_items.*, categories.category_name as category');
    $this->db->from('lost_items');
    $this->db->join('categories', 'categories.id = lost_items.category_id', 'left');

    // Category filter
    if ($category && $category != "all") {
        $this->db->where('lost_items.category_id', $category);
    }

    // Location filter
    if (!empty($location)) {
        $this->db->like('lost_items.location_lost', $location);
    }

    // Date range filter
    if (!empty($date_from) && !empty($date_to)) {
        $this->db->where("lost_items.date_lost BETWEEN '$date_from' AND '$date_to'");
    }

    // Search filter (top search bar se)
    if (!empty($search)) {
        $this->db->group_start();
        $this->db->like('lost_items.item_name', $search);
        $this->db->or_like('lost_items.description', $search);
        $this->db->or_like('lost_items.location_lost', $search);
        $this->db->group_end();
    }

    // Sorting
    if ($sort_by == "oldest") {
        $this->db->order_by('lost_items.date_lost', 'ASC');
    } elseif ($sort_by == "updated") {
        $this->db->order_by('lost_items.updated_at', 'DESC');
    } else {
        $this->db->order_by('lost_items.date_lost', 'DESC');
    }

    return $this->db->get()->result();
}


}
?>