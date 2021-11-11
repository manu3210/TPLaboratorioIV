<?php
    $user = $_SESSION["user"];
    if($user->getTypeOfUser() == 0)
    {
        require_once('nav-user.php');
    }else if($user->getTypeOfUser() == 1)
    {
        require_once('nav.php');
    }else 
    {
        require_once('nav-company.php');
    }
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
          <div class="row justify-content-between">
                    <div class="col-6">
                         <h2 class="mb-4">Listado de empresas activas</h2>
                    </div>
                    <div class="col-4">
                         <form class="d-flex" action="<?php echo FRONT_ROOT?>Company/ShowListfilteredView" method="post">
                              <input class="form-control me-2" type="search" name="name" placeholder="buscar por nombre" aria-label="Search">
                              <button class="btn btn-outline-success" type="submit">Buscar</button>
                         </form>
                    </div>
               </div>
               <hr>
               <table class="table bg-dark-alpha">
                    <thead>
                         <th>Id</th>
                         <th>Nombre</th>
                         <th>Email</th>
                         <th>Telefono</th>
                         <?php if($user->getTypeOfUser() == 1) {?>
                         <th></th>
                         <th></th>
                         <?php } ?>
                         <th></th>
                    </thead>
                    <tbody>
                         <?php foreach($companyList as $company) 
                         { 
                              if( $company->getIsActive() == 1 ) 
                              { ?>
                                   <tr>
                                        <td><?php echo $company->getCompanyId() ?></td>
                                        <td><?php echo $company->getName() ?></td>
                                        <td><?php echo $company->getEmail() ?></td>
                                        <td><?php echo $company->getPhoneNumber() ?></td>
                                        <?php if($user->getTypeOfUser() == 1) {?>
                                        <td style="text-align: center;"><a href="<?php echo FRONT_ROOT ?>Company/ShowEditView/<?php echo $company->getCompanyId(); ?>"><i class="far fa-edit text-dark"></i></a></td>
                                        <td style="text-align: center;"><a href="<?php echo FRONT_ROOT ?>Company/DeleteFromBDD/<?php echo $company->getCompanyId(); ?>"><i class="fas fa-trash-alt"></i></a></td>
                                        <?php } ?>
                                        <td style="text-align: center;"><a href="<?php echo FRONT_ROOT ?>Company/ShowCompanyDetails/<?php echo $company->getCompanyId(); ?>"><i class="fas fa-search"></i></a></td>
                                   </tr>
                              <?php } 
                         } ?>
                         </tr>
                    </tbody>
               </table>
               <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="<?php echo FRONT_ROOT ?>User/ShowUserHome/"class="btn btn-primary me-md-2" type="button">Volver</a>
               </div>
          </div>
     </section>
     <?php if($user->getTypeOfUser() == 1) {?>
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Listado de Empresas Inactivas</h2>
               <hr>
               <table class="table bg-dark-alpha">
                    <thead>
                         <th>Id</th>
                         <th>Nombre</th>
                         <th>Email</th>
                         <th>Telefono</th>
                         <?php if($user->getTypeOfUser() == 1) {?>
                         <th></th>
                         <th></th>
                         <?php } ?>
                         <th></th>
                    </thead>
                    <tbody>
                    <?php foreach($companyList as $company) 
                         { 
                              if( $company->getIsActive() == 0 ) 
                              { ?>
                                   <tr>
                                        <td><?php echo $company->getCompanyId() ?></td>
                                        <td><?php echo $company->getName() ?></td>
                                        <td><?php echo $company->getEmail() ?></td>
                                        <td><?php echo $company->getPhoneNumber() ?></td>
                                        
                                        <td style="text-align: center;"><a href="<?php echo FRONT_ROOT ?>Company/ShowEditView/<?php echo $company->getCompanyId(); ?>"><i class="far fa-edit text-dark"></i></a></td>
                                        <td style="text-align: center;"><a href="<?php echo FRONT_ROOT ?>Company/ActivateCompany/<?php echo $company->getCompanyId(); ?>"><i class="fas fa-hand-pointer"></i></a></td>
                                        
                                        <td style="text-align: center;"><a href="<?php echo FRONT_ROOT ?>Company/ShowCompanyDetails/<?php echo $company->getCompanyId(); ?>"><i class="fas fa-search"></i></a></td>
                                   </tr>
                              <?php } 
                         } ?>
                         </tr>
                    </tbody>
               </table>
               <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="<?php echo FRONT_ROOT ?>User/ShowUserHome/"class="btn btn-primary me-md-2" type="button">Volver</a>
               </div>
          </div>
     </section>
     <?php } ?>
</main>