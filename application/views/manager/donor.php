<main class="mdl-layout__content MainLog">
     <div class="page-content">
       <section class="supperContainer">
       		<div class="supc_right">
	            <div class="thumb allbl donor">
	                <a class="thumbnail" href="#">
	                    <img class="img-responsive" src="<?php echo base_url('uploads/'.$donor_single['avatar']); ?>" alt="">
	                </a>
                        <div class="imagelists">
                           <?php foreach($donor_images as $img):if($img['img_name']==$donor_single['avatar'])continue;?>
                           <span><img src="<?php echo base_url('uploads/'.$img['img_name']);?>" width="200"></span>
                           <?php endforeach;?>
                        </div>
	                <table class="table">
	                 <tr>
	                   <td class="infooN">Person</td>
	                   <td class="infoo nameform"><?php echo $donor_single['fname']." ".$donor_single['lname']; ?></td>
	                 </tr>
	                 <tr>
	                   <td class="infooN">Age</td>
	                   <td class="infoo"><?php echo $donor_single['age'];?></td>
	                 </tr>
	                 <tr>
		                 <td class="infooN">More info</td>
		                 <td class="infoo"><?php echo $donor_single['full_view']; ?></td>	                 	
	                 </tr>
	                 <?php if($this->session->userdata('role')==1): ?>
	                	 <tr><td>
                                      <button title="&#4332;&#4304;&#4328;&#4314;&#4304;" class="donor_delete" data-id="<?php echo $this->uri->segment(2); ?>"></button>
                                      <a href="<?php echo base_url('manager/edit_donor').'/'.$this->uri->segment(2); ?>"><button title="&#4320;&#4308;&#4307;&#4304;&#4325;&#4322;&#4312;&#4320;&#4308;&#4305;&#4304;" class="donor_edit"></button></a>
                                      <?php if($donor_single['hide']==0): ?>
                                      	<a href="<?php echo base_url('Manager/hidedonor/'.$donor_single['id']) ?>">hide</a>
                                  	  <?php else:?>
										<a href="<?php echo base_url('Manager/showdonor/'.$donor_single['id']) ?>">show</a>
                                  	  <?php endif;?>
                                </td><td></td></tr>                
	             	 <?php endif; ?>	                 
	                 </table>	
	            </div>       			
       		</div>
       		<?php if($this->session->userdata('role')==1): ?>
	       		<div class="wrap">
				  <div class="wrp-content">
				    <div class="material-btn">
				      <a class="active" href="<?php echo base_url('manager/person');?>">პერსონალის დამატება</a>
				    </div>
				    <div class="material-btn">
				      <a class="active" href="<?php echo base_url('manager/add_donors');?>">დონორების დამატება</a>
				    </div>
				     <div class="material-btn">
				      <a class="active" href="<?php echo base_url('manager/add_surogats');?>">სუროგატების დამატება</a>
				    </div>
				  </div>
				</div>
				<a class="button material-icons" href="#"></a>
				<script type="text/javascript">
					$('a.button.material-icons').on('click', function(){
						$('.wrap, a').toggleClass('active');
						return false;
					});
				</script>
			<?php endif; ?>
       </section>
    </div>
 </main>