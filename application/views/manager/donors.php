<main class="mdl-layout__content">
  <div class="page-content">
    <div class="container">

        <div class="row">

            <div class="col-lg-12">
                <h1 class="page-header text-center">DONORS LIST</h1>
            </div>
            <?php
              $count=0; 
              foreach ($donors as $donor):
                $count++;
              ($count%5==0)?$clear="clear":$clear="";
            ?>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 thumb allbl">
                <a class="thumbnail" href="<?php echo base_url('donor/'.$donor['id']); ?>">
                    <img class="img-responsive" src="<?php echo base_url('uploads/'.$donor['avatar']); ?>" alt="">
                </a>
                <table class="table">
                 <tr>
                   <td class="infooN">Person</td>
                   <td class="infoo nameform"><?php echo $donor['lname']." ".$donor['fname']; ?></td>
                 </tr>
                 <tr>
                   <td class="infooN">Nationality</td>
                   <td class="infoo"><?php echo $donor['nationality']; ?></td>
                 </tr>
                 <tr>
                   <td class="infooN">Age</td>
                   <td class="infoo"><?php echo $donor['age'] ?></td>
                 </tr>
                 </table>
                 <a href="<?php echo base_url('donor/'.$donor['id']); ?>"><button class="donorsbut">MORE</button></a>
            </div>
          <?php endforeach; ?>
        </div>
  </div>
</main>