<?php

define('TITLE', "Profile");
include '../assets/layouts/header.php';
check_verified();

?>
<main role="main" class="container">
<div class="row py-5 px-4 ">
    <div class="col-xl-12 col-md-12 col-sm-12 mx-auto ">

        <!-- Profile widget -->
        <div class="bg-white shadow rounded overflow-hidden">
            <div class="px-4 pt-5 pb-5 bg-dark profile-cover">
                <div class="media align-items-end profile-header">
                    <div class="profile mr-3">
                    <?php if ($user->profile_pic){ echo "<img src='../assets/uploads/users/".$user->profile_pic."'>"; }?>
        <?php if (empty($user->profile_pic)){ 
                            echo substr($_SESSION['username'], 0, 1); 
                            } ?>
                        <a href="../profile-edit" class="btn btn-dark btn-sm btn-block">Edit profile</a>
                    </div>
                    <div class="media-body mb-5 text-white">
                        <h4 class="mt-0 mb-0"><?php echo $_SESSION['username']; ?></h4>
                       
                       <h5></h5>

                       
                    </div>
                </div>
            </div>


        </div>

    </div>
</div>

<div class="row bio">

    <div class="col-xl-6 col-md-9 col-sm-12 mx-auto">
    
    <?php echo $user->bio; ?> 

    </div>

</div>

</main>

<?php

include '../assets/layouts/footer.php'

?>