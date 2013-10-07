<?php
    class Tr_po_model extends CI_Model{

        private $primary_key='Kode';
        private $table_name='po_h';

        function __construct(){
            parent::__construct();
        }

        function get_paged_list()
        {
            $q = $this->db->query("SELECT po_h.*,
                supplier.Perusahaan, gudang.Nama
                FROM po_h
                LEFT OUTER JOIN supplier
                ON po_h.Kode_supplier = supplier.Kode
                LEFT OUTER JOIN gudang
                ON po_h.Kode_gudang = gudang.Kode");

            return $q->result();
        }
        
		function find($keyword){
            $this->db->like('Kode',$keyword,'after');
            $query=$this->db->get('po_h');
            return $query->result_array();
        }
		
        function add_cur($data,$id){
            $rr=$this->db->query("select * from currency where value = '$id'");
            if($rr->num_rows() ==  0)
            {
                $q=$this->db->insert('currency', $data);  
                return "ok";
            }else
            {
                return "gagal";
            }
        }
        
        function get_detail_po($id){
            $q = $this->db->query("SELECT po_d.*,
                barang.Nama, barang.Satuan1
                FROM po_d
                LEFT OUTER JOIN barang
                ON po_d.Kode_barang = barang.Kode
                WHERE Kode_po = '$id'");
            return $q->result();
        }

        function insertPo($data,$po)
        {
            $rr=$this->db->query("select Kode from po_h where Kode = '$po'");
            if($rr->num_rows() ==  0)
            {
                $q=$this->db->insert($this->table_name, $data);
                return "ok";
            }else
            {
                return "gagal";
            }
        }
        
        function insertPo_det($datadet,$po)
        {
            $this->db->insert('po_d', $datadet);
        }
        
        
        function updatePo($data, $po)
        {
            $this->db->where('Kode',$po);
            $this->db->update('po_h', $data);
            return "ok";
        }
                
        function delete($po)
        {
            $this->db->where('Kode',$po);
            $this->db->delete('po_h');
            return "ok";
        }
        function delete_det($po)
        {
            $this->db->where('Kode_po',$po);
            $this->db->delete('po_d');
            //return "ok";
        }
    }
/*
 * End Of File
 * location: model/tr_po_model
 */