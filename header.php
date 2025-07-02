   <nav class="navbar navbar-expand-lg bg-body-tertiary">
       <div class="container-fluid">
           <a class="navbar-brand" href="/slip_app/index.php">Slip</a>
           <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
               <span class="navbar-toggler-icon"></span>
           </button>
           <div class="collapse navbar-collapse" id="navbarSupportedContent">
               <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                   <li class="nav-item">
                       <a class="nav-link active" aria-current="page" href="/slip_app/dashboard.php">Dashboard</a>
                   </li>
                   <li class="nav-item">
                       <a class="nav-link" href="/slip_app/users/index.php">User</a>
                   </li>
                   <li class="nav-item dropdown">
                       <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                           Dropdown
                       </a>
                       <ul class="dropdown-menu">
                           <li><a class="dropdown-item" href="#">Action</a></li>
                           <li><a class="dropdown-item" href="#">Another action</a></li>
                           <li>
                               <hr class="dropdown-divider">
                           </li>
                           <li><a class="dropdown-item" href="#">Something else here</a></li>
                       </ul>
                   </li>
               </ul>
               <?php if (!empty($_SESSION)) : ?>
                   <a href="/slip_app/logout.php" class="btn btn-danger">Log Out</a>
               <?php else : ?>
                   <a href="index.php" class="btn btn-warning me-2">Log In</a>
                   <a href="register.php" class="btn btn-primary">Sign Up</a>
               <?php endif; ?>
           

           </div>
       </div>
   </nav>