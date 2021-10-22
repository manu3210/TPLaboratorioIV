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

?>
<main class="d-flex align-items-center" >
    <div class="container mt-5">
        <div class="row justify-content-center" style=" height:50rem; ">
            <div class="col-sm-16">
                <div class="card border border-primary border-3" style="width: 30rem;">
                    <img src="https://i.pinimg.com/originals/d9/7b/bb/d97bbb08017ac2309307f0822e63d082.jpg" class="card-img-top w-25 rounded mx-auto d-block" alt="avatar">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $user->getFirstName(); ?></h5>
                        <p class="card-text"><?php echo $user->getDescription(); ?></p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><?php echo $user->getFirstName(); ?></li>
                        <li class="list-group-item"><?php echo $user->getLastName(); ?></li>
                        <li class="list-group-item"><?php echo $user->getDni(); ?></li>
                        <li class="list-group-item"><?php echo $user->getEmail(); ?></li>
                        <li class="list-group-item"><?php echo $user->getGender(); ?></li>
                        <li class="list-group-item"><?php echo $user->getBirthDate(); ?></li>
                        <li class="list-group-item"><?php echo $user->getPhoneNumber(); ?></li>
                        <li class="list-group-item"><?php echo $user->getCareerId(); ?></li>
                    </ul>
                    <div class="card-body">
                        <a href="<?php echo FRONT_ROOT ?>Company/ShowListView" class="card-link">Ver empresas</a>
                        <a href="<?php echo FRONT_ROOT ?>User/ShowEditView" class="card-link">Editar perfil</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>