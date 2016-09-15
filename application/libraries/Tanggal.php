<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tanggal {
function Tanggal()
{
	//$this->load->model(array('common_query'));
	//$this->load->database();
}
function tgl_indo($tgl)
{
	$tanggal = substr($tgl,8,2);
	$bulan = $this->get_bulan(substr($tgl,5,2));
	$tahun = substr($tgl,0,4);
	return $tanggal.' '.$bulan.' '.$tahun;
}
function tgl_indo2($tgl)
{
	$tanggal = substr($tgl,8,2);
	$bulan = $this->get_bulan2(substr($tgl,5,2));
	$tahun = substr($tgl,0,4);
	return $tanggal.' '.$bulan.' '.$tahun;
}
function tgl_indo_date_month($tgl)
{
	$tanggal = substr($tgl,8,2);
	$bulan = $this->get_bulan2(substr($tgl,5,2));
	$tahun = substr($tgl,0,4);
	return $tanggal.' '.$bulan;
}
function tgl_indo_number($tgl)
{
	$tgls=explode("-", $tgl);
	return $tkl=$tgls[1]." ".$tgls[2]." ".$tgls[0];
}
function tgl_indo3($date)
{
        $new_date = explode('-',$date);
        return $new_date[2].'-'.$new_date[1].'-'.$new_date[0];
}
function tgl_indo4($date)
{
        $new_date = explode('-',$date);
        return $new_date[2].'/'.$new_date[1].'/'.$new_date[0];
}
function tgl_postgres($tgl)
{
	//if(strlen($tgl) > 0){
        if (preg_match("/-/", $tgl)) {
            $tgls=explode("-", $tgl);
            return $tkl=$tgls[2]."-".$tgls[1]."-".$tgls[0];
        }
        
        else return NULL;
}

function exp_date($tgl,$idx=0)
{
        if (preg_match("/-/", $tgl)) {
            $tgls=explode("-", $tgl);
            return $tgls[$idx];
        }
        
        else return NULL;
}

function tgl_eng($tgl)
{
        $tanggal = substr($tgl,8,2);
	$bulan = $this->convert_month_name('Num-Eng',substr($tgl,5,2));
	$tahun = substr($tgl,0,4);
	return $tanggal.'-'.$bulan.'-'.$tahun;
}

function get_bulan($bln)
{
	switch ($bln) {
			case 1 :
			return "Januari";
			break;
			case 2 :
			return "Februari";
			break;
			case 3 :
			return "Maret";
			break;
			case 4 :
			return "April";
			break;
			case 5 :
			return "Mei";
			break;
			case 6 :
			return "Juni";
			break;
			case 7 :
			return "Juli";
			break;
			case 8 :
			return "Agustus";
			break;
			case 9 :
			return "September";
			break;
			case 10 :
			return "Oktober";
			break;
			case 11 :
			return "November";
			break;
			case 12 :
			return "Desember";
			break;
		}
}

function get_bulan2($bln)
{
	switch ($bln) {
			case 1 :
			return "Jan";
			break;
			case 2 :
			return "Feb";
			break;
			case 3 :
			return "Mar";
			break;
			case 4 :
			return "Apr";
			break;
			case 5 :
			return "Mei";
			break;
			case 6 :
			return "Jun";
			break;
			case 7 :
			return "Jul";
			break;
			case 8 :
			return "Ags";
			break;
			case 9 :
			return "Sept";
			break;
			case 10 :
			return "Okt";
			break;
			case 11 :
			return "Nov";
			break;
			case 12 :
			return "Des";
			break;
		}
}

function convert_month_name($type = NULL, $month)
{
	if($type == 'Eng-Num')
	{
		switch ($month) {
			case "Jan" :
			return 1;
			break;
			case "Feb" :
			return 2;
			break;
			case "Mar" :
			return 3;
			break;
			case "Apr" :
			return 4;
			break;
			case "May" :
			return 5;
			break;
			case "Jun" :
			return 6;
			break;
			case "Jul" :
			return 7;
			break;
			case "Aug" :
			return 8;
			break;
			case "Sep" :
			return 9;
			break;
			case "Oct" :
			return 10;
			break;
			case "Nov" :
			return 11;
			break;
			case "Dec" :
			return 12;
			break;
		}
	}
	else if($type == 'Num-Eng')
	{
		switch ($month) {
			case 1 :
			return "Jan";
			break;
			case 2 :
			return "Feb";
			break;
			case 3 :
			return "Mar";
			break;
			case 4 :
			return "Apr";
			break;
			case 5 :
			return "May";
			break;
			case 6 :
			return "Jun";
			break;
			case 7 :
			return "Jul";
			break;
			case 8 :
			return "Aug";
			break;
			case 9 :
			return "Sep";
			break;
			case 10 :
			return "Oct";
			break;
			case 11 :
			return "Nov";
			break;
			case 12 :
			return "Dec";
			break;
		}
	}
	else return "ERROR!";
}

function nameday($tgl)
{
	$tgls=explode("-", $tgl);
	$namahari= date("l", mktime(0, 0, 0, $tgls[1], $tgls[2], $tgls[0]));
	switch ($namahari) 
			{
			case "Monday" :
			return "Senin";
			break;
			case "Tuesday" :
			return "Selasa";
			break;
			case "Wednesday" :
			return "Rabu";
			break;
			case "Thursday" :
			return "Kamis";
			break;
			case "Friday" :
			return "Jumat";
			break;
			case "Saturday" :
			return "Sabtu";
			break;
			case "Sunday" :
			return "Minggu";
			break;
			}
}

function name_day_eng($tgl)
{
	$tgls=explode("-", $tgl);
	return date("l", mktime(0, 0, 0, $tgls[1], $tgls[2], $tgls[0]));
}

function Romawi($no)
{
	switch ($no) 
			{
			case '01' :
			return "I";
			break;
			case '02' :
			return "II";
			break;
			case '03' :
			return "III";
			break;
			case '04' :
			return "IV";
			break;
			case '05' :
			return "V";
			break;
			case '06' :
			return "VI";
			break;
			case '07' :
			return "VII";
			break;
			case '08' :
			return "VIII";
			break;
			case '09' :
			return "IX";
			break;
			case '10' :
			return "X";
			break;
			case '11' :
			return "XI";
			break;
			case '12' :
			return "XII";
			break;
			case '13' :
			return "XIII";
			break;
			case '14' :
			return "XIV";
			break;
			case '15' :
			return "XV";
			break;
			}
}

	function Romawi2($no)
	{
	switch ($no) 
			{
			case 1 :
			return "I";
			break;
			case 2 :
			return "II";
			break;
			case 3 :
			return "III";
			break;
			case 4 :
			return "IV";
			break;
			case 5 :
			return "V";
			break;
			case 6 :
			return "VI";
			break;
			case 7 :
			return "VII";
			break;
			case 8 :
			return "VIII";
			break;
			case 9 :
			return "IX";
			break;
			case 10 :
			return "X";
			break;
			case 11 :
			return "XI";
			break;
			case 12 :
			return "XII";
			break;
			case 13 :
			return "XIII";
			break;
			case 14 :
			return "XIV";
			break;
			case 15 :
			return "XV";
			break;
			}
	}
	function sisahari($tgl)
	{
		$hariini=date('Y-m-d');
		return $jumlahhari = (strtotime($tgl) - strtotime($hariini)) / (60 * 60 * 24);
	}
	
	/**
	* @desc		: Fungsi untuk menghitung selisih hari
	* @params	: date 1, date 2
	**/
	function selisih_hari($date1, $date2){
		if($date1==$date2){
			$out = 1;
		}
		else{
			$tanggal1=explode('-', $date1);
			$tahun1=(int)$tanggal1[0];
			$bulan1=(int)$tanggal1[1];
			$hari_array1=explode(' ', $tanggal1[2]);
			$hari1=(int)$hari_array1[0];

			if (bcmod($tahun1, 4)==0) { //tahun kabisat
				$jml_hari1=$tahun1*366;
				$jml_hari1=$jml_hari1+ceil(($bulan1/2)) * 31;
				$jml_hari1=$jml_hari1+floor(($bulan1/2)) * 30;
				if ($bulan1>2) {
					$jml_hari1-= 1;
				}
				$jml_hari1=$jml_hari1+$hari1;
			}else{
				$jml_hari1=$tahun1*365;
				$jml_hari1=$jml_hari1+ceil(($bulan1/2)) * 31;
				$jml_hari1=$jml_hari1+floor(($bulan1/2)) * 30;
				if ($bulan1>2) {
				$jml_hari1-=1;
				}
				$jml_hari1=$jml_hari1+$hari1;
			}

			$tanggal2=explode('-', $date2);
			$tahun2=(int)$tanggal2[0];
			$bulan2=(int)$tanggal2[1];
			$hari_array2=explode(' ', $tanggal2[2]);
			$hari2=(int)$hari_array2[0];

			if (bcmod($tahun2, 4)==0) { //tahun kabisat
				$jml_hari2=$tahun2*366;
				$jml_hari2=$jml_hari2+ceil(($bulan2/2)) * 31;
				$jml_hari2=$jml_hari2+floor(($bulan2/2)) * 30;
				if ($bulan2>2) {
					$jml_hari2-=2;
				}
				$jml_hari2=$jml_hari2+$hari2;
			}else{
				$jml_hari2=$tahun2*365;
				$jml_hari2=$jml_hari2+ceil(($bulan2/2)) * 31;
				$jml_hari2=$jml_hari2+floor(($bulan2/2)) * 30;
				if ($bulan2>2) {
					$jml_hari2-=2;
				}
				$jml_hari2=$jml_hari2+$hari2;
			}
			$out = abs(($jml_hari1-$jml_hari2));
		}
		return $out;
	}
	/**
	* @author		: agung.sw
	* @desc			: Fungsi untuk pengurangan hari. Digunakan untuk menghitung lama dirawat pasien rawat inap
	* @params		: datetime $tgl1, datetime $tgl2
	**/
	function selisih_hari2($date1=NULL,$date2=NULL){
		$tgl1 = ($date1 == NULL ? date('Y-m-d H:i:s') : $date1);
		$tgl2 = ($date2 == NULL ? date('Y-m-d H:i:s') : $date2);
		$default_jam = '14:00:00';
		
		// memecah tanggal untuk mendapatkan bagian tanggal, bulan dan tahun
		// dari tanggal pertama
		$pecahjam1 = explode(" ", $tgl1);
		$pecah1 = explode("-", $pecahjam1[0]);
		$date1 = $pecah1[2];
		$month1 = $pecah1[1];
		$year1 = $pecah1[0];
		$jam1 = $pecahjam1[1];

		// memecah tanggal untuk mendapatkan bagian tanggal, bulan dan tahun
		// dari tanggal kedua
		$pecahjam2 = explode(" ", $tgl2);
		$pecah2 = explode("-", $pecahjam2[0]);
		$date2 = $pecah2[2];
		$month2 = $pecah2[1];
		$year2 =  $pecah2[0];
		$jam2 = $pecahjam2[1];

		// menghitung JDN dari masing-masing tanggal
		$jd1 = GregorianToJD($month1, $date1, $year1);
		$jd2 = GregorianToJD($month2, $date2, $year2);
		
		// validasi jam masuk & jam keluar
		if($tgl1 < $tgl2){
			// hitung selisih hari kedua tanggal
			$selisih = $jd2 - $jd1;
			
			// jika jam 2 > 14:00 selisih bertambah 1
			if(strtotime($jam2) > strtotime($default_jam)) $selisih += 1;
			
			// jika selisih hari = 0, set jadi 1
			if($selisih == 0) $selisih = 1;
		}
		else $selisih = 1;

		return $selisih;
	}
						
						
	function sisahari2($date1, $date2)
	{
		//$hariini=date('Y-m-d');
		
		$awal=explode('-',$date1);
		$awal_year=$awal[0];
		$awal_month=$awal[1];
		$awal_day=$awal[2];
		
		
		$akhir=explode('-',$date2);
		$akhir_year=$akhir[0];
		$akhir_month=$akhir[1];
		$akhir_day=$akhir[2];
		
		
		$waktu_tujuan = mktime(14,0,0,$awal_month,$awal_day,$awal_year);
		$waktu_sekarang = mktime(14,0,0,$akhir_month,$akhir_day,$akhir_year);
		$selisih=$waktu_sekarang - $waktu_tujuan ;
		$jumlah_hari = floor($selisih/86400);
		$hari=$jumlah_hari +1;
		
		$now = explode(':',date('H:i:s'));
				if($now[0]>14){
					$hari+=1;
				}
		
		/*$out = (strtotime($date2) - strtotime($date1)) / (60 * 60 * 24) + 1;
		$now = explode(':',date('H:i:s'));
				if($now[0]>13){
							$out+=1;
				}*/
		//return $lama_inap;
		
		/*if($date1==$date2){
						$out = 1;
						}
						else{
						$tanggal1=explode('-', $date1);
						$tahun1=(int)$tanggal1[0];
						$bulan1=(int)$tanggal1[1];
						$hari_array1=explode(' ', $tanggal1[2]);
						$hari1=(int)$hari_array1[0];
						
						if (bcmod($tahun1, 4)==0) { //tahun kabisat
							$jml_hari1=$tahun1*366;
							$jml_hari1=$jml_hari1+ceil(($bulan1/2)) * 31;
							$jml_hari1=$jml_hari1+floor(($bulan1/2)) * 30;
							if ($bulan1>2) {
								$jml_hari1-= 1;
							}
								$jml_hari1=$jml_hari1+$hari1;
						}else{
						$jml_hari1=$tahun1*365;
						$jml_hari1=$jml_hari1+ceil(($bulan1/2)) * 31;
						$jml_hari1=$jml_hari1+floor(($bulan1/2)) * 30;
						if ($bulan1>2) {
						$jml_hari1-=1;
						}
						$jml_hari1=$jml_hari1+$hari1;
						}
						
						$tanggal2=explode('-', $date2);
						$tahun2=(int)$tanggal2[0];
						$bulan2=(int)$tanggal2[1];
						$hari_array2=explode(' ', $tanggal2[2]);
						$hari2=(int)$hari_array2[0];
						
						if (bcmod($tahun2, 4)==0) { //tahun kabisat
						$jml_hari2=$tahun2*366;
						$jml_hari2=$jml_hari2+ceil(($bulan2/2)) * 31;
						$jml_hari2=$jml_hari2+floor(($bulan2/2)) * 30;
						if ($bulan2>2) {
						$jml_hari2-=2;
						}
						$jml_hari2=$jml_hari2+$hari2;
						}else{
						$jml_hari2=$tahun2*365;
						$jml_hari2=$jml_hari2+ceil(($bulan2/2)) * 31;
						$jml_hari2=$jml_hari2+floor(($bulan2/2)) * 30;
						if ($bulan2>2) {
						$jml_hari2-=2;
						}
						$jml_hari2=$jml_hari2+$hari2;
						}
						$out = abs(($jml_hari1-$jml_hari2));
						}
						
						/*$now = explode(':',date('H:i:s'));
						if($now[0]>13 ){
									$out+=1;
						}*/
						
						
						return $hari;
						
						
	}
	function bulan_tahun($tgl)
	{
		$oje=explode("-", $tgl);
		$bulan=$this->get_bulan($oje[1]);
		$tahun=$oje[0];
		$a=$bulan." ".$tahun;
		return $a;
		
	}
	function terbilang($x)
{
  $abil = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
  if ($x < 12)
    return " " . $abil[$x];
  elseif ($x < 20)
    return Terbilang($x - 10) . "belas";
  elseif ($x < 100)
    return Terbilang($x / 10) . " puluh" . Terbilang($x % 10);
  elseif ($x < 200)
    return " seratus" . Terbilang($x - 100);
  elseif ($x < 1000)
    return Terbilang($x / 100) . " ratus" . Terbilang($x % 100);
  elseif ($x < 2000)
    return " seribu" . Terbilang($x - 1000);
  elseif ($x < 1000000)
    return Terbilang($x / 1000) . " ribu" . Terbilang($x % 1000);
  elseif ($x < 1000000000)
    return Terbilang($x / 1000000) . " juta" . Terbilang($x % 1000000);
}


function GetAge($DOB, $DOD="") {

	// Get current date
	$CD = date("Y-n-d");
	list($cY,$cm,$cd) = explode("-",$CD);
	
	// Get date of birth
	list($bY,$bm,$bd) = explode("-",$DOB);
	// is there a date of death?
	
	if ($DOD!="" && $DOD != "0000-00-00") {

	// Animal is dead
		list($dY,$dm,$dd) = explode("-",$DOD);
			if ($bY == $dY) {
     			$months = $dm - $bm;
	     		if ($months == 0 || $months > 1) {
	     			return "$months bulan";
	     		} else
	    			return "$months bulan";
			} else 
   				$years = ( $dm.$dd < $bm.$bd ? $dY-$bY-1 : $dY-$bY );
	     		if ($years == 0 || $years > 1) {
	     			return "$years tahun";
				} else { 
	    			return "$years tahun";
				}

	} else {

	// Animal is alive
		if ($bY != "" && $bY != "0000") {	

	     	if ($bY == $cY) {
				// Birth year is current year
	     		$months = $cm - $bm;
		     		if ($months == 0 || $months > 1) {
		     			return "$months bulan";
		     		} else 
		    			return "$months bulan";
			} else if ($cY - $bY == 1 && $cm - $bm < 12) {
				// Born within 12 months, either side of 01 Jan
					//Determine days and therefore proportion of month
					if ($cd - $bd > 0) {
						$xm = 0;
					} else { 
						$xm = 1;
					}
				$months = 12 - $bm + $cm - $xm;
		     		if ($months == 0 || $months > 1) {
		     			return "$months bulan";
		     		} else { 
		    			return "$months bulan";
					}
			} 

			// Animal older than 12 months, return in years
			$years = (date("md") < $bm.$bd ? date("Y")-$bY-1 : date("Y")-$bY );
     		if ($years == 0 || $years > 1) {
     			return "$years tahun";
			} else { 
    			return "$years tahun";
			}
			
		} else	
    	return "No Date of Birth!";
	}	
}

	function tgl_bln_lahir_from($inp)
	{
		$tanggal=$inp;
		Switch ($tanggal){
			case '01' : $tanggal=1;
				Break;
			case '02' : $tanggal=2;
				Break;
			case '03' : $tanggal=3;
				Break;
			case '04' : $tanggal=4;
				Break;
			case '05' : $tanggal=5;
				Break;
			case '06' : $tanggal=6;
				Break;
			case '07' : $tanggal=7;
				Break;
			case '08' : $tanggal=8;
				Break;
			case '09' : $tanggal=9;
				Break;
		}
		return $tanggal;
	}
	
	function reverse_date($date)
	{
		$new_date = explode('-',$date);
		return $new_date[2].'-'.$new_date[1].'-'.$new_date[0];
	}
	
	function money_split($money)
	{
		// money format : $5,000.00
		$money = explode('.',$money);
		$money_r = str_replace('$','',str_replace(',','',$money[0]));
		return $money_r; // output : 5000
	}
	
	function money_trim($money)
	{
		// money format : 5.000,00
		$money = explode(',',$money);
		$money_r = str_replace('.','',$money[0]);
		return $money_r; // output : 5000
	}
	
	function display_money_format($money)
	{		
		// money format : $5,000.00
		$money_r = $this->money_split($money);
		$money_r = number_format($money_r, 2, ',', '.');
		return $money_r; // output : 5.000,00
	}
	function konv_to_money($money)
	{		
		// input format : 5000
		$money_r = number_format($money, 2, '.', ',');
		return $money_r; // output : $5,000.00
	}
	
	function split_date_time($datetime)
	{
		$time = explode(' ',$datetime);
		return array($time[0],$time[1]);
	}
	
	function conv_date($date)
	{
		// date format : Oct, 24 1986
		$arr = explode(' ', $date);
		$y = $arr[2];
		$m = $this->convert_month_name('Eng-Num', str_replace(',','',$arr[0]));
		$d = $arr[1];
		
		return $y.'-'.$m.'-'.$d; // output : 1986-1-24
	}
	
	function generate_cb_tgl($name)
	{
		# Tanggal
		$now_tgl = date('d');
		$btn_tgl = '<select name="'.$name.'" id="'.$name.'">';
		//$tgl = 1;
		$selected = NULL;
		for($tgl = 1; $tgl <= 31; $tgl++)
		{
			if(preg_match("/awal/i", $name))
			{
				$now_tgl = 1;
			}
			if($tgl == $now_tgl) $selected = "selected=\"selected\"";
			else $selected = NULL;
			$btn_tgl .= '<option value="'.$tgl.'" '.$selected.'>'.$tgl.'</option>';
		}
		$btn_tgl .= '</select>';
		return $btn_tgl;
	}
	
	function generate_cb_bln($name,$selected=NULL,$class=NULL)
	{
		# Bulan
		$now_bln = date('m');
		$btn_bln = '<select name="'.$name.'" id="'.$name.'" class="'.$class.'">';
		//$bln = 1;
		
		for($bln = 1; $bln <= 12; $bln++)
		{
			if(preg_match("/awal/i", $name))
			{
				$now_bln = 1;
			}
			
			if($selected == NULL)
			{
				$selected2 = NULL;
				if($bln == $now_bln) $selected2 = 'selected="selected"';
			}
			else
			{
				$selected2 = NULL;
				if($bln == $selected) $selected2 = 'selected="selected"';
			}
			$btn_bln .= '<option value="'.$bln.'" '.$selected2.'>'.$this->get_bulan($bln).'</option>';
		}
		$btn_bln .= '</select>';
		return $btn_bln;
	}
	
	function generate_cb_thn($name, $margin_awal=10, $margin_akhir=0, $selected=NULL, $class=NULL)
	{
		# Tahun
		$now_thn = date('Y');
		$btn_thn = '<select name="'.$name.'" id="'.$name.'" class="'.$class.'">';
		for($thn = $now_thn-$margin_awal; $thn <= $now_thn+$margin_akhir; $thn++)
		{
			if($selected == NULL)
			{
				$selected3 = NULL;
				if($thn == $now_thn) $selected3 = 'selected="selected"';
			}
			else
			{
				$selected3 = NULL;
				if($thn == $selected) $selected3 = 'selected="selected"';
			}
			$btn_thn .= '<option value="'.$thn.'" '.$selected3.'>'.$thn.'</option>';
		}
		$btn_thn .= '</select>';
		return $btn_thn;
	}
	
	// update function by anna qahhariana tgl 09-09-2011
	function get_jumlah_hari_dlm_bln($bln,$thn)
	{
		$num = cal_days_in_month(CAL_GREGORIAN,$bln,$thn);
		return $num;
	}
	
	function getday($time)
	{
		$hari = date("D", strtotime($time));
		return $hari;
	}
	
	function tgl_indo_3($tgl){
		$res = explode('-',$tgl);
		$tanggal = $res[2];
		$bulan = $this->get_bulan($res[1]);
		$tahun = $res[0];
		return $tanggal.' '.$bulan.' '.$tahun;
	}
	
	function conv_money($uang){ #=> Update By : Fahmi, Agung.SW(remove '$')
		$uang_explode = explode('.',$uang);
		if($uang_explode[0] < '1,000'){
			$uang_res = $uang_explode[0];
		}else{
			$uang_res = str_replace(',','',$uang_explode[0]);
		}
		return $uang_res;
	}
	/**
	* @author	: Agung.SW (agung.sulistyo.w@gmail.com)
	* @date		: Mar 1, 2012
	* @desc		: Fungsi get kelas rawat yang akan digunakan untuk menentukan tarif & membedakan antara tarif hari minggu & hari biasa
	* @params	: date tgl, int id_jns_pasien
	* @return	: array id_kls_rawat (hari,id_kelas_rawat)
	*/
	function get_kelas_rawat($tgl=NULL, $id_jns_pasien=1)
	{
		if($tgl != NULL)
		{
			$CI =& get_instance();
			
			$config = $CI->config->item('id_kls_rawat');
			$hari = $this->nameday($tgl);
			
			if($hari != 'Minggu')
			{
				$id_kls_rawat['hari'] = $hari;
				$id_kls_rawat['id_kelas_rawat'] = $config['hari_biasa'][$id_jns_pasien];
			}
			else
			{
				$id_kls_rawat['hari'] = $hari;
				$id_kls_rawat['id_kelas_rawat'] = $config['hari_minggu'][$id_jns_pasien];
			}
			return $id_kls_rawat;
		}
		else return FALSE;
	}
	
	function get_pajak()
	{
	    $CI =& get_instance();
			
			$config = $CI->config->item('pajak');
			$pajak=$config['pajak'];
			return $pajak;
	}
	
	function add_year($added=0, $date=NULL)
	{
		if($date == NULL) $date = date('Y-m-d');
		$newdate = strtotime ( '+'.$added.' year' , strtotime ( $date ) ) ;
		$newdate = date ( 'Y-m-j' , $newdate );
		 
		return $newdate;
	}
	
	function get_umur_sekarang($date)
	{
	  		$date_curr=explode("-",$date);
			$tahun_lahir=$date_curr[0];
			$bulan_lahir=$date_curr[1];
			$tanggal_lahir=$date_curr[2];
			
			$tgl_skrg=mktime(0,0,0,date("m"),date("d"),date("y"));

			//tentukan taggal lahirnya
			$tgl_lahir=mktime(0,0,0,$bulan_lahir,$tanggal_lahir,$tahun_lahir);
			//format : bulan,tanggal,tahun

			//hitung umur
			$umur=intval(($tgl_skrg-$tgl_lahir)/(60*60*24*365));


			$full_umur=($tgl_skrg-$tgl_lahir)/(60*60*24*365);
			//echo $full_umur."<br>";
			$full_bulan = round(($full_umur-$umur)*12);
			$res['umur']=$umur;
			$res['bulan']=$full_bulan;
			return $res;
	}
	
	function get_umur_kedatangan($date,$date2)
		{
	  		//-------------------------- > input date 1 tgl lahirnya
			$date_curr=explode("-",$date);
			$tahun_lahir=$date_curr[0];
			$bulan_lahir=$date_curr[1];
			$tanggal_lahir=$date_curr[2];
			//--------------------------- > input date 2 tgl kedatangannya
			$date_curr2=explode("-",$date2);
			$tahun_lahir2=$date_curr2[0];
			$bulan_lahir2=$date_curr2[1];
			$tanggal_lahir2=$date_curr2[2];
			
			
			$tgl_skrg=mktime(0,0,0,$bulan_lahir2,$tanggal_lahir2,$tahun_lahir2);

			//tentukan taggal lahirnya
			$tgl_lahir=mktime(0,0,0,$bulan_lahir,$tanggal_lahir,$tahun_lahir);
			//format : bulan,tanggal,tahun

			//hitung umur
			$umur=intval(($tgl_skrg-$tgl_lahir)/(60*60*24*365));


			$full_umur=($tgl_skrg-$tgl_lahir)/(60*60*24*365);
			//echo $full_umur."<br>";
			$full_bulan = round(($full_umur-$umur)*12);
			$res['umur']=$umur;
			$res['bulan']=$full_bulan;
			return $res;
	}
	
	function digit($angka=1){
		$res = ($angka < 10 ? '0'.$angka : $angka);
		return $res;
	}
	
	function get_jam($prefix='cb_jam',$selected_jam=NULL,$selected_menit=NULL){
		$open_jam = '<select id="jam_'.$prefix.'" name="jam_'.$prefix.'">';
		$open_menit = '<select id="menit_'.$prefix.'" name="menit_'.$prefix.'">';
		$close = '</select>';
		
		# Range jam : 01:00-24:00
		$now_jam = ($selected_jam == NULL ? date('H') : $selected_jam);
		$val_jam = NULL;
		for($i=1; $i<=24; $i++){
			$jam = $this->digit($i);
			$opt_jam = ($jam == $now_jam ? 'selected = "selected"' : NULL);
			$val_jam .= '<option value="'.$jam.'" '.$opt_jam.'>'.$jam.'</option>';
		}
		$cb_jam = $open_jam.$val_jam.$close;
		
		# Range menit : 00-59
		$now_menit = ($selected_menit == NULL ? date('i') : $selected_menit);
		$val_menit = NULL;
		for($j=0; $j<=59; $j++){
			$menit = $this->digit($j);
			$opt_menit = ($menit == $now_menit ? 'selected = "selected"' : NULL);
			$val_menit .= '<option value="'.$menit.'" '.$opt_menit.'>'.$menit.'</option>';
		}
		$cb_menit = $open_menit.$val_menit.$close;
		
		return $cb_jam.' : '.$cb_menit;
	}
	
        function konversi_bulan($bulan){
            if(strlen($bulan) == 1) return '0'.$bulan;
            else return $bulan;
        }
        
        /*
         * Add days with date (PHP >= 5.3.0)
         */
        function addDayswithdate($date,$days){
            $date = new DateTime($date);
            $date->add(new DateInterval('P'.$days.'D'));
            return $date->format('Y-m-d');
        }
        
        function reduceDayswithdate($date,$days){
            if($date == NULL) {
                $newdate = NULL;
            }
            else {
                $newdate = strtotime ( '-'.$days.' day' , strtotime ( $date ) ) ;
                $newdate = date ( 'Y-m-d' , $newdate );
            }
            return $newdate;
        }
        
        /**
         * input : '2014-10-24 10:00:00'
         * output : '24-20-2014'
         * @param type $datatime
         * @return boolean
         */
        function getDateReversedFromDatetime($datetime=NULL) {
            if($datetime !== NULL || strlen($datetime) > 0) {
                $exp = explode(' ',$datetime);
                return $this->tgl_postgres($exp[0]);
            }
            else return NULL;
        }
        
        /**
         * input : '2014-10-24 10:00:00'
         * output : '2014-10-24'
         * @param type $datatime
         * @return boolean
         */
        function getDateFromDatetime($datetime=NULL) {
            if($datetime !== NULL || strlen($datetime) > 0) {
                $exp = explode(' ',$datetime);
                return $exp[0];
            }
            else return NULL;
        }
        
        function get_months($startstring, $endstring)
        {
            $time1  = strtotime($startstring);//absolute date comparison needs to be done here, because PHP doesn't do date comparisons
            $time2  = strtotime($endstring);
            $my1     = date('mY', $time1); //need these to compare dates at 'month' granularity
            $my2    = date('mY', $time2);
            $year1 = date('Y', $time1);
            $year2 = date('Y', $time2);
            $years = range($year1, $year2);

            foreach($years as $year)
            {
                $months[$year] = array();
                while($time1 < $time2)
                {
                    if(date('Y',$time1) == $year)
                    {
                        $months[$year][] = date('m', $time1);
                        $time1 = strtotime(date('Y-m-d', $time1).' +1 month');
                    }
                    else
                    {
                        break;
                    }
                }
                continue;
            }

            return $months;
        }
		
		/**
		* Get date range between two date
		**/
		function get_days($sStartDate, $sEndDate){  
		  // Firstly, format the provided dates.  
		  // This function works best with YYYY-MM-DD  
		  // but other date formats will work thanks  
		  // to strtotime().  
		  $sStartDate = gmdate("Y-m-d", strtotime($sStartDate));  
		  $sEndDate = gmdate("Y-m-d", strtotime($sEndDate));  

		  // Start the variable off with the start date  
		 $aDays[] = $sStartDate;  

		 // Set a 'temp' variable, sCurrentDate, with  
		 // the start date - before beginning the loop  
		 $sCurrentDate = $sStartDate;  

		 // While the current date is less than the end date  
		 while($sCurrentDate < $sEndDate){  
		   // Add a day to the current date  
		   $sCurrentDate = gmdate("Y-m-d", strtotime("+1 day", strtotime($sCurrentDate)));  

		   // Add this new day to the aDays array  
		   $aDays[] = $sCurrentDate;  
		 }  

		 // Once the loop has finished, return the  
		 // array of days.  
		 return $aDays;  
	   }  
}
?>
