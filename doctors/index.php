<?php

define('TITLE', "Home");
include '../assets/layouts/header.php';
check_verified();
include 'includes/functions.php';

?>


<main role="main" class="container">

    <div class="row">
        <?php if(empty($doctors)){ ?>
          <div class="col-md-12 btn-primary p-3 text-center">Doctors list is empty</div>
       <?php } else { 
        foreach($doctors as $doctor){
        ?>
        <div class="col-sm-3">
            <?php echo $doctor->doc_name; ?>
       </div>
       <?php } 
    } ?>
    </div>
</main>




    <?php

    include '../assets/layouts/footer.php'

    ?>