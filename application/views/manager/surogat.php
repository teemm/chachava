<main class="mdl-layout__content MainLog">
     <div class="page-content">
       <section class="supperContainer">
       		<div class="supc_right">
	            <div class="thumb allbl donor">
	                <a class="thumbnail" href="#">
	                    <img class="img-responsive" src="<?php echo base_url('uploads/'.$surogat_single['surogatAvatar']); ?>" alt="">
	                </a>
                        <div class="imagelists">
                           <?php foreach($surogat_images as $img):if($img['img']==$surogat_single['surogatAvatar'])continue;?>
                           <span><img src="<?php echo base_url('uploads/'.$img['img']);?>" width="200"></span>
                           <?php endforeach;?>
                        </div>
	                <table class="table">
	                 <tr>
	                   <td class="infooN">Person</td>
	                   <td class="infoo nameform"><?php echo $surogat_single['surogatFname']." ".$surogat_single['surogatLname']; ?></td>
	                 </tr>
	                 <tr>
	                   <td class="infooN">Age</td>
	                   <td class="infoo"><?php echo $surogat_single['surogatAge'];?></td>
	                 </tr>
	                 <tr>
		                 <td class="infooN">More info</td>
		                 <td class="infoo"><?php echo $surogat_single['surogatFullViev']; ?></td>	                 	
	                 </tr>
	                 <?php if($this->session->userdata('role')==1): ?>
	                     <tr><td>
                                <button title="&#4332;&#4304;&#4328;&#4314;&#4304;" class="surogat_delete" data-id="<?php echo $this->uri->segment(3); ?>"></button>
                                <a href="<?php echo base_url('manager/edit_surogat').'/'.$this->uri->segment(3); ?>"><button title="&#4320;&#4308;&#4307;&#4304;&#4325;&#4322;&#4312;&#4320;&#4308;&#4305;&#4304;" class="surogat_edit"></button></a>
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