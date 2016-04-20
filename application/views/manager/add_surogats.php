

         <main class="mdl-layout__content">
            <div class="page-content">
               <section class="header-sec">
                  <!-- start main container -->
                  <section class="container">
                     <!-- start head banner -->
                     <section class="banner">
                        <div class="logoServise">
                           <h1 class="servise">სუროგატის დამატება</h1>
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
                           <form class="contactform2" enctype="multipart/form-data" action="<?php echo base_url('Actions/add_surogats'); ?>" method="POST">
                              <fieldset class="subTitle">
                                 <p><label class="title" >სახელი</label></p>
                                 <p><input type="text" name="surogatFname"></p>
                                 <p><label class="title">გვარი</label></p>
                                 <p><input type="text" name="surogatLname"></p>
                                 <p><label class="title">ასაკი</label></p>
                                 <p><input type="text" name="surogatAge"></p>                                                                                                           
                                 <p><label class="title">დამატებითი ინფორმაცია</label></p>
                                 <p><textarea name="surogatFullViev"></textarea></p>
                                <p><label class="title">ფოტოები:</label>                        
                              </fieldset>
            <div id="filediv"><input name="file[]" type="file" id="file" multiple/></div><br/>
            <div class="imglists"></div>
            <input type="hidden" name="delfile" class="delfiles"/>
            <input type="button" id="add_more" class="uploadimg"  value="Add More Files" />
                               <input type="submit" class="submitBut" value="დამატება">
                           </form>
                        </div>
                     </section>
                     <!-- end main form -->
                  </section>
               </section>
               <!-- end main container -->
            </div>
      </div>
      </main>