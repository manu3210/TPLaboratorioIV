<?php
    namespace Controllers;

    use DAO\UserDAO as UserDAO;
    use Exception;
    use Models\User as User;

    class UserController
    {
        private $userDAO;

        public function __construct()
        {
            $this->userDAO = new UserDAO();
        }

        // ----------------------------------- GET ------------------------------------ //
        public function ShowAddView()
        {
            if(isset($_SESSION["user"]))
                require_once(VIEWS_PATH."student-add.php");
            else
            header("location:" .FRONT_ROOT . "User/ShowLoginView");
        }

        public function ShowAddBdView()
        {
            if(isset($_SESSION["user"]))
                require_once(VIEWS_PATH."prueba.php");
            else
            header("location:" .FRONT_ROOT . "User/ShowLoginView");
        }

        public function ShowAddUserView()
        {
            if(isset($_SESSION["user"]))
                require_once(VIEWS_PATH."student-add.php");
            else
            header("location:" .FRONT_ROOT . "User/ShowLoginView");
        }

        public function ShowEditView()
        {
            if(isset($_SESSION["user"]))
            {
                require_once(VIEWS_PATH."student-edit.php");
            }
                
            else
            header("location:" .FRONT_ROOT . "User/ShowLoginView");
        }

        public function ShowEditFullView($userId)
        {
            require_once(VIEWS_PATH."student-edit-complete.php");
        }

        public function ShowLoginView()
        {
            require_once(VIEWS_PATH."login.php");
        }

        public function ShowUserHome()//estudiante
        {
            require_once(VIEWS_PATH."user-home.php");
        }

        public function ShowListfilteredView($email)//admin
        {
            if(isset($_SESSION["user"]))
            {
                $studentList = array();
                $user = $this->userDAO->GetByEmail($email);
                if($user)
                    array_push($studentList, $user);
                    
                require_once(VIEWS_PATH."student-list.php");
            }
            else
                header("location:" .FRONT_ROOT . "User/ShowLoginView");
        }

        public function ShowListView()//admin
        {
            if(isset($_SESSION["user"]))
            {
                $studentList = $this->userDAO->GetAll();
                require_once(VIEWS_PATH."student-list.php");
            }
            else
                header("location:" .FRONT_ROOT . "User/ShowLoginView");
        }

        public function ShowSetPassView($idApi)
        {

            require_once(VIEWS_PATH."set-pass.php");
        }

        public function ShowLoginAdmin()
        {
            require_once(VIEWS_PATH."loginAdmin.php");
        }


        // ---------------------------------- POST -------------------------------------- //

        public function Add($idApi, $email, $pass, $tipo, $descripcion, $alreadyaplied)
        {
            $user = new User();
            $user->setIdApi($idApi);
            $user->setDescription($descripcion);
            $user->setTypeOfUser($tipo);
            $user->setEmail($email);
            $user->setPassword($pass);
            $user->setAlreadyAplied($alreadyaplied);

            $this->userDAO->Add($user);

            $this->ShowAddView();
        }

        public function AddUser($type, $email, $pass, $idApi, $description)
        {
            $user = new User();
            $user->setIdApi($idApi);
            $user->setDescription($description);
            $user->setEmail($email);
            $user->setPassword($pass);
            $user->setAlreadyAplied(0);
            if($type == "admin")
                $user->setTypeOfUser(1);
            else
                $user->setTypeOfUser(0);

            try
            {
                $this->userDAO->Add($user);
            }
            catch (Exception $e)
            {
                echo "Error, el usuario ya existe!";
            }            

            $this->ShowAddView();
        }

        public function Edit($password, $Descripcion)
        {
            $user = $_SESSION["user"];
            $user->setPassword($password);
            $user->setDescription($Descripcion);

            $this->userDAO->Update($user);
            $this->ShowUserHome();
        }

        public function EditAdmin($id, $type)
        {
            $user = $this->userDAO->GetById($id);
            $user->setTypeOfUser($type);

            $this->userDAO->Update($user);
            $this->ShowListView();
        }

        public function login($email, $pass)
        {
            $api = $this->userDAO->GetDataFromApi(); //se trae todo de la API
            $data = $this->userDAO->GetAll();  //se trae todo de la BDD(los estudiantes)

            $userLogged = new User();

            $flag1 = false;
            $flag2 = false;

            //con este primer foreach verifico si esta en la API(o sea si es estudiante)
            foreach($api as $student)
            {
                if($student->getEmail() == $email)
                {
                    $flag1 = true;
                    $userLogged->setIdApi($student->getIdApi());
                }                
            }

            foreach($data as $user)
            {
                if($userLogged->getIdApi() == $user->getIdApi())
                {
                    $flag2 = true;

                    if($user->getPassword() == $pass)
                    {
                        $userLogged = $user;
                        $this->userDAO->Fetch($userLogged);
                        $_SESSION["user"] = $userLogged;
                        header("location:" .FRONT_ROOT . "User/ShowUserHome");
                    }
                    else
                    {
                        $_SESSION["msj"] = "Contraseña incorrecta";
                        header("location:" .FRONT_ROOT . "User/ShowLoginView");
                    }
                }
            }

            if($flag1 == false) // significa que el usuario no esta en la api
            {
                $_SESSION["msj"] = "Este Email no esta habilitado para usar la aplicación";
                header("location:" .FRONT_ROOT . "User/ShowLoginView");
            }
            else if($flag2 == false) // significa que el usuario esta en la api pero no en la aplicacion
            {
                header("location:" .FRONT_ROOT . "User/ShowSetPassView/" . $userLogged->getIdApi());
            }
        }

        public function LoginAdmin($email, $pass)
        {
            $data = $this->userDAO->GetAll();
            $flag = 0;

            foreach($data as $user)
            {
                if($email == $user->getEmail())
                {
                    $flag = 1;
                    if($user->getPassword() == "")
                    {
                        $_SESSION["user"] = $user;
                        header("location:" .FRONT_ROOT . "User/ShowEditView");
                    }
                    else if($user->getPassword() == $pass && $user->getTypeOfUser() == 1)
                    {
                        $_SESSION["user"] = $user;
                        header("location:" .FRONT_ROOT . "User/ShowUserHome");
                    }
                    else
                    {
                        $_SESSION["msj"] = "Contraseña incorrecta";
                        header("location:" .FRONT_ROOT . "User/ShowLoginAdmin");
                    }
                }
                
            }
            if($flag == 0)
            {
                $_SESSION["msj"] = "Error de ingreso";
                header("location:" .FRONT_ROOT . "User/ShowLoginAdmin");
            }
        }

        public function SetPass($idApi, $email, $pass)
        {
            $user = new User();
            
            $user->setEmail($email);
            $user->setPassword($pass);
            $user->setTypeOfUser(0);
            $user->setAlreadyAplied(0);
            $user->setDescription(null);
            $user->setIdApi($idApi);

            $this->userDAO->Add($user);
                
            header("location:" .FRONT_ROOT . "User/ShowLoginView");
        }

        public function Logout()
        {
            session_destroy();
            header("location:" .FRONT_ROOT . "User/ShowLoginView");
        }

    }
?>