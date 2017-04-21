<?php

class util{

	function httpPost($url,$data){
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		$ret=curl_exec($ch);
		curl_close($ch);

		return $ret;
	}

	/**
	 * 校验$value是否非空
	 *  if not set ,return true;
	 *	if is null , return true;
	 **/
	function checkEmpty($value) {
		if(!isset($value))
			return true ;
		if($value === null )
			return true;
		if(trim($value) === "")
			return true;
		
		return false;
	}

	function getSign($arr,$key){
	    $mysignData=$this->getSignContent($arr);
	    $sign=md5($mysignData.'&key='.$key);
	    return $sign;
	}

	function checkSign($post,$key){
	    $sign=$post['sign'];
	    $mysignData=$this->getSignContent($post);
	    $mysign=md5($mysignData.'&key='.$key);

	    if($sign!=$mysign){
	    	return false;
	    }else{
	    	return true;
	    }
	}

	function getSignContent($params){
		ksort($params);

		$stringToBeSigned = "";
		$i = 0;
		foreach ($params as $k => $v) {
			if($k=='sign'){
				continue;
			}
			if (false === $this->checkEmpty($v) && "@" != substr($v, 0, 1)) {
				if ($i == 0) {
					$stringToBeSigned .= "$k" . "=" . "$v";
				} else {
					$stringToBeSigned .= "&" . "$k" . "=" . "$v";
				}
				$i++;
			}
		}
		unset ($k, $v);
		return $stringToBeSigned;
	}

	 /**
	 * 将 HTML 特定的字符转换为 HTML 字面字符
	 * @param HTML 特定的字符
	 * @param length 长度
	 */
	function transform_HTML($string, $length = 0) {
	// Helps prevent XSS attacks
	    // Remove dead space.
	    $string = trim($string);
	    // Prevent potential Unicode codec problems.
	    //$string = utf8_decode($string);
	    // HTMLize HTML-specific characters.
	    $string = htmlentities($string, ENT_NOQUOTES);
	    $string = str_replace("#", "#", $string);
	    $string = str_replace("%", "%", $string);
	    $string = $this->dowith_sql($string);
	    
	    $length = intval($length);
	    if ($length > 0) {
	        $string = substr($string, 0, $length);
	    }
	    return $string;
	}

	//防SQL注入
	function dowith_sql($str)
	{
	   $str = str_replace("and","",$str);
	   $str = str_replace("execute","",$str);
	   $str = str_replace("update","",$str);
	   $str = str_replace("count","",$str);
	   $str = str_replace("chr","",$str);
	   $str = str_replace("mid","",$str);
	   $str = str_replace("master","",$str);
	   $str = str_replace("truncate","",$str);
	   $str = str_replace("char","",$str);
	   $str = str_replace("declare","",$str);
	   $str = str_replace("select","",$str);
	   $str = str_replace("create","",$str);
	   $str = str_replace("delete","",$str);
	   $str = str_replace("insert","",$str);
	   $str = str_replace("*","",$str);
	   $str = str_replace("'","",$str);
	   $str = str_replace('"',"",$str);
	   $str = str_replace(" ","",$str);
	   $str = str_replace(";","",$str);
	   $str = str_replace("or","",$str);
	   $str = str_replace("=","",$str);
	   $str = str_replace("%20","",$str);
	   //echo $str;
	   return $str;
	}
}