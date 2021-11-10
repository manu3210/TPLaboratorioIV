<?php

use DAO\JobOfferDAO;
use DAO\OfferXUserDAO;

$user = $_SESSION["user"];
    if($user->getTypeOfUser() == 0)
    {
          require_once('nav-user.php');
    }
    else
    {
          require_once('nav.php');
    }

    $offerXUserDAO = new OfferXUserDAO();
    $offerXuserList = $offerXUserDAO->GetAll();
    $jobOfferDAO = new JobOfferDAO();
    $jobPositionList = $jobOfferDAO->GetJobPositionFromApi();
    $careerList = $jobOfferDAO->GetCareerFromApi();
    $jobOfferList = $jobOfferDAO->GetAllBDD();
    
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Listado de ofertas</h2>
               <table class="table bg-dark-alpha">
                    <thead>
                         <th>Id</th>
                         <th>posicion</th>
                         <th>carrera</th>
                         <th>fecha de caducidad</th>
                    </thead>
                    <tbody>
                         <?php foreach($offerXuserList as $offerXUser)
                              {
                                   if($offerXUser->getIdUsuario() == $user->getId()){ ?>
                                   <tr>
                                        <td><?php echo $offerXUser->getIdJobOffer(); ?></td>
                                        <?php foreach($jobOfferList as $jobOffer) 
                                             {
                                                  if($jobOffer->getIdJobOffer() == $offerXUser->getIdJobOffer())
                                                  {
                                                       foreach($jobPositionList as $jobPosition)
                                                       {
                                                            if($jobOffer->getJobPosition() == $jobPosition->getJobPositionId()){ ?>
                                                            <td><?php echo $jobPosition->getDescription(); ?></td>
                                                            <?php 
                                                            foreach($careerList as $career)
                                                            {
                                                                 if($jobPosition->getCareerId() == $career->getCareerId()){ ?>
                                                                 <td><?php echo $career->getDescription(); ?></td>
                                                       <?php }}}} ?>
                                                  <td><?php echo $jobOffer->getFechaCaducidad(); ?></td>
                                   </tr> 
                         <?php }}}}?>
                    </tbody>
               </table>
               <div class="row justify-content-between">
                    <div class="col-3">
                         <a href="<?php echo FRONT_ROOT ?>User/ShowUserHome/"class="btn btn-dark me-md-2" type="button">Volver</a>
                    </div>
               </div>
          </div>
     </section>
</main>