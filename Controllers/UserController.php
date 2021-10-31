<?php
    namespace Controllers;

    use DAO\UserDAO as UserDAO;
    use Models\User as User;

    class UserController
    {
        private $userDAO;

        public function __construct()
        {
            $this->userDAO = new UserDAO();
        }

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

        public function ShowSetPassView()
        {
            require_once(VIEWS_PATH."set-pass.php");
        }

        /*
        public function Add($Id, $careerId, $dni, $phone, $firstName, $fileNumber, $gender, $type, $lastName, $email, $birthdate)
        {
            $user = new User();
            $user->setId($Id);
            $user->setFirstName($firstName);
            $user->setLastName($lastName);
            $user->setCareerId($careerId);
            $user->setDescription("");
            $user->setDni($dni);
            $user->setPhoneNumber($phone);
            $user->setFileNumber($fileNumber);
            $user->setGender($gender);
            $user->setTypeOfUser($type);
            $user->setEmail($email);
            $user->setBirthDate($birthdate);
            $user->setIsActive(1);
            $user->setPassword("1234");

            $this->userDAO->Add($user);

            $this->ShowAddView();
        }
        */

        public function Add($idApi, $id, $email, $pass, $tipo, $descripcion, $alreadyaplied) // el $id hay que sacarlo cuando pasemos a bbdd
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

        public function Edit($email, $password, $phoneNumber, $description)
        {
            $user = $_SESSION["user"];
            $user->setPassword($password);
            $user->setEmail($email);
            $user->setPhoneNumber($phoneNumber);
            $user->setDescription($description);

            $this->userDAO->Update($user);
            $this->ShowUserHome();
        }

        public function EditAdmin($id, $careerId, $isActive, $firstName, $lastName, $type)
        {
            $user = $this->userDAO->GetById($id);
            $user->setId($id);
            $user->setCareerId($careerId);
            $user->setIsActive($isActive);
            $user->setFirstName($firstName);
            $user->setLastName($lastName);
            $user->setTypeOfUser($type);

            $this->userDAO->Update($user);
            $this->ShowListView();
        }

        
        /*
        public function login($email, $pass)
        {
            $userList = $this->userDAO->GetAll();
            $flag = 0;
            
            foreach($userList as $user)
            {
                if(strcmp($user->getEmail(), $email) == 0)
                {
                    $_SESSION["user"] = $user;

                    if(strcmp($user->getPassword(), "") == 0)
                    {
                        $flag = 1;
                        header("location:" .FRONT_ROOT . "User/ShowSetPassView");
                    }
                    else if(strcmp($user->getPassword(), $pass) == 0 && $user->getIsActive() == 1)
                    {
                        $flag = 1;
                        header("location:" .FRONT_ROOT . "User/ShowUserHome");
                    }
                }
            }

            if($flag == 0)
            {
                header("location:" .FRONT_ROOT . "User/ShowLoginView");
            }
        }*/

        public function login($email, $pass)
        {
            $api = $this->userDAO->GetDataFromApi();
            $data = $this->userDAO->GetAll();

            $userLogged = new User();

            $flag1 = false;
            $flag2 = false;

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
                        header("location:" .FRONT_ROOT . "User/ShowLoginView");
                    }
                    
                }
            }

            if($flag1 == false) // significa que el usuario no esta en la api
            {
                header("location:" .FRONT_ROOT . "User/ShowLoginView");
            }
            else if($flag1 == true && $flag2 == false) // significa que el usuario esta en la api pero no en la aplicacion
            {
                header("location:" .FRONT_ROOT . "User/ShowSetPassView");
            }
        }

        public function SetPass($email, $pass)
        {
            $api = $this->userDAO->GetDataFromApi();
            $user = new User();

            foreach($api as $student)
            {
                if(strcmp($student->getEmail(), $email) == 0 && $student->getEmail() == $email)
                {
                    $user->setEmail($email);
                    $user->setPassword($pass);
                    $user->setTypeOfUser(0);
                    $user->setAlreadyAplied(0);
                    $user->setDescription(null);
                    $user->setIdApi($student->getIdApi());

                    $this->userDAO->Add($user);
                }
            }

            header("location:" .FRONT_ROOT . "User/ShowLoginView");
        }

        public function Logout()
        {
            session_destroy();
            header("location:" .FRONT_ROOT . "User/ShowLoginView");
        }

    }
?>