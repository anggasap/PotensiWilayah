<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Distribusi_m extends CI_Model {
    public function getRencanaOutAll($tglAwal, $tglAkhir) {
        $sql = "SELECT mo.id_master_out as id_master_out, 
            mc.nama_cust as nama_cust,
            mo.no_suratjalan as no_sj,
            mp.nama_produk as nama_produk,
            mjd.no_jnsdoc as no_jnsdoc,
            mjd.nama_jnsdoc as nama_jnsdoc,
            mo.total_qty as total_qty,
            mo.no_batch as no_batch,
            mo.no_aju as no_aju,
            mo.no_cukai as no_cukai, 
            mo.etd as etd, 
            mo.keterangan_so,
            mo.tgl_trans_distribusi 
            FROM master_out mo 
            LEFT JOIN master_customer mc ON mo.id_cust = mc.id_cust  
            left join master_produk mp on mo.id_produk = mp.id_produk 
            left join master_jnsdoc mjd on mo.id_jnsdoc = mjd.id_jnsdoc 
            where mo.etd between '$tglAwal' and '$tglAkhir'";
        $query = $this->db->query($sql);
        return $query->result(); // returning rows, not row
    }
/*
    public function getRencanaOutAll() {
        $sql = "SELECT * from master_out mo left join master_customer mc on mo.id_cust = mc.id_cust where mo.status_keluar = 0 and mo.status_pack=0";
        $query = $this->db->query($sql);
        return $query->result(); // returning rows, not row
    }
*/
    public function getDescSO($noSO) {
        $sql = "select * from master_out mo left join master_customer mc on mo.id_cust = mc.id_cust where mo.id_master_out = '$noSO' ";
        $query = $this->db->query($sql);
        if ($query->num_rows() == '1') {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getJmlRincianSO($noSO) {
        $sql = "select * from trans_out ti "
                . "left join master_produk mp on ti.id_produk = mp.id_produk "
                . "left join master_storage ms on ti.id_storage = ms.id_storage "
                . "where id_master = '$noSO' ";
        $query = $this->db->query($sql);
        if ($query->num_rows() <> 0) {
            $data['jml'] = $query->num_rows();
            return $data;
        } else {
            return false;
        }
    }

    public function getRincianSO($noSO) {
        $sql = "select * from trans_out ti "
                . "left join master_produk mp on ti.id_produk = mp.id_produk "
                . "left join master_storage ms on ti.id_storage = ms.id_storage "
                . "where id_master = '$noSO' ";
        $query = $this->db->query($sql);
        if ($query->num_rows() <> 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getJnsMobil() {
        $rows = array(); //will hold all results
        $sql = "select * from master_jnsmobil order by id_jnsmobil asc ";
        $query = $this->db->query($sql);
        foreach ($query->result_array() as $row) {
            $rows[] = $row; //add the fetched result to the result array;
        }
        return $rows; // returning rows, not row
    }

    public function getJnsSegel() {
        $rows = array(); //will hold all results
        $sql = "select * from master_jnssegel order by id_jnssegel asc ";
        $query = $this->db->query($sql);
        foreach ($query->result_array() as $row) {
            $rows[] = $row; //add the fetched result to the result array;
        }
        return $rows; // returning rows, not row
    }

    public function getCDistribusi($noSO) {
        $this->db->select('tod.*');
        $this->db->from('trans_out_distribusi tod');
        $this->db->where('id_master_out', $noSO);
//
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function getDescDistribusi($noSO) {
        $this->db->select('tod.*, mjm.nama_jnsmobil,mjs.nama_jnssegel'); //,mjms.nama_jnsmobilsw
        $this->db->from('trans_out_distribusi tod');
        $this->db->join('master_jnsmobil mjm', 'tod.id_jnsmobil = mjm.id_jnsmobil', 'LEFT');
        //$this->db->join('master_jnsmobilsewa mjms', 'tod.id_jnsmobilsewa = mjms.id_jnsmobilsw', 'LEFT');
        $this->db->join('master_jnssegel mjs', 'tod.id_jnssegel = mjs.id_jnssegel', 'LEFT');
        $this->db->where('id_master_out', $noSO);
        $query = $this->db->get();

        $rows['data_cpa'] = $query->result();
        return $rows;
    }
    function deleteDataDistribusi($noSO){
		$this->db->trans_begin();
		$query1	=	$this->db->where('id_master_out',$noSO);
		$query2	=   $this->db->delete('trans_out_distribusi');
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}
		else{
			$this->db->trans_commit();
			return true;
		}
	} 
    function insertTransOutDistribusi($data) {
        $this->db->trans_begin();
        $model = $this->db->insert('trans_out_distribusi', $data);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    function updateMasterOut($data, $id_master) {
        $this->db->trans_begin();
        $query1 = $this->db->where('id_master_out', $id_master);
        $query2 = $this->db->update('master_out', $data);
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