<nav class="navbar navbar-expand-lg navbar-dark">
     <span class="navbar-text">
          <img src="<?php echo FRONT_ROOT ?>Views/img/iso-utn-black.png" height="35px" alt="logo">
     </span>
     <ul class="navbar-nav ml-auto">
          <li class="nav-item">
               <a class="nav-link" href="<?php echo FRONT_ROOT ?>User/ShowUserHome">Inicio</a>
          </li>
          <li class="nav-item">
               <a class="nav-link" href="<?php echo FRONT_ROOT ?>User/ShowAddUserView">Agregar Administrador</a>
          </li>
          <li class="nav-item">
               <a class="nav-link" href="<?php echo FRONT_ROOT ?>User/ShowListView">Listar Usuarios</a>
          </li>
          <li class="nav-item">
               <a class="nav-link" href="<?php echo FRONT_ROOT ?>Company/ShowAddCompanyView">Agregar Empresa</a>
          </li>
          <li class="nav-item">
               <a class="nav-link" href="<?php echo FRONT_ROOT ?>Company/ShowListView">Listar Empresas</a>
          </li>
           <li class="nav-item">
               <a class="nav-link" href="<?php echo FRONT_ROOT ?>User/Logout">Cerrar sesión</a>
          </li>
     </ul>
</nav>