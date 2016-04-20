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
                           <form class="contactForm" action="<?php echo site_url('Actions/edit_branch/'.$item['id']); ?>" method="post">
                              <fieldset class="subTitle">
                                 <p><label class="title">დასახელება</label></p>
                                 <p><input type="text" name="title" value="<?php echo $item['name']; ?>"></p>
                                 <?php if (isset($err['title'])) echo '<div class="error">'.$err['title'].'</div>'; ?>
                                 <p><label class="title">მისამართი</label></p>
                                 <p><input type="text" name="address" value="<?php echo $item['address']; ?>"></p>
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
                                    <!-- potos gamochena -->
                                    <?php 
                                    $emtyimg = $item['image'];
                                    if ($item['image'] == "") $emtyimg = "photo.jpg";?>

                                    <!-- potos gamochena -->
                                    <span><img class="photoGalery" id="output" src="<?php echo base_url('/uploads/'. $emtyimg ); ?>"></span>
                                 </p>
                                 <p><label class="title">ტელეფონის ნომერი</label></p>
                                 <p>
                                    <input class="firstIn" type="text" disabled value="032">
                                    <input class="secondIn" type="text" name="phone" value="<?php echo $item['phone']; ?>">
                                 </p>
                                 <?php if (isset($err['phone'])) echo '<div class="error">'.$err['phone'].'</div>'; ?>
                                 <p><label class="title">მოკლე აღწერა</label></p>
                                 <p><textarea class="title" name="description"><?php echo $item['description']; ?></textarea></p>
                                 <?php if (isset($err['description'])) echo '<div class="error">'.$err['description'].'</div>'; ?>
                                 <button class="submitBut">შესრულება</button>
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
