

      <main class="mdl-layout__content MainLog">
         <div class="page-content">
            <section class="MainLogin allcenter">
               <div class="fromCont allcenter"></div>
               <form class="" action="<?php echo site_url('Actions/login'); ?>" method="post">
                  <div class="mainFrom">
                      <p><span class="iconFirst"></span><input class="firstlogin textEclipse" name="username" type="text" placeholder="ნიკი"></p>
                      <p><span class="iconSeccond"></span><input class="secIn textEclipse" name="password" type="password" placeholder="პაროლი"></p>
                       <?php
                        if ( !empty($this->session->flashdata('err_message')) ):
                          echo '<p><div class="validate-tooltip">'.$_SESSION['err_message'].'</div></p>';
                        endif;
                       ?>
                      <button type="submit" class="LoginButton">შესვლა</button>
                     <!-- <p class="align"><a href="#"> დაგავიწყდათ პაროლი?</a></p> -->
                  </div>
                </form>
            </section>
         </div>
      </main>
