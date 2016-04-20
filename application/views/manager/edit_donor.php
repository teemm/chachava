<main class="mdl-layout__content">
          <div class="page-content">
             <section class="header-sec">
                <!-- start main container -->
                <section class="container">
                   <!-- start head banner -->
                   <section class="banner">
                      <div class="logoPerson">
                         <h1 class="person">&#4307;&#4317;&#4316;&#4317;&#4320;&#4312;</h1>
                      </div>
                   </section>
                   <!-- end head banner -->
                   <!-- start main form -->
                   <section class="content">
                      <div class="formContainer">
                        <?php
                        $err = array();
                        if ( !empty($this->session->flashdata('sucsessMessage')) ):
                          echo $_SESSION['sucsessMessage'];
                        endif;
                        if ( !empty($this->session->flashdata('err_message')) ):
                          if ( is_array($_SESSION['err_message']) ){
                            $err = $_SESSION['err_message'];
                          }else{
                            echo $_SESSION['err_message'];
                          }
                        endif; ?>
                         <form class="contactForm" action="<?php echo base_url('/Actions/update_donor/'.$item['id']); ?>" method="POST" enctype="multipart/form-data">
                            <fieldset class="subTitle">
                               <p><label class="title">სახელი</label></p>
                               <p><input type="text" name="personFname" value="<?php echo $item['fname'];?>"/></p>
                               <p><label class="title">&#4306;&#4309;&#4304;&#4320;&#4312;</label></p>
                               <p><input type="text" name="personLname" value="<?php echo $item['lname'];?>"/></p>
                               <p><label class="title">&#4304;&#4321;&#4304;&#4313;&#4312;</label></p>
                               <p><input type="text" name="personage" value="<?php echo $item['age'];?>"/></p>
<p><label class="title">ეროვნება</label></p>
                                 <p><input type="text" name="nationality"></p> 
                               <p><label class="title">&#4315;&#4308;&#4322;&#4312; &#4312;&#4316;&#4324;&#4317;&#4320;&#4315;&#4304;&#4330;&#4312;&#4304;</label></p>
                               <p><textarea name="full_view"><?php echo $item['full_view'];?></textarea></p>
<p><label class="title">ფოტოს ატვირთვა:</label>
                                 <ul id="filelist"></ul>
                                 <input type="hidden" name="filename" value="">
                                  <br>
                                  <div id="container">
                                    <span class="file-upload-wrp">
                                      <button type="file" id="browse" href="javascript:;">
                                      </button>
                                    </span>

                                  </div>
                                  <br />
                                  <pre id="console"></pre>
                               </p>
                               <p>
                                  <span><img class="photoGalery" id="output" src="<?php echo base_url('/uploads/'.$item['avatar']); ?>"></span>
                               </p>
                               <button class="submitBut" type="submit">დამატება</button>
                            </fieldset>
                         </form>                            
                      </div>
                   </section>
                   <!-- start main form -->
                </section>
             </section>
             <!-- end main container -->
          </div>
       </div>
    </main>
