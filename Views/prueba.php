<?php
    require_once('nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Agregar alumno</h2>
               <form action="<?php echo FRONT_ROOT ?>User/AddBd" method="post" class="bg-dark-alpha p-5">
                    <div class="row">                         
                         <div class="col-lg-4">
                              <div class="form-group">
                                    <label for="">Id Api</label>
                                   <input type="text" name="idApi" value="" class="form-control">
                              </div>
                              <div class="form-group">
                                   <label for="">email</label>
                                   <input type="text" name="email" value="" class="form-control">
                              </div>
                              <div class="form-group">
                                   <label for="">pass</label>
                                   <input type="text" name="pass" value="" class="form-control">
                              </div>
                              <div class="form-group">
                                   <label for="">tipo</label>
                                   <input type="number" name="tipo" value="" class="form-control">
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">descripcion</label>
                                   <input type="text" name="descripcion" value="" class="form-control">
                              </div>
                              <div class="form-group">
                                   <label for="">aplico?</label>
                                   <input type="number" name="alreadyaplied" value="" class="form-control">
                              </div>
                              
                    </div>
                    <button type="submit" name="button" class="btn btn-dark ml-auto d-block">Agregar</button>
               </form>
          </div>
     </section>
</main>