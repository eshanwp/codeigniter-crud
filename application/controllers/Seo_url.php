<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Seo_url extends CI_Controller {

	
  function index() {

    $seo_url = $this->input->post('url_str');
    $replace_txt = '-';
    if($seo_url !== mb_convert_encoding( mb_convert_encoding($seo_url, 'UTF-32', 'UTF-8'), 'UTF-8', 'UTF-32') )
    $seo_url = mb_convert_encoding($seo_url, 'UTF-8', mb_detect_encoding($seo_url));
    $seo_url = htmlentities($seo_url, ENT_NOQUOTES, 'UTF-8');
    $seo_url = preg_replace('`&([a-z]{1,2})(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig);`i', '\1', $seo_url);
    $seo_url = html_entity_decode($seo_url, ENT_NOQUOTES, 'UTF-8');
    $seo_url = preg_replace(array('`[^a-z0-9]`i','`[-]+`'), '-', $seo_url);
    $seo_url = strtolower( trim($seo_url, '-') );
    $seo_url =str_replace("-",$replace_txt,$seo_url);
    echo $seo_url;
    
  }


  

}
