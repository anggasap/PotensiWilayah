<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Master_jenislk_m extends CI_Model {

    public function getJenislkAll() {
        $sql = "SELECT * from master_jenislk ";
        $query = $this->db->query($sql);
        return $query->result(); // returning rows, not row
    }

    public function getIdJenislk() {
        $sql = "select id_jenislk from master_jenislk";
        $query = $this->db->query($sql);
        $jml = $query->num_rows();
        if ($jml == 0) {
            $id_jenislk = "000001";
            return $id_jenislk;
        } else {
            $sql = "select max(right(id_jenislk,6)) as id_jenislk from master_jenislk";
            $query = $this->db->query($sql);
            $hasil = $query->result();
            $id_jenislk = $hasil[0]->id_jenislk;
            $id_jenislk = sprintf('%06u', $id_jenislk + 1);
            return $id_jenislk;
        }
    }

    public function getDescJenislk($idJenislk) {
        $this->db->select('s.nama_jenislk, s.alamat, s.telp, s.npwp ');
        $this->db->from('master_jenislk s');
        $this->db->where('s.id_jenislk', $idJenislk);
        $query = $this->db->get();
        if ($query->num_rows() == '1') {
            return $query->result();
        } else {
            return false;
        }
    }

    public function insert($data) {

        $this->db->trans_begin();
        $model = $this->db->insert('master_jenislk', $data);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    function update($data, $jenislkId) {
        $this->db->trans_begin();
        $query1 = $this->db->where('id_jenislk', $jenislkId);
        $query2 = $this->db->update('master_jenislk', $data);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    /* 	public function cekMasterAdvance($kywId){
      $sql= "select id_kyw from master_advance where id_kyw = '$kywId'";
      $query = $this->db->query($sql);
      $jml = $query->num_rows();
      if($jml == 0){
      return true;
      }else{
      return false;
      }
      }
      public function cekMasterReqpay($kywId){
      $sql= "select id_kyw from master_reqpay where id_kyw = '$kywId'";
      $query = $this->db->query($sql);
      $jml = $query->num_rows();
      if($jml == 0){
      return true;
      }else{
      return false;
      }
      }
      public function cekMasterReimpay($kywId){
      $sql= "select id_kyw from master_reimpay where id_kyw = '$kywId'";
      $query = $this->db->query($sql);
      $jml = $query->num_rows();
      if($jml == 0){
      return true;
      }else{
      return false;
      }
      } */

    function delete($jenislkId) {
        $this->db->trans_begin();
        $query1 = $this->db->where('id_jenislk', $jenislkId);
        $query2 = $this->db->delete('master_jenislk');
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

}

/* End of file sec_menu_user_m.php */
/* Location: ./application/models/sec_menu_user.php */