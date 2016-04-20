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
                           <form class="contactForm" action="<?php echo base_url('/Actions/add_person'); ?>" method="POST" enctype="multipart/form-data">
                              <fieldset class="subTitle">
                                 <p><label class="title">სახელი</label></p>
                                 <p><input type="text" name="personFname"></p>
                                 <?php if (isset($err['personFname'])) echo '<div class="error">'.$err['personFname'].'</div>'; ?>
                                 <p><label class="title">გვარი</label></p>
                                 <p><input type="text" name="personLname"></p>
                                 <?php if (isset($err['personLname'])) echo '<div class="error">'.$err['personLname'].'</div>'; ?>
                                 <p><label class="title">ნიკნეიმი</label></p>
                                 <p><input type="text" name="personUsername"></p>
                                 <?php if (isset($err['personUsername'])) echo '<div class="error">'.$err['personUsername'].'</div>'; ?>
                                 <p><label class="title">პაროლი</label></p>
                                 <p><input type="password" name="personPassword"></p>
                                 <?php if (isset($err['personPassword'])) echo '<div class="error">'.$err['personPassword'].'</div>'; ?>
                                 <p><label class="title">ტელეფონის ნომერი</label></p>
                                 <p>
                                    <input class="firstIn" type="text" value="+995" disabled>
                                    <input class="secondIn" type="text"  name="personPhoneNumber">
                                    <?php if (isset($err['personPhoneNumber'])) echo '<div class="error">'.$err['personPhoneNumber'].'</div>'; ?>
                                 </p>
                                 <p><label class="title">სპეციალიზაცია</label></p>
                                 <p><input type="text" name="personSpec"></p>
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
                                    <span><img class="photoGalery" id="output" src="<?php echo base_url('/assets/images/photo.jpg"'); ?>"></span>
                                 </p>
                                 <p><label class="title">პოზიცია:</label></p>
                                 <p>
                                    <select class="title"  name="category">
                                       <option class="title" selected disabled>-- აირჩიეთ --</option>
                                       <option class="title" value="2">მენეჯერი</option>
                                       <option class="title" value="3">ექიმი</option>
                                    </select>
                                 </p>                                 
                                 <!-- სკრიპტი გივნდა იმ შემთხვევაშ თუ გამოვყენებთ ფილიალებზე მიბმას სელექტის გარეშე -->
                                 <!-- <p><label class="title">მიბმა ფილიალზე</label></p>

                                 <p><input type="text personTitle" id="sw_search" name="personTitle" autocomplete="off" required>
                                   <div class="hidenbar">
                                      <ul class="hiddenul"></ul></input>
                                 </div></p> -->
                                  <!-- სკრიპტი გივნდა იმ შემთხვევაშ თუ გამოვყენებთ ფილიალებზე მიბმას სელექტის გარეშე -->
                                 <?php if (isset($err['personTitle'])) echo '<div class="error">'.$err['personTitle'].'</div>'; ?>
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
        <script>
// სკრიპტი გივნდა იმ შემთხვევაშ თუ გამოვყენებთ ფილიალებზე მიბმას სელექტის გარეშე
//   $(function(){
//     $('#sw_search').on('keyup', function(){
//       _html = "";
//       $.post('<?php echo site_url("Manager/get_branches"); ?>',{ arg : $(this).val() }, function(resp){
//         for (var i = 0; i < resp.length; i++) {
//           _html += '<li>' + resp[i].name + '</li>'
//         }
//         $('.hidenbar').show();
//         $('.hiddenul').html(_html);
//       },'json');
//     });
//   });
// სკრიპტი გივნდა იმ შემთხვევაშ თუ გამოვყენებთ ფილიალებზე მიბმას სელექტის გარეშე

// </script>
