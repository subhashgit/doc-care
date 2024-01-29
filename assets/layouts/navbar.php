            <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm p-2">
                <div class="container">
                    <a class="navbar-brand" href="../home">
                            <img src="../assets/images/logo.png" alt="" width="150" height="44" class="mr-3">
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="../">Welcome</a>
                            </li>
                            <?php if (!isset($_SESSION['auth'])) { ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="../contact">Contact Us</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="../login">Login</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="../register">Signup</a>
                                </li>
                            <?php } else { ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="../dashboard">Dashboard</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="../home">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="../contact">Contact Us</a>
                                </li>
                                <div class="dropdown">
                                    <button class="btn btn-dark dropdown-toggle" type="button" id="imgdropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img class="navbar-img" src="../assets/uploads/users/<?php echo $_SESSION['profile_image'] ?>">
                                        <span class="caret"></span>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="imgdropdown">
                                        <a class="dropdown-item text-muted" href="../profile"><i class="fa fa-user pr-2"></i> Profile</a>
                                        <a class="dropdown-item text-muted" href="../profile-edit"><i class="fa fa-pencil-alt pr-2"></i> Edit Profile</a>
                                        <a class="dropdown-item text-muted" href="../logout"><i class="fa fa-running pr-2"></i> Logout</a>
                                    </div>
                                </div>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </nav>