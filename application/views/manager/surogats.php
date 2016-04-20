<main class="mdl-layout__content">
  <div class="page-content">
    <div class="container">

        <div class="row">

            <div class="col-lg-12">
                <h1 class="page-header text-center">SUROGATS LIST</h1>
            </div>
            <?php
              $count=0; 
              foreach ($surogats as $surogat):
                $count++;
              ($count%5==0)?$clear="clear":$clear="";
            ?>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 thumb allbl">
                <a class="thumbnail" href="<?php echo base_url('manager/surogat/'.$surogat['id']); ?>">
                    <img class="img-responsive" src="<?php echo base_url('uploads/'.$surogat['surogatAvatar']); ?>" alt="">
                </a>
                <table class="table">
                 <tr>
                   <td class="infooN">Person</td>
                   <td class="infoo nameform"><?php echo $surogat['surogatLname']." ".$surogat['surogatFname']; ?></td>
                 </tr>
                 <tr>
                   <td class="infooN">Age</td>
                   <td class="infoo"><?php echo $surogat['surogatAge'] ?></td>
                 </tr>
                 </table>
                 <a href="<?php echo base_url('manager/surogat/'.$surogat['id']); ?>"><button class="donorsbut">MORE</button></a>
            </div>
          <?php endforeach; ?>
        </div>
  </div>
</main>