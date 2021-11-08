<?php
    namespace Controllers;

    use DAO\CompanyDAO as CompanyDAO;
    use Models\Company as Company;

    use DAO\UserDAO as UserDAO;
    use Models\User as User;

    class LogInController
    {
        private $CompanyDAO;
        private $UserDAO;
        
        public function __construct()
        {
            $this->CompanyDAO = new CompanyDAO();
            $this->UserDAO = new UserDAO();
        }

        public function LogIn($email ,$pass)
        {
            $user = new User();
            //lo pienso como un problema de cuatro posibles resultados, para lo cual
            //utilizo el atributo firstName para setear mi retorno de error o de usuario valido
            //utilizo los siguientes parametros:
            //en el atributo $firstName
            //retornara 0 si no se encuentra el email
            //retornara 1 si encuentra el email pero no esta activo
            //de lo contrario me retornara el estudiante buscado y pertenece a un estudiante
            $user = $this->UserDAO->checkUser($email);
            if( $user->getFirstName() == 0 )
            {
                return "no se encuentra registrado, contacte a la entidad";
            }else{
                //chequeo si esta activo
                if( $user->getFirstName() == 1 )
                {
                    return "no es un alumno activo, contacte a la entidad";
                }else{
                    //chequeo si ya esta logueado en la BDD
                    $user= $this->UserDAO->GetByEmail($email);
                    if( $user->getPassword() == null )
                    {
                        //pasar el email asi se auto completa en el formulario
                        header("location:" .FRONT_ROOT . "User/ShowSetPassView");
                    }else{
                        if( $user->getPassword() == $pass )
                        {
                            header("location:" .FRONT_ROOT . "User/ShowUserHome");
                        }else{
                            return "Email o contraseña incorrectos";
                        }
                    }
                }
            }
        }

    }
?>