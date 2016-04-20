<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
   <head>
      <title></title>
      <meta charset="utf-8"/>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
      <link rel="stylesheet" href="<?php echo base_url('/assets/css/calendar.css'); ?>">
      <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/dhtmlxscheduler.css" type="text/css">
      <script src="<?php echo base_url(); ?>assets/js/dhtmlxscheduler.js" type="text/javascript"></script>
      <script src="<?php echo base_url(); ?>assets/js/ext_dhtmlxscheduler_minical.js" type="text/javascript"></script>
      <script src="<?php echo base_url(); ?>assets/js/main.js" type="text/javascript"></script>        
   </head>
   <body onload="init();">