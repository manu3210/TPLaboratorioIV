<?php
     use DAO\JobOfferDAO;
    
    require_once('nav.php');

    $offerDao = new JobOfferDAO();
    $offerToModify = $offerDao->GetByIdBDD($offerId);


    $jobOfferList = $offerDao->GetJobPositionFromApi();
    
       
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Editar Oferta</h2>
               <form action="<?php echo FRONT_ROOT ?>JobOffer/editBDD" method="post" class="bg-light-alpha p-5">
                    <div class="row">   
                    <input type="hidden" name="offerId" value="<?php echo $offerId ?>" readonly >  
                    <input type="hidden" name="companyId" value="<?php echo $offerToModify->getCompanyId(); ?>" readonly >                    
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
                         <div class="col-lg-4 offset-md-4">
                              <div class="form-group">
                                   <label for="">Fecha Caducidad</label>
                                   <input type="date" name="fechaCaducidad" value="" class="form-control">
                              </div>
                         </div>
                    </div>
                    <a class="btn btn-dark mr-auto" href="<?php echo FRONT_ROOT ?>JobOffer/ShowOfferList">Volver</a>
                    <button type="submit" class="btn btn-dark ml-auto d-block">Actualizar</button>
               </form>
          </div>
     </section>
</main>