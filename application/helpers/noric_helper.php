<?php

function isLogin() {
  $CI =& get_instance();
  $sess_check = $CI->session->userdata('logged_in')==TRUE;
  if (!empty($sess_check)) {
    return true;
  }
  return false;
}

function isLoggedIn() {
  $CI =& get_instance();
  if (!isLogin()) {
    $CI->session->set_flashdata('notification', "Anda harus login terlebih dahulu!");
    redirect('');
    die;
  }
}

function isAdm() {
  $CI =& get_instance();
  $sess_check = $CI->session->userdata('permission')=="ADM";
  if (!empty($sess_check)) {
    return true;
  }
}

function isViewer() {
  $CI =& get_instance();
  $sess_check = $CI->session->userdata('permission')=="VIEWER";
  if (!empty($sess_check)) {
    return true;
  }
}

function isAdminTasik() {
  $CI =& get_instance();
  $sess_check = $CI->session->userdata('permission')=="ADMIN TASIK";
  if (!empty($sess_check)) {
    return true;
  }
}

function isAdminJakarta() {
  $CI =& get_instance();
  $sess_check = $CI->session->userdata('permission')=="ADMIN JAKARTA";
  if (!empty($sess_check)) {
    return true;
  }
}

function isApproval() {
  $CI =& get_instance();
  $sess_check = $CI->session->userdata('permission')=="APPROVAL";
  if (!empty($sess_check)) {
    return true;
  }
}

function isAdministrator() {
  $CI =& get_instance();
  $sess_check = $CI->session->userdata('permission')=="ADMINISTRATOR";
  if (!empty($sess_check)) {
    return true;
  }
}

function navbar() {
  $CI =& get_instance();
  if (isLogin()) {
    return $CI->load->view('front/templates/navbar', TRUE);
  }
}

function isNotification() {
  $CI =& get_instance();
  if (!empty($CI->session->flashdata('notification'))) {
    return true;
  }
}

function notificationMessage() {
  $CI =& get_instance();
  if (isNotification()) {
    return $CI->session->flashdata('notification');
  }
}
