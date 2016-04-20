<main class="mdl-layout__content">
            <div class="page-content">
               <section class="header-sec">
                  <!-- start main container -->
                  <section class="container">
                     <!-- start head banner -->
                     <section class="banner">
                        <div class="logo">
                           <h1>ფილიალი</h1>
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
                           <form class="contactForm" action="<?php echo site_url('Actions/add_branch'); ?>" method="post">
                              <fieldset class="subTitle">
                                 <p><label class="title">დასახელება</label></p>
                                 <p><input type="text" name="title"></p>
                                 <?php if (isset($err['title'])) echo '<div class="error">'.$err['title'].'</div>'; ?>
                                 <p><label class="title">მისამართი</label></p>
                                 <p><input type="text" name="address"></p>
                                 <?php if (isset($err['address'])) echo '<div class="error">'.$err['address'].'</div>'; ?>
                                 <p><label class="title">ფოტოები:</label>
                                   <ul id="filelist"></ul>
                                   <input type="hidden" name="filename" value="">
                                    <br>
                                    <div id="container">
                                      <span class="file-upload-wrp">
                                        <button type="file" id="browse" href="javascript:;">აირჩიეთ ფაილი
                                        </button>
                                      </span>

                                    </div>
                                    <br />
                                    <pre id="console"></pre>
                                 </p>
                                 <p>
                                    <span><img class="photoGalery" id="output" src="<?php echo base_url('/assets/images/photo.jpg"'); ?>"></span>
                                 </p>
                                 <p><label class="title">ტელეფონის ნომერი</label></p>
                                 <p>
                                    <input class="firstIn" type="text" value="032" disabled>
                                    <input class="secondIn" type="text" name="phone" value="2">
                                 </p>
                                 <?php if (isset($err['phone'])) echo '<div class="error">'.$err['phone'].'</div>'; ?>
                                 <p><label class="title">მოკლე აღწერა</label></p>
                                 <p><textarea class="title" name="description"></textarea></p>
                                 <?php if (isset($err['description'])) echo '<div class="error">'.$err['description'].'</div>'; ?>
                                <!--  <p><label class="title">ტეგი</label></p>
                                 <p><input  class="inputWith" type="text"></p> -->
                                 <button class="submitBut">დამატება</button>
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
