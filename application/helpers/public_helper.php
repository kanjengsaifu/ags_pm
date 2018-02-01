<?php

if (!defined('BASEPATH')) exit ('No permission');

if (!function_exist('public')) {
  function public() {
    $CI =& get_instance();
    return base_url() . $CI->config->item('public_path')
  }
}





// Path
if (!function_exist('public_path')) {
  function public_path() {
    $CI =& get_instance();
    return FCPATH . $CI->config->item('public_path')
  }
}
