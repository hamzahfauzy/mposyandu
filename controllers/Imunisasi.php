<?php
require("models/Users_Model.php");

class Imunisasi extends Controller {
    
    function __construct(){
        parent::__construct();
        Session::init();
        if(!Session::get("username"))
            $this->redirect();
        $this->view->title = "Data Imunisasi";
    }
    
    function index(){
        $model = new Users_Model();
        $model->find()->where(["username"=>Session::get("username")])->one();
        $this->view->render("index",1,["model"=>$model]);
    }
    
    function cari($id){
        $model = new Anak_Model();
        $uname = Session::get("username");
        $model->find()->where(["anakID"=>$id])->one();
        $posyandu = new Posyandu_Model();
        $posyandu->find()->where(["anakID"=>$id,"jenis"=>1])->orderby(["posyanduID","Desc"])->one();
        $bulan_sekarang = explode("-",$posyandu->tanggal);
        if($bulan_sekarang[1]==date("m")){
            echo "Jadwal Imunisasi<br><br>";
            echo "<b>Hasil Imunisasi</b><br>";
            echo $posyandu->hasil;
        }else{
            echo "<b>Hasil Imunisasi</b><br>";
            $biday = new DateTime($model->tanggal_lahir);
            $today = new DateTime();
            	
            $diff = $today->diff($biday);
            $usia="";
            if($diff->d >= 0)
            	$usia .= $diff->d . " Hari ";
            if($diff->m > 0)
            	$usia .= $diff->m . " Bulan ";
            if($diff->y > 0)
                $usia .= $diff->y . " Tahun";
           
           
            $tanggal = explode("-",$model->tanggal_lahir);
            if(date("m") == 12){
                $tahun = (date("Y")+1);
                $bulan = 1;
            }else{
                $tahun = date("Y");
                $bulan = (date("m")+1);
            }
            $pada = "Pada ".$tanggal[2]."-".$bulan."-".$tahun;
            if($diff->m < 1)
            	$Rec .= "Anak Anda Harus Di beri Vaksin Hepatitis B Pertama";
            if($diff->m == 1)
            	$Rec .= "Anak Anda Harus Di beri Vaksin Hepatitis B Kedua";
            if($diff->m > 1 && $diff->m <= 3)
            	$Rec .= "Anak Anda Harus Di beri Vaksin Polio B Pertama, BCG Pertama, OTP Pertama, HIB Pertama, dan Rotavirus Pertama";
            if($diff->m > 3 && $diff->m <= 4)
            	$Rec .= "Anak Anda Harus Di beri Vaksin Polio B Kedua, BCG Kedua, OTP Kedua, HIB Kedua, dan Rotavirus Kedua";
            if($diff->m > 4 && $diff->m <= 6)
            	$Rec .= "Anak Anda Harus Di beri Vaksin Hepatitis B Ketiga, Polio B Ketiga, BCG Ketiga, OTP Ketiga, HIB Ketiga, Rotavirus Ketiga, Dan Influenza";
            if($diff->m == 9)
            	$Rec .= "Anak Anda Harus Di beri Vaksin Campak";
            if($diff->m >= 10 && $diff->m < 12 || $diff->m == 7 || $diff->m == 8){
            	$Rec = "";
            	$pada = "";
            }
            if($diff->m >= 12 && $diff->m <= 15)
            	$Rec .= "Anak Anda Harus Di beri Vaksin PCV ke 4";
            if($diff->m >= 15 && $diff->m <= 18)
            	$Rec .= "Anak Anda Harus Di beri Vaksin HIB ke 4 dan MMR Pertama";
            if($diff->m >= 18 && $diff->m <= 24)
            	$Rec .= "Anak Anda Harus Di beri Vaksin OTP ke 4";
            if($diff->m>=24){
            	$Rec = "periksa kembali tahun, bulan, hari yang anda inputkandan jika sudah benar maka anak anda tidak mendapatkan imunisasi lagi";
            	$pada = "";
            }
            	
    		$ret = "Usia Anak Anda Adalah ".$usia;
    		$recomend = $Rec ."<br>". $pada;
            echo $ret;
            echo "<br>";
            echo $recomend;
            
            $model = new Posyandu_Model();
            $model->anakID = $id;
            $model->usia = $usia;
            $model->hasil = $ret . "<br>" . $recomend;
            $model->jenis = 1;
            $model->tanggal = date("Y-m-d");
            $model->save();
        }
    }
    
    function asupan(){
        $model = new Users_Model();
        $model->find()->where(["username"=>Session::get("username")])->one();
        $this->view->render("asupan",1,["model"=>$model]);
    }
    
    function gizi($id){
        $model = new Anak_Model();
        $model->find()->where(["anakID"=>$id])->one();
        $posyandu = new Posyandu_Model();
        $posyandu->find()->where(["anakID"=>$id,"jenis"=>2])->orderby(["posyanduID","Desc"])->one();
        $bulan_sekarang = explode("-",$posyandu->tanggal);
        if($bulan_sekarang[1]==date("m")){
            echo "<b>Anda Sedang Melakukan Cek Asupan Gizi</b><br><br>";
            echo "<b>Hasil Cek Asupan Gizi</b><br><br>";
            echo $posyandu->hasil;
        }else{
            echo "<b>Hasil Cek Asupan Gizi</b><br><br>";
            $biday = new DateTime($model->tanggal_lahir);
            $today = new DateTime();
            $diff = $today->diff($biday);
            $usia="";
            if($diff->d >= 0)
                $usia .= $diff->d . " Hari";
            if($diff->m > 0)
                $usia .= ", ".$diff->m . " Bulan";
            if($diff->y > 0)
                $usia .= ", ".$diff->y . " Tahun";
            $tanggal = explode("-",$model->tanggal_lahir);
            if(date("m") == 12){
                $tahun = (date("Y")+1);
                $bulan = 1;
            }else{
                $tahun = date("Y");
                $bulan = (date("m")+1);
            }
            if($diff->y > 0)
                $BBI = ($diff->m*2)+4;
            else
                $BBI = ($diff->m/2)+4;
            
            if($diff->y == 0){
                $WKPG = 120;
                $protein = 2.5;
            }else if($diff->y >= 1 && $diff->y <= 3){
                $WKPG = 100;
                $protein = 2;
            }else if($diff->y >= 4 && $diff->y <= 6){
                $WKPG = 90;
                $protein = 1.8;
            }else if($diff->y >= 6 && $diff->y <= 10){
                $WKPG = 80;
                $protein = 1.5;
            }else if($diff->y > 10){
                $WKPG = 70;
                $protein = 1;
            }
            
            $WKPG = $WKPG * $BBI;
            $protein = ((10/100) * $WKPG)/4;
            $lemak = ((20/100) * $WKPG)/9;
            $karbohidrat = ((70/100) * $WKPG)/4;
            
            $Rec = "Berat Badan Ideal Anak Anda adalah ".$BBI." Kg<br>";
            $Rec .= "Kebutuhan Energi dan Zat Gizi per hari adalah ".$WKPG." kkal/kg<br>";
            $Rec .= "Kebutuhan Protein adalah ".$protein." g<br>";
            $Rec .= "Kebutuhan Lemak adalah ".$lemak." g<br>";
            $Rec .= "Kebutuhan Karbohidrat adalah ".$karbohidrat." g<br>";
            //Toast.makeText(Hasil.this, ""+month, Toast.LENGTH_LONG).show();
            	
    		$ret = "Usia Anak Anda Adalah ".$usia;
    		$recomend = $Rec;
            echo $ret;
            echo "<br>";
            echo $recomend;
            
            $model = new Posyandu_Model();
            $model->anakID = $id;
            $model->usia = $usia;
            $model->hasil = $ret . "<br>" . $recomend;
            $model->jenis = 2;
            $model->tanggal = date("Y-m-d");
            $model->save();
        }
    }
}