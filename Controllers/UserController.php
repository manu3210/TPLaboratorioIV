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

        public function Add($recordId, $firstName, $lastName)
        {
            $user = new User();
            $user->setId($recordId);
            $user->setFirstName($firstName);
            $user->setLastName($lastName);

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

        

        public function login($email, $pass)
        {
            $userList = $this->userDAO->GetAll();
            $flag = 0;
            
            foreach($userList as $user)
            {
                if(strcmp($user->getEmail(), $email) == 0)
                {
                    $_SESSION["user"] = $user;

                    if(strcmp($user->getPassword(), "1234") == 0)
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
        }

        public function SetPass($pass)
        {
            $user = $_SESSION["user"];
            $user->SetPassword($pass);
            $this->userDAO->Update($user);
            header("location:" .FRONT_ROOT . "User/ShowLoginView");
        }

        public function Logout()
        {
            session_destroy();
            header("location:" .FRONT_ROOT . "User/ShowLoginView");
        }

    }
?>