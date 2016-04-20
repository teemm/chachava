<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
   <head>
      <title>Chachava Booking Platform</title>
      <meta charset="utf-8"/>
      <meta name="viewport" content="width=device-width, initial-scale=1">
       <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
      <link rel="stylesheet" href="https://storage.googleapis.com/code.getmdl.io/1.0.6/material.indigo-pink.min.css">
      <script src="https://storage.googleapis.com/code.getmdl.io/1.0.6/material.min.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
      <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
      <link rel="stylesheet" href="<?php echo base_url('/assets/css/style.css'); ?>">
      <link rel="shortcut icon" type="image/png" href="<?php echo base_url('/assets/images/favicon.png'); ?>">
   </head>
   <body>
      <!-- Always shows a header, even in smaller screens. -->
      <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
         <header class="mdl-layout__header">
            <div class="mdl-layout__header-row">
               <!-- Title -->
               <span class="mdl-layout-title"><?php echo $finduser['firstname'].' '.$finduser['lastname'].' - '. $finduser['spec'];?></span>
               <!-- Add spacer, to align navigation to the right -->
               <div class="mdl-layout-spacer"></div>
               <!-- Navigation. We hide it in small screens. -->
               <nav class="mdl-navigation mdl-layout--large-screen-only">
                 <?php if ( !$this->session->userdata('id') ): ?>
                   <a class="mdl-navigation__link" href="">&#4320;&#4308;&#4306;&#4312;&#4321;&#4322;&#4320;&#4304;&#4330;&#4312;&#4304;</a>
                   <a class="mdl-navigation__link" href="">&#4328;&#4308;&#4321;&#4309;&#4314;&#4304;</a>
                 <?php else: ?>
                  <?php if($this->session->userdata('role')!=4 && ($this->session->userdata('role')!=5)):?><a class="mdl-navigation__link" href="<?php echo site_url('manager/changePass'); ?>">&#4318;&#4304;&#4320;&#4317;&#4314;&#4312;&#4321; &#4328;&#4308;&#4330;&#4309;&#4314;&#4304;</a><?php endif; ?>
                  <a class="mdl-navigation__link" href="<?php echo site_url('manager/logout'); ?>">&#4306;&#4304;&#4315;&#4317;&#4321;&#4309;&#4314;&#4304;</a>
                 <?php endif; ?>
               </nav>
            </div>
         </header>
         <div class="mdl-layout__drawer">
            <span class="mdl-layout-title"><?php echo $finduser['firstname'].' '.$finduser['lastname'].' - '. $finduser['spec'];?></span>
            <nav class="mdl-navigation">
                <a class="mdl-navigation__link" href="<?php echo base_url(); ?>">&#4315;&#4311;&#4304;&#4309;&#4304;&#4320;&#4312;</a>
                <?php if($this->session->userdata('role')==1):?>
                <a class="mdl-navigation__link" href="<?php echo base_url('office/1/') ?>">&#4313;&#4304;&#4314;&#4308;&#4316;&#4307;&#4304;&#4320;&#4312;</a>
                <a class="mdl-navigation__link" href="<?php echo base_url('manager/change_donor_pas/'); ?>">დონორის პაროლის შეცვლა</a>
                 <a class="mdl-navigation__link" href="<?php echo base_url('manager/change_surogat_pas/'); ?>">სუროგატის პაროლის შეცვლა</a>
                  <a class="mdl-navigation__link" href="<?php echo base_url('manager/donors/'); ?>">&#4307;&#4317;&#4316;&#4317;&#4320;&#4308;&#4305;&#4312;</a>
                <a class="mdl-navigation__link" href="<?php echo base_url('manager/surogats/'); ?>">&#4321;&#4323;&#4320;&#4317;&#4306;&#4304;&#4322;&#4308;&#4305;&#4312;</a>
                <?php if($this->session->userdata('role')==1): ?><a class="mdl-navigation__link" href="<?php echo base_url('manager/add_donors/'); ?>">&#4307;&#4317;&#4316;&#4317;&#4320;&#4308;&#4305;&#4312;&#4321; &#4307;&#4304;&#4315;&#4304;&#4322;&#4308;&#4305;&#4304;</a><?php endif; ?>
                <?php if($this->session->userdata('role')==1): ?><a class="mdl-navigation__link" href="<?php echo base_url('manager/add_surogats/'); ?>">&#4321;&#4323;&#4320;&#4317;&#4306;&#4304;&#4322;&#4308;&#4305;&#4312;&#4321; &#4307;&#4304;&#4315;&#4304;&#4322;&#4308;&#4305;&#4304;</a><?php endif; ?>
                <a class="mdl-navigation__link" href="<?php echo base_url('manager/person/'); ?>">&#4318;&#4308;&#4320;&#4321;&#4317;&#4316;&#4304;&#4314;&#4312;&#4321; &#4307;&#4304;&#4315;&#4304;&#4322;&#4308;&#4305;&#4304;</a>
                <?php endif; ?>
            </nav>
         </div>