<nav class="navbar navbar-expand-lg navbar-dark">
     <span class="navbar-text">
          <img src="<?php echo FRONT_ROOT ?>Views/img/iso-utn-black.png" height="35px" alt="logo">
     </span>
     <ul class="navbar-nav ml-auto">
          <li class="nav-item">
               <a class="nav-link" href="<?php echo FRONT_ROOT ?>Company/ShowCompanyHome">Inicio</a>
          </li>
          <li class="nav-item">
               <a class="nav-link" href="<?php echo FRONT_ROOT ?>JobOffer/ShowListOffer/<?php $user = $_SESSION["user"]; echo $user->getCompanyId(); ?>">Ver Mis Ofertas</a>
          </li>
           <li class="nav-item">
               <a class="nav-link" href="<?php echo FRONT_ROOT ?>Company/Logout">Cerrar sesión</a>
          </li>
     </ul>
</nav>