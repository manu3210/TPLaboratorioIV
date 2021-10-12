<?php
    namespace DAO;

    use DAO\IUserDAO as IUserDAO;
    use Models\User as User;

    class UserDAO implements IUserDAO
    {
        private $userList = array();

        public function Add(User $user)
        {
            $this->RetrieveData();
            
            array_push($this->userList, $user);

            $this->SaveData();
        }

        public function GetAll()
        {
            $this->RetrieveData();

            return $this->userList;
        }

        public function GetById ($id)
        {
            $this->RetrieveData();

            foreach($this->userList as $user)
            {
                if($user->getId() == $id)
                {
                    return $user;
                }
            }
        }

        public function Update($user)
        {
            $toUpdate = $this->GetById($user->getId());

            $toUpdate->setId($user->getId());
            $toUpdate->setCareerId($user->getCareerId());
            $toUpdate->setFirstName($user->getfirstName());
            $toUpdate->setLastName($user->getLastName());
            $toUpdate->setDni($user->getDni());
            $toUpdate->setFileNumber($user->getFileNumber());
            $toUpdate->setGender($user->getGender());
            $toUpdate->setBirthDate($user->getBirthDate());
            $toUpdate->setEmail($user->getEmail());
            $toUpdate->setPhoneNumber($user->getPhoneNumber());
            $toUpdate->setIsActive($user->getIsActive());
            $toUpdate->setPassword($user->getPassword());
            $toUpdate->setTypeOfUser($user->getTypeOfUser());
            $toUpdate->setDescription($user->getDescription());

            $this->SaveData();

            return $user;
        }

        private function SaveData()
        {
            $arrayToEncode = array();

            foreach($this->userList as $user)
            {
                $valuesArray["studentId"] = $user->getId();
                $valuesArray["careerId"] = $user->getCareerId();
                $valuesArray["firstName"] = $user->getFirstName();
                $valuesArray["lastName"] = $user->getLastName();
                $valuesArray["dni"] = $user->getDni();
                $valuesArray["fileNumber"] = $user->getFileNumber();
                $valuesArray["gender"] = $user->getGender();
                $valuesArray["birthDate"] = $user->getBirthDate();
                $valuesArray["email"] = $user->getEmail();
                $valuesArray["phoneNumber"] = $user->getPhoneNumber();
                $valuesArray["active"] = $user->getIsActive();
                $valuesArray["password"] = $user->getPassword();
                $valuesArray["typeOfUser"] = $user->getTypeOfUser();
                $valuesArray["description"] = $user->getDescription();

                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            file_put_contents('Data/users.json', $jsonContent);
        }

        private function RetrieveData()
        {
            $this->userList = array();
            $arrayToDecode = array();

            if(file_exists('Data/users.json'))
            {
                $jsonContent = file_get_contents('Data/users.json');

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                    $user = new User();
                    
                    $this->LoadInfo($user, $valuesArray);
                    $user->setPassword($valuesArray["password"]);
                    $user->setTypeOfUser($valuesArray["typeOfUser"]);
                    $user->setDescription($valuesArray["description"]);

                    array_push($this->userList, $user);
                }
            }
            else
            {
                $this->GetDataFromApi();
            }

            $this->SaveData();
        }

        private function GetDataFromApi()
        {
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, "https://utn-students-api.herokuapp.com/api/Student");
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("x-api-key: 4f3bceed-50ba-4461-a910-518598664c08"));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            
            $arrayToDecode = json_decode(curl_exec($ch), true);

            foreach($arrayToDecode as $valuesArray)
            {
                $user = new User();
                
                $this->LoadInfo($user, $valuesArray);
                
                $user->setPassword("1234");
                $user->setDescription("Ingrese una descripción");
                $user->setTypeOfUser(0); // 0 = user - 1 = admin

                array_push($this->userList, $user);
            }
            
            curl_close($ch);
        }

        private function LoadInfo($user, $valuesArray)
        {
            $user->setId($valuesArray["studentId"]);
            $user->setCareerId($valuesArray["careerId"]);
            $user->setFirstName($valuesArray["firstName"]);
            $user->setLastName($valuesArray["lastName"]);
            $user->setDni($valuesArray["dni"]);
            $user->setFileNumber($valuesArray["fileNumber"]);
            $user->setGender($valuesArray["gender"]);
            $user->setBirthDate($valuesArray["birthDate"]);
            $user->setEmail($valuesArray["email"]);
            $user->setPhoneNumber($valuesArray["phoneNumber"]);
            if($valuesArray["active"] == "false")
                $user->setIsActive(0);
            else
                $user->setIsActive(1);
        }
    }
?>