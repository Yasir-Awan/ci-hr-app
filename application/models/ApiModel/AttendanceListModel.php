<?php
defined('BASEPATH') or exit('No direct script access allowed');
class AttendanceListModel extends CI_Model
{
    public function get_attendance_list()
    {
        $query = $this->db->get('view_attendance_detail');
        return $query->result_array();
    }

    function count_assets($table)
  {
      // $this->db->where('route', 1);
      // $this->db->group_by('name');
      $query = $this->db->get($table);
      return $query->num_rows();
  }
  function asset_allposts($limit, $start, $table)
  {
      // $this->db->where('route', 1);
      // $this->db->group_by('name');
      $this->db->limit($limit, $start);
      // $this->db->order_by('id', 'asc');
      $query =  $this->db->get($table);
      if ($query->num_rows() > 0) {
        return $query->result();
      } else {
        return null;
      }
  }
}
