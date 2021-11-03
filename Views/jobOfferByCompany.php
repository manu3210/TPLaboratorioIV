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

    use DAO\CompanyDAO;
    use DAO\JobOfferDAO;
    use Models\Career;
    use Models\JobPosition;

    $jobOffer = new JobOfferDAO();
    $companyDAO = new CompanyDAO();

    $position = new JobPosition();
    $career = new Career();

    $companyList = $companyDAO->GetAllBDD();
    $offerList = $jobOffer->GetAllBDD();
    $jobPositionList = $jobOffer->GetJobPositionFromApi();
    $careerList = $jobOffer->GetCareerFromApi();


?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Listado de ofertas</h2>
               <table class="table bg-dark-alpha">
                    <thead>
                         <th>Compania</th>
                         <th>Id</th>
                         <th>posicion</th>
                         <th>carrera</th>
                         <th>fecha de caducidad</th>
                         <th>agregar</th>
                         
                    </thead>
                    <tbody>
                         <?php
                            foreach($companyList as $company)
                            { ?>
                                <tr>
                                <td><?php echo $company->getName() ?></td>
                                
                                    <?php
                                    foreach($offerList as $offer)
                                    {
                                        if($offer->getCompanyId() == $company->getCompanyId())
                                        {
                                        ?>
                                            <tr>
                                            <td>
                                            <td><?php echo $offer->getIdJobOffer(); ?></td>

                                            <td>
                                             <?php 
                                                foreach($jobPositionList as $jobPosition)
                                                {
                                                                
                                                    if($jobPosition->getJobPositionId() == $offer->getJobPosition())
                                                    {
                                                        $position = $jobPosition;
                                                        foreach($careerList as $c)
                                                        {
                                                            if($position->getCareerId() == $c->getCareerId())
                                                            {
                                                                $career = $c;
                                                            }
                                                        }
                                                        echo $position->getDescription();
                                                    }
                                                }
                                            ?>
                                            </td>

                                            <td><?php echo $career->getDescription(); ?></td>
                                            <td><?php echo $offer->getFechaCaducidad(); ?></td>
                                            <td style="text-align: center;"><a href="<?php echo FRONT_ROOT ?>JobOffer/AddJobOfferToUser/<?php echo $offer->getIdJobOffer();  ?>/<?php echo $user->getId(); ?>"><i class="fas fa-plus text-dark"></i></a></td>
                                            </td>       
                                            </tr>       
                                                
                                        <?php
                                        }
                                    } ?>
                                </tr>
                      <?php }
                         ?>
                         </tr>
                    </tbody>
               </table>
          </div>
     </section>
</main>