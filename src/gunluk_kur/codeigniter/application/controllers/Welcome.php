<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()	{
        $data["rows"]=$this->db->select("*")->from("kur")->get()->result();
		$this->load->view('welcome_message',$data);
        if (isset($_POST) && !empty($_POST)){
            $veri=simplexml_load_file("https://www.tcmb.gov.tr/kurlar/today.xml");
            setlocale(LC_TIME,"turkish");
            date_default_timezone_set("Europe/Istanbul");
            $data=array(
                array(
                    "isim"=>$veri->Currency[0]->Isim,
                    "alis"=>$veri->Currency[0]->ForexBuying,
                    "satis"=>$veri->Currency[0]->ForexSelling,
                    "tarih"=>date('d-m-Y H:i:s')
                ),
                array(
                    "isim"=>$veri->Currency[3]->Isim,
                    "alis"=>$veri->Currency[3]->ForexBuying,
                    "satis"=>$veri->Currency[3]->ForexSelling,
                    "tarih"=>date('d-m-Y H:i:s')
                ),
                array(
                    "isim"=>$veri->Currency[4]->Isim,
                    "alis"=>$veri->Currency[4]->ForexBuying,
                    "satis"=>$veri->Currency[4]->ForexSelling,
                    "tarih"=>date('d-m-Y H:i:s')
                ),
                array(
                    "isim"=>$veri->Currency[5]->Isim,
                    "alis"=>$veri->Currency[5]->ForexBuying,
                    "satis"=>$veri->Currency[5]->ForexSelling,
                    "tarih"=>date('d-m-Y H:i:s')
                ),
                array(
                    "isim"=>$veri->Currency[6]->Isim,
                    "alis"=>$veri->Currency[6]->ForexBuying,
                    "satis"=>$veri->Currency[6]->ForexSelling,
                    "tarih"=>date('d-m-Y H:i:s')
                ),
                array(
                    "isim"=>$veri->Currency[8]->Isim,
                    "alis"=>$veri->Currency[8]->ForexBuying,
                    "satis"=>$veri->Currency[8]->ForexSelling,
                    "tarih"=>date('d-m-Y H:i:s')
                ),
                array(
                    "isim"=>$veri->Currency[12]->Isim,
                    "alis"=>$veri->Currency[12]->ForexBuying,
                    "satis"=>$veri->Currency[12]->ForexSelling,
                    "tarih"=>date('d-m-Y H:i:s')
                ),
                array(
                    "isim"=>$veri->Currency[14]->Isim,
                    "alis"=>$veri->Currency[14]->ForexBuying,
                    "satis"=>$veri->Currency[14]->ForexSelling,
                    "tarih"=>date('d-m-Y H:i:s')
                ),
                array(
                    "isim"=>$veri->Currency[20]->Isim,
                    "alis"=>$veri->Currency[20]->ForexBuying,
                    "satis"=>$veri->Currency[20]->ForexSelling,
                    "tarih"=>date('d-m-Y H:i:s')
                )
            );
            $this->db->update_batch('kur', $data,"isim");
        }
	}
    public function test(){
        header("Content-Type: application/json");
        $alis_id=$this->input->post("alisid");
        $satis_id=$this->input->post("satisid");
        $gelen_alis=$this->db->select("*")->from("kur")->where("id",$alis_id)->limit(1)->get()->row();
        $gelen_satis=$this->db->select("*")->from("kur")->where("id",$satis_id)->get()->row();
        $data["alis_response"]=$gelen_alis->alis;
        $data["satis_response"]=$gelen_satis->satis;
        echo json_encode($data);
    }
}
