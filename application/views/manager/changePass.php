
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
      <main class="mdl-layout__content MainLog">
         <div class="page-content">
            <section class="changeform allcenter">
          
               <h2>პაროლის შეცვლა</h2>

               <form class="" action="<?php echo base_url('Actions/changePass'); ?>" method="post">
                  <div class="changepassmain">
                   <p style="color:green; font-size:25px;"><?php if(!empty($succ))echo $succ; ?></p>
                  <label>ნიკი</label>
                   <p><input class="changepass" type="text" disabled value="<?php echo $username['username']; ?>"></p>
                   <label>ძველი პაროლი</label>
                   <p><input class="changepass" name="oldpass" type="text" placeholder=""></p>
                   <?php if (isset($err['oldpass'])) echo '<div class="error">'.$err['oldpass'].'</div>'; ?>
                   <label>ახალი პაროლი</label>
                   <p><input class="changepass" type="password" name="newPass" placeholder=""></p>
                   <?php if (isset($err['newPass'])) echo '<div class="error">'.$err['newPass'].'</div>'; ?>

                   <label>გაიმეორეთ პაროლი</label>
                   <p><input class="changepass" type="password" name="comfimPass" placeholder=""></p>
                   <?php if (isset($err['comfimPass'])) echo '<div class="error">'.$err['comfimPass'].'</div>'; ?>
                   <button type="submit">შეცვლა</button>
                      
                  </div>
                </form>
            </section>
         </div>
      </main>
