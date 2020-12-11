<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Detail extends CI_Controller {
    public function __construct(){    
		parent::__construct();
        $this->load->library("template");
        $this->load->model("detail_m");
        if(!$this->session->has_userdata('user_logged')){
            redirect('home');
        }
    }
    
	public function index()
	{
        $data = array(
            "title_page" => "Home"
        );
		$this->template->F_Show("halaman/home");  
    }
    
    public function ded($id_desain,$kategori_harga = 1)
	{
        $this->session->set_userdata("id_desain",$id_desain);
        $data = array(
            "title_page" => "Detail DED",
            "ded" => $this->detail_m->GetDed($id_desain),
			"id_desain" => $id_desain
        );
		$this->template->F_Show("halaman/detail/ded",$data);  
    }
    
    public function rab($id_desain)
	{
        $this->session->set_userdata("id_desain",$id_desain);
        $id_kategori_harga = 1;
        if(null !== $this->input->get("kategori_harga")){ $id_kategori_harga = $this->input->get("kategori_harga"); }
        $data = array(
            "title_page" => "Detail RAB",
            "kategori_harga" => $this->detail_m->GetKategoriHarga(),
            "rab_upah" => $this->detail_m->GetRabUpah($id_desain,$id_kategori_harga),
            "rab_material" => $this->detail_m->GetRabMaterial($id_desain,$id_kategori_harga),
            "harga_upah" => $this->detail_m->GetHargaUpah($id_desain,$id_kategori_harga),
            "pekerjaan" => $this->detail_m->GetPekerjaan($id_desain),
            "volume_pekerjaan" => $this->detail_m->GetVolumePekerjaan($id_desain),
            "boq_upah" => $this->detail_m->GetBOQ_upah($id_desain,$id_kategori_harga),
            "boq_material" => $this->detail_m->GetBOQ_material($id_desain),
			"id_desain" => $id_desain
        );
		$this->template->F_Show("halaman/detail/rab",$data);  
	}
}
