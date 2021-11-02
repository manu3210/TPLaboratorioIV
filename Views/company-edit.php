<?php

     use Models\Company;
     use DAO\CompanyDAO;

    require_once('nav.php');

    $companyDAO = new CompanyDAO();
    $company = $companyDAO->GetByIdBDD($companyId);
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Editar <?php echo $company->getName(); ?></h2>
               <form action="<?php echo FRONT_ROOT ?>Company/EditBDD" method="post" class="bg-dark-alpha p-5">
                    <div class="row">  
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Id</label>
                                   <input type="text" name="recordId" value="<?php echo $company->getCompanyId(); ?>" readonly class="form-control">
                              </div>
                         </div>                       
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Nombre</label>
                                   <input type="text" name="name" value="<?php echo $company->getName(); ?>" class="form-control">
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Email</label>
                                   <input type="email" name="email" value="<?php echo $company->getEmail(); ?>" class="form-control">
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">PhoneNumber</label>
                                   <input type="text" name="phoneNumber" value="<?php echo $company->getPhoneNumber(); ?>" class="form-control">
                              </div>
                         </div>
                    </div>
                    <button type="submit" class="btn btn-dark ml-auto d-block">Editar</button>
               </form>
          </div>
     </section>
</main>