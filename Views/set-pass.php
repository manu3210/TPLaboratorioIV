<?php 
     $email = "hola";
     $studentList = $this->userDAO->GetDataFromApi();
     foreach($studentList as $student)
     {
          if($student->getIdApi() == $idApi)
          {
               $email = $student->getEmail();
          }
     }

?>

<main class="d-flex align-items-center justify-content-center height-100">

     <div class="content">
     <h2>Crear Contraseña</h2>
          <form action="<?php echo FRONT_ROOT ?>User/SetPass" method="post" class="login-form bg-dark-alpha p-5 text-white">
               <div>
                    <input type="hidden" name="idApi" value="<?php echo $idApi; ?>">
               </div>
               <div class="form-group">
                    <label for="">Email </label>
                    <input type="email" name="email" value="<?php echo $email; ?>" class="form-control form-control-lg" placeholder="<?php echo $email; ?>" readonly>
               </div>
               <div class="form-group">
                    <label for="">Contraseña nueva: </label>
                    <input type="password" name="pass" class="form-control form-control-lg" placeholder="Ingresar contraseña">
               </div>
               <button class="btn btn-dark btn-block btn-lg" type="submit">Cambiar Contraseña</button>
          </form>
     </div>
</main>