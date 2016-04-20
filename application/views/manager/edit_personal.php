<main class="mdl-layout__content">
          <div class="page-content">
             <section class="header-sec">
                <!-- start main container -->
                <section class="container">
                   <!-- start head banner -->
                   <section class="banner">
                      <div class="logoPerson">
                         <h1 class="person">პერსონალი</h1>
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
                         <form class="contactForm" action="<?php echo base_url('/Actions/update_person/'.$item['id']); ?>" method="POST" enctype="multipart/form-data">
                            <fieldset class="subTitle">
                               <p><label class="title">სახელი</label></p>
                               <p><input type="text" name="personFname" value="<?php echo $item['firstname'];?>"/></p>
                               <?php if (isset($err['personFname'])) echo '<div class="error">'.$err['personFname'].'</div>'; ?>
                               <p><label class="title">გვარი</label></p>
                               <p><input type="text" name="personLname" value="<?php echo $item['lastname'];?>"/></p>
                               <?php if (isset($err['personLname'])) echo '<div class="error">'.$err['personLname'].'</div>'; ?>
                               <p><label class="title">ნიკნეიმი</label></p>
                               <p><input type="text" name="personUsername" value="<?php echo $item['username'];?>" disabled/></p>
                               <?php if (isset($err['personUsername'])) echo '<div class="error">'.$err['personUsername'].'</div>'; ?>
                               <p><label class="title">პაროლი</label></p>
                               <p><input type="password" name="personPassword"></p>
                               <?php if (isset($err['personPassword'])) echo '<div class="error">'.$err['personPassword'].'</div>'; ?>
                               <p><label class="title">ტელეფონის ნომერი</label></p>
                               <p>
                                  <input class="firstIn" type="text" value="+995" disabled>
                                  <input class="secondIn" type="text"  name="personPhoneNumber" value="<?php echo $item['mobile'];?>"/>
                                  <?php if (isset($err['personPhoneNumber'])) echo '<div class="error">'.$err['personPhoneNumber'].'</div>'; ?>
                               </p>
                               <p><label class="title">სპეციალიზაცია</label></p>
                               <p><input type="text" name="personSpec" value="<?php echo $item['spec'];?>"/></p>
                               <?php if (isset($err['personSpec'])) echo '<div class="error">'.$err['personSpec'].'</div>'; ?>
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
                                  <span><img class="photoGalery" id="output" src="<?php echo base_url('/uploads/'.$item['avatar']); ?>"></span>
                               </p>
                               <p><label class="title">პოზიცია:</label></p>
                               <p>
                                  <select class="title"  name="category">
                                     <option class="title" value="2" <?php echo $item['role']==2?'selected':''; ?>>მენეჯერი</option>
                                     <option class="title" value="3" <?php echo $item['role']==3?'selected':''; ?>>ექიმი</option>
                                  </select>
                               </p>
                               <?php if (isset($err['personTitle'])) echo '<div class="error">'.$err['personTitle'].'</div>'; ?>
                               <button class="submitBut">შეცვლა</button>
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
