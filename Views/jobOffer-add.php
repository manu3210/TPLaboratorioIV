<?php
    $user = $_SESSION["user"];
    if($user->getTypeOfUser() == 0)
    {
          require_once('nav-user.php');
    }
    else
    {
          require_once('nav.php');
    }
    use Models\Company;
    use DAO\CompanyDAO;

    use Models\JobOffer;
    use DAO\JobOfferDAO;
    $jobOfferDAO = new JobOfferDAO();

    $jobOfferList = $jobOfferDAO->GetJobPositionFromApi();
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Agregar JobOffer</h2>
               <form action="<?php echo FRONT_ROOT ?>JobOffer/Add" method="post" class="bg-dark-alpha p-5">
                    <div class="row">                         
                         <div class="col-lg-4">
                              <input type="hidden" name="companyId" value="<?php echo $companyId ?>" readonly >
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Posicion</label>
                                   <select name="JobId">
                                        <?php 
                                             foreach($jobOfferList as $valuesArray)
                                             {
                                        ?>
                                             <option value="<?php echo $valuesArray->getJobPositionId(); ?>"><?php echo $valuesArray->getDescription(); ?></option>
                                        <?php
                                             }
                                        ?>
                                   </select>

                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Fecha Caducidad</label>
                                   <input type="date" name="fechaCaducidad" value="" class="form-control">
                              </div>
                         </div>
                         
                    </div>
                    <button type="submit" class="btn btn-dark ml-auto d-block">Agregar</button>
               </form>
          </div>
     </section>
</main>