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

    use DAO\CompanyDAO;
    use DAO\CareerDAO;
    use DAO\JobOfferDAO;
    use DAO\UserDAO;
    use Models\Career;
    use Models\JobPosition;
    use DAO\OfferXUserDAO;
    use Models\OfferXUser;

    $offerXUserList = new JobOfferDAO();
    $companyDAO = new CompanyDAO();
    $userDAO = new UserDAO();
    $careerDAO = new CareerDAO();
    $offerXUserDAO = new OfferXUserDAO();
    $offerXUser = new OfferXUser();

    $offerXUserList = $offerXUserDAO->GetListByIdJobOffer($idJobOffer);

    $studentList = $userDAO->GetListByofferXUserList($offerXUserList);
    $userDAO->MatchInfoWithAPI($studentList);
    //$studentList = $offerXUserDAO->GetListByIdJobOffer($idJobOffer);
    
    
?>

<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Listado de alumnos para la busqueda de " <?php echo $careerDescription ?> "</h2>
               <a href="<?php echo FRONT_ROOT ?>JobOffer/ShowReporte/<?php echo $idJobOffer; ?>/<?php echo $careerDescription; ?>" target="_blank" class="btn btn-dark me-md-2" type="button">Listado PDF</a>
               <table class="table bg-dark-alpha">
                    <thead>
                         <th>FirstName</th>
                         <th>LastName</th>
                         <th>DNI</th>
                         <th>Email</th>
                         <th>Borrar</th>
                    </thead>
                    <tbody>
                         <?php
                            foreach($studentList as $student)
                            { ?>
                                <tr>
                                    <td><?php echo $student->getFirstName(); ?></td>
                                    <td><?php echo $student->getLastName(); ?></td>
                                    <td><?php echo $student->getDni(); ?></td>
                                    <td><?php echo $student->getEmail(); ?></td>
                                    
                                    <td style="text-align: center;"><a href="<?php echo FRONT_ROOT ?>JobOffer/DeleteOfferXUser/<?php echo $idJobOffer; ?>/<?php echo $careerDescription; ?>/<?php echo $student->getId(); ?>"><i class="fas fa-trash-alt"></i></a></td> 
                                </tr> 
                      <?php } ?>
                         
                    </tbody>
               </table>
          </div>
     </section>
</main>