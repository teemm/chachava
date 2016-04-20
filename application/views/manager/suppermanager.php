<main class="mdl-layout__content MainLog">
         <div class="page-content">
           <section class="supperContainer">
				<div class="supc_right">
          <?php if ( !empty($personal) ): ?>
            <?php foreach ( $personal as $item ): ?>
              <div class="supc_list" data-numb="<?php echo $item['id'];?>">
    						<div class="avatarimg"><a href="<?php echo base_url('office/1/'.$item['id']);?>"><span class="avatar" style="background-image:url(<?php echo base_url('uploads/'.$item['avatar']); ?>)"></span></a></div>
    						<div class="supc_name"><?php echo $item['firstname'].' '.$item['lastname'];?>
                <p style="supc_position;" ><?php echo $item  ['name'];; ?></p></div>
                <div class="calendar_icon"><a href="<?php echo base_url('office/1/'.$item['id']);?>"><span class="calendar_ic" style="background-image:url(<?php echo base_url('assets/images/svg/calendar.svg'); ?>)"></span></a></div>
                <div class="calendar_tex"><a href="<?php echo base_url('office/1/'.$item['id']);?>">&#4313;&#4304;&#4314;&#4308;&#4316;&#4307;&#4304;&#4320;&#4310;&#4308; &#4306;&#4304;&#4307;&#4304;&#4321;&#4309;&#4314;&#4304;</a></div>
    						<div class="supc_number">T <?php echo $item['mobile']; ?></div>
    						<div class="supc_editor">
    							<a href="<?php echo site_url('manager/edit_person/'.$item['id']); ?>">
                    <button class="supc_edit"></button>
                  </a>
                  <button class="supc_delete" data-id="<?php echo $item['id'];?>"></button> 
    						</div>
                <div class="secondLine">
                  <div class="calendar_icon"><a href="<?php echo base_url('office/1/'.$item['id']);?>"><span class="calendar_ic" style="background-image:url(<?php echo base_url('assets/images/svg/calendar.svg'); ?>)"></span></a></div>
                  <div class="supc_number">T <?php echo $item['mobile']; ?></div>
                </div>
    					</div>
            <?php endforeach; ?>
          <?php endif; ?>
				</div>
			</section>
      <div class='wrap'>
  <div class='wrp-content'>
    <div class="material-btn">
      <a href="<?php echo site_url('manager/person'); ?>">&#4318;&#4308;&#4320;&#4321;&#4317;&#4316;&#4304;&#4314;&#4312;&#4321; &#4307;&#4304;&#4315;&#4304;&#4322;&#4308;&#4305;&#4304;</a>
    </div>
    <div class="material-btn">
      <a href="<?php echo site_url('manager/add_donors'); ?>">&#4307;&#4317;&#4316;&#4317;&#4320;&#4308;&#4305;&#4312;&#4321; &#4307;&#4304;&#4315;&#4304;&#4322;&#4308;&#4305;&#4304;</a>
    </div>
     <div class="material-btn">
      <a href="<?php echo site_url('manager/add_surogats'); ?>">&#4321;&#4323;&#4320;&#4317;&#4306;&#4304;&#4322;&#4308;&#4305;&#4312;&#4321; &#4307;&#4304;&#4315;&#4304;&#4322;&#4308;&#4305;&#4304;</a>
    </div>
  </div>
</div>
<a class='button material-icons' href='#'>&#xE145;</a>
<script type="text/javascript">
  $('a.button.material-icons').on('click', function(){
  $('.wrap, a').toggleClass('active');
  return false;
});
</script>
   </div>
</main>