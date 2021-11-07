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
    $companyDAO = new CompanyDAO();
    $company = $companyDAO->GetByIdBDD($companyId);

?>
<main class="d-flex align-items-center" >
    <div class="container mt-5">
        <div class="row justify-content-center" style=" height:50rem; ">
            <div class="col-sm-16">
                <div class="card border border-primary border-3" style="width: 40rem;">
                    <img src="https://i.pinimg.com/originals/d9/7b/bb/d97bbb08017ac2309307f0822e63d082.jpg" class="card-img-top w-25 rounded mx-auto d-block" alt="avatar">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $company->getName(); ?></h5>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><?php echo $company->getEmail(); ?></li>
                        <li class="list-group-item"><?php echo $company->getPhoneNumber(); ?></li>
                        <li class="list-group-item"><?php echo $company->showIsActive() ?></li>
                    </ul>
                    <div class="card-body">
                        <?php if($user->getTypeOfUser() == 1) {?>
                        <a href="<?php echo FRONT_ROOT ?>Company/ShowEditView/<?php echo $company->getCompanyId(); ?>" class="card-link">Editar datos </a>
                        <?php } ?>
                        <a href="<?php echo FRONT_ROOT ?>JobOffer/ShowListOffer/<?php echo $company->getCompanyId(); ?>" class="card-link">Ver lista de ofertas </a>
                        <?php
                            if($user->getTypeOfUser() == 1)
                            {
                        ?>
                                <a href="<?php echo FRONT_ROOT ?>JobOffer/ShowAddJobOffer/<?php echo $company->getCompanyId(); ?>" class="card-link">Crear Puesto Laboral </a>
                        <?php
                            }
                        ?>
                        <div class="d-inline d-md-flex justify-content-md-end">
                            <a href="<?php echo FRONT_ROOT ?>Company/ShowListView/" > Volver</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</main>