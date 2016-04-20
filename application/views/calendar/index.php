<!doctype html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<title>Coloring events</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://storage.googleapis.com/code.getmdl.io/1.0.6/material.indigo-pink.min.css">
	<script src="https://storage.googleapis.com/code.getmdl.io/1.0.6/material.min.js"></script>
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('calendar/codebase/dhtmlxscheduler.css');?>" type="text/css">
	<link rel="stylesheet" href="<?php echo base_url('calendar/assets/css/calendar.css');?>" type="text/css">
	<script src="<?php echo base_url('calendar/assets/js/jquery-2.1.4.min.js');?>" type="text/javascript"></script>
	<script src="<?php echo base_url('calendar/codebase/dhtmlxscheduler.js');?>" type="text/javascript"></script>	
	<script src="<?php echo base_url('calendar/codebase/ext_dhtmlxscheduler_minical.js');?>" type="text/javascript"></script>
	<script src="<?php echo base_url('calendar/assets/js/main.js');?>" type="text/javascript"></script>
	<script src="<?php echo base_url('calendar/codebase/dhtmlxscheduler_tooltip.js');?>" type="text/javascript"></script>
	<!--<script src="<?php echo base_url('calendar/codebase/dhtmlxscheduler_collision.js');?>" type="text/javascript"></script>-->
        <link rel="shortcut icon" type="image/png" href="<?php echo base_url('/assets/images/favicon.png'); ?>">
        <script type="text/javascript">
$( window ).resize(function() {
 dateFixed(200);
});
$(function(){
   $(".arrow-right,.personalList,.arrow-left").on("click",function(){
     dateFixed(0);
  });
});
function dateFixed(time){
    length=$(".dhx_scale_holder .dhx_scale_hour div").length;
    setTimeout(function(){
       for(var i=0;i<length;i++){
         s1=$(".dhx_scale_hour").eq(i).find("div").eq(0).html();
         s2=$(".dhx_scale_hour").eq(i).find("div").eq(1).html();
         $(".dhx_scale_hour").eq(i).find("div").eq(0).html(s1.split(" ")[1]);
         $(".dhx_scale_hour").eq(i).find("div").eq(1).html(s2.split(" ")[1]);
      }
    },time); 
}
        </script>
</head>
<?php
	($this->uri->segment(3))?$segment3=",".$this->uri->segment(3):$segment3="";
?>
<body onload="init(<?php echo $this->uri->segment(2);?><?php echo $segment3;?>)" >
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
                   <a class="mdl-navigation__link" href="">რეგისტრაცია</a>
                   <a class="mdl-navigation__link" href="">შესვლა</a>
                 <?php else: ?>
                 	<a class="mdl-navigation__link" href="<?php echo site_url('manager/changePass'); ?>">პაროლის შეცვლა</a>
                   <a class="mdl-navigation__link" href="<?php echo site_url('manager/logout'); ?>">გამოსვლა</a>
                 <?php endif; ?>
               </nav>
            </div>
         </header>
          <?php if ( $this->session->userdata('role')==1): ?>
         <div class="mdl-layout__drawer">
            <span class="mdl-layout-title"><?php echo $finduser['firstname'].' '.$finduser['lastname'].' - '. $finduser['spec'];?></span>
            <nav class="mdl-navigation">
                <a class="mdl-navigation__link" href="<?php echo base_url(); ?>">მთავარი</a>
               	<?php if($this->session->userdata('role')==1): ?>
               		<a class="mdl-navigation__link" href="<?php echo base_url('manager/donors/'); ?>">დონორები</a>
               		<a class="mdl-navigation__link" href="<?php echo base_url('manager/add_donors/'); ?>">დონორების დამატება</a>
               	<?php endif; ?>
                <a class="mdl-navigation__link" href="<?php echo base_url('manager/person/'); ?>">პერსონალის დამატება</a>	
            </nav>
         </div>
     	<?php endif;?>
    </div>
	<div class="personalPage" style='width:20%;'>
		<ul class="personalLists">
			<?php foreach ($personals as $personal):?>
			<div class="personalList <?php if($this->uri->segment(3)==$personal['personalId'])echo 'activePersonal'; ?>" data-id="<?php echo $personal['personalId'];?>">
				<li class="ListBlcok">
					<p class="personalImage"><span style="background:url(<?php echo base_url('uploads/').'/'.$personal['avatar'];?>) center / cover no-repeat"></span></p>
					<p class="personalName">
						<span class="persname"><?php echo $personal['firstname'].' '.$personal['lastname'];?></span>
						<span class="spec"><?php echo $personal['spec']; ?></span>
					</p>
				</li>				
			</div>
			<?php endforeach; ?>																																																												
		</ul>
	</div>
	<div id="scheduler_here" class="dhx_cal_container calendarPage" style='width:55%; height:100%;'>
		<div class="dhx_cal_navline">
			<div class="headerDate">
				<div class="arrows"><div class="dhx_cal_prev_button arrow-left">&nbsp;</div></div>
				<div class="dhx_cal_date"></div>
				<div class="arrows"><div class="dhx_cal_next_button arrow-right">&nbsp;</div></div>
			</div>
		</div>
		<div class="dhx_cal_header"></div>
		<div class="dhx_cal_data" data-id="<?php echo $userRole;?>"></div>		
	</div>
	<div class="list-personals-res">
		<button><i class="material-icons peopleLogo">people</i></button>
	</div>
	<div class="peopleLists">
		<ul class="personalLists">
			<?php foreach ($personals as $personal):?>
			<div class="personalList <?php if($this->uri->segment(3)==$personal['personalId'])echo 'activePersonal'; ?>" data-id="<?php echo $personal['personalId'];?>">
				<li class="ListBlcok">
					<p class="personalImage"><span class="imgback" style="background:url(<?php echo base_url('uploads/').'/'.$personal['avatar'];?>) center / cover no-repeat"></span></p>
					<p class="personalName">
						<span class="persname"><?php echo $personal['firstname'].' '.$personal['lastname'];?></span>
						<span class="spec"><?php echo $personal['spec']; ?></span>
					</p>
				</li>				
			</div>
			<?php endforeach; ?>																																																												
		</ul>
		<div class="siblingburger"></div>	
    </div>
</body>
</html>