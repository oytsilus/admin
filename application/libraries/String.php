<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class String {
    /*
     * Clean delimiter ';' at the end of string
     */
    public function cleanDelimiter1($string) {
        // Clean ';' at the end of string
        return preg_replace("/(;)+$/", "", $string);
    }
    
    /*
     * Replace ';' at the middle of string with '-'
     * Return example : 'Jakarta-Surabaya-Makassar'
     */
    public function cleanDestination($string) {
        $clean = $this->cleanDelimiter1($string);
        return preg_replace("/(;)/", "-", $clean);
    }
    
    /*
     * Clean delimiter '-' at the end of string
     */
    public function cleanDelimiter2($string) {
        // Clean '-' at the end of string
        return preg_replace("/(-)+$/", "", $string);
    }
	
	/*
     * Clean delimiter ',' at the end of string
     */
    public function cleanDelimiter3($string) {
        // Clean '-' at the end of string
        return preg_replace("/(,)+$/", "", $string);
    }
    
    /*
     * Replace '-' at the middle of string with ','
     * Return example : '10,9,8'
     */
    public function cleanID($string) {
        $clean = $this->cleanDelimiter2($string);
        return preg_replace("/(-)/", ",", $clean);
    }
    
    /*
     * Replace '-' at the middle of string with ',' for String
     * Return example : 'aa','bb'
     */
    public function cleanIDString($string) {
        $clean = $this->cleanDelimiter2($string);
        $exp = explode('-',$clean);
        
        $newStr = NULL;
        if(count($exp) > 0) {
            foreach($exp as $value) {
                $newStr .= "'".$value."',";
            }
        }
        
        return $this->cleanDelimiter3($newStr);
    }
    
    /*
     * Replace '-' at the middle of string with ';',
     * Remove char after ':' (Remove rss_id)
     * Return example : '10;9;8'
     */
    public function cleanID2($string) {
        $clean = $this->cleanDelimiter2($string);
        $clean2 = explode('-',$clean);
        if(count($clean2) > 1) {
            $result = NULL;
            foreach($clean2 as $arr) {
                $result .= preg_replace("/(.*?):(.*)/", "$1", $arr).';';
            }
            
            return $this->cleanDelimiter1($result);
        }
        else {
            return preg_replace("/(.*?):(.*)/", "$1", $clean);
        }
    }
    
    /*
     * Replace '_' at the middle of string with ' '
     * Return example : 'SPNU_123' > 'SPNU 123'
     */
    public function cleanID3($string) {
        return preg_replace("/(_)/", " ", $string);
    }
    
    /*
     * Cut ',' character from money type
     * Return example : '2,000,000.00' => '2000000.00'
     */
    public function cleanMoney($string) {
        return preg_replace("/(,)/", "", $string);
    }
    
    /*
     * Get Next Alphabet from range
     */
    public function getNextAlphabet($string) {
        $next = (strtoupper($string) == 'Z' || $string == NULL || $string == '') ? 'A' : chr(ord(strtoupper($string))+1);
        return $next;
    }
    
    public function modifiedNo($no,$postfix) {
        if($no != NULL || $no != '') {
            $exp = explode('/',$no);
            $next_postfix = $this->getNextAlphabet($postfix);
            
            if($postfix != NULL || $postfix != '') {
                //$last_char = strtoupper(substr($exp[0],-1));    
                $return['new_no'] = substr($exp[0], 0, -1).$next_postfix.'/'.$exp[1].'/'.$exp[2].'/'.$exp[3]; // 0001A/BA-MKS/II/14
            }
            else {
                $return['new_no'] = $exp[0].$next_postfix.'/'.$exp[1].'/'.$exp[2].'/'.$exp[3]; // 0001A/BA-MKS/II/14
            }
            $return['new_postfix'] = $next_postfix;
        }
        else {
            $return['new_no'] = $no;
            $return['new_postfix'] = NULL;
        }
        return $return;
    }
    
    public function idr_money($number = NULL,$num_of_dec = '0',$dec_separator=',',$thousand_separator='.',$idr_format = 'Rp') {
        $newNo = ($number == NULL || $number == '0' ? '0' : $number);
        return $idr_format.' '.  number_format($newNo, $num_of_dec, $dec_separator, $thousand_separator);
    }
    
    function terbilang($x)
    {
      $abil = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
      if ($x < 12)
        return " ".$abil[$x];
      elseif ($x < 20)
        return $this->terbilang($x - 10) . " Belas";
      elseif ($x < 100)
        return $this->terbilang($x / 10) . " Puluh" . $this->terbilang($x % 10);
      elseif ($x < 200)
        return " Seratus ".$this->terbilang($x - 100);
      elseif ($x < 1000)
        return $this->terbilang($x / 100) . " Ratus" . $this->terbilang($x % 100);
      elseif ($x < 2000)
        return " Seribu ".$this->terbilang($x - 1000);
      elseif ($x < 1000000)
        return $this->terbilang($x / 1000) . " Ribu" . $this->terbilang($x % 1000);
      elseif ($x < 1000000000)
        return $this->terbilang($x / 1000000) . " Juta" . $this->terbilang($x % 1000000);
    }
    
    /*
     * Cleaning Excel's ridiculous auto-format
     */
    function cleanData(&$str)
    {
      // escape tab characters
      $str = preg_replace("/\t/", "\\t", $str);

      // escape new lines
      $str = preg_replace("/\r?\n/", "\\n", $str);

      // convert 't' and 'f' to boolean values
      if($str == 't') $str = 'TRUE';
      if($str == 'f') $str = 'FALSE';

      // force certain number/date formats to be imported as strings
      if(preg_match("/^0/", $str) || preg_match("/^\+?\d{8,}$/", $str) || preg_match("/^\d{4}.\d{1,2}.\d{1,2}/", $str)) {
        $str = "'$str";
      }

      // escape fields that include double quotes
      if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
      return $str;
    }
    
    /*
     * Replace ' ' (space) at the middle of string with '_'
     * Return example : 'SPNU_10291-1'
     */
    public function cleanSpace($string) {
        $clean = preg_replace("/\s+/", "_", $string);
        return preg_replace("/(-)/", "__", $clean);
    }
    
    /*
     * Replace '_' (space) at the middle of string with ' ', '__' at the middle of string with '-'
     * Return example : 'SPNU_10291__1' => 'SPNU 10291-1'
     */
    public function decodeUrlInsurance($string) {
        $clean2 = preg_replace("/(__)/", "-", $string);
        return preg_replace("/(_)/", " ", $clean2);
    }
    
    /*
     * Remove '.' in the middle of string
     * Return example : 'SPNU. 12345'
     */
    public function cleanDot($string) {
        return preg_replace("/(.)/", "", $string);
    }
    
    function removeValueArray($array, $value)
    {
        return array_values(array_diff($array, array($value)));
    }
	
	function arrayToWhereIn($array) {
		$str = NULL;
		if(!empty($array)) {
			$str = " IN(";
			$unique = array_unique($array);
			foreach($unique as $item) {
				$str .= $item.',';
			}
			$str = $this->cleanDelimiter3($str);
			$str .= ")";
		}
		
		return $str;
	}
	
	function arrayToWhereNotIn($array) {
		$str = NULL;
		if(!empty($array)) {
			$str = " NOT IN(";
			$unique = array_unique($array);
			foreach($unique as $item) {
				$str .= $item.',';
			}
			$str = $this->cleanDelimiter3($str);
			$str .= ")";
		}
		
		return $str;
	}
}