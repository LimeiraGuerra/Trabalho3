<?php 
	class Utils{
		static function createHash($var){
			$var = "ifsp".$var."pw2";
			for($i = 0; $i < 5; $i++){
				$var = md5($var);
			}
			return $var;
		}

		static function debug($param){
            echo "<pre>";
            print_r($param);
            echo "</pre>";
        }
	}
 ?>