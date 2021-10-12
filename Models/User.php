<?php 

    namespace Models;

    class User
    {
        private $id;
        private $careerId;
        private $fileNumber;
        private $password;
        private $email;
        private $isActive;
        private $firstName;
        private $lastName;
        private $dni;
        private $gender;
        private $birthDate;
        private $phoneNumber;
        private $typeOfUser;
        private $description;

        public function getId()
        {
                return $this->id;
        }

        public function setId($id)
        {
                $this->id = $id;

                return $this;
        }

        public function getPassword()
        {
                return $this->password;
        }

        public function setPassword($password)
        {
                $this->password = $password;

                return $this;
        }

        public function getEmail()
        {
                return $this->email;
        }

        public function setEmail($email)
        {
                $this->email = $email;

                return $this;
        }

        public function getIsActive()
        {
                return $this->isActive;
        }

        public function setIsActive($isActive)
        {
                $this->isActive = $isActive;

                return $this;
        }

        public function getFirstName()
        {
                return $this->firstName;
        }

        public function setFirstName($firstName)
        {
                $this->firstName = $firstName;

                return $this;
        }

        public function getLastName()
        {
                return $this->lastName;
        }

        public function setLastName($lastName)
        {
                $this->lastName = $lastName;

                return $this;
        }

        public function getDni()
        {
                return $this->dni;
        }

        public function setDni($dni)
        {
                $this->dni = $dni;

                return $this;
        }

        public function getGender()
        {
                return $this->gender;
        }

        public function setGender($gender)
        {
                $this->gender = $gender;

                return $this;
        }

        public function getBirthDate()
        {
                return $this->birthDate;
        }

        public function setBirthDate($birthDate)
        {
                $this->birthDate = $birthDate;

                return $this;
        }

        public function getPhoneNumber()
        {
                return $this->phoneNumber;
        }

        public function setPhoneNumber($phoneNumber)
        {
                $this->phoneNumber = $phoneNumber;

                return $this;
        }

        public function getCareerId()
        {
                return $this->careerId;
        }

        public function setCareerId($careerId)
        {
                $this->careerId = $careerId;

                return $this;
        }

        public function getFileNumber()
        {
                return $this->fileNumber;
        }

        public function setFileNumber($fileNumber)
        {
                $this->fileNumber = $fileNumber;

                return $this;
        }

        public function getTypeOfUser()
        {
                return $this->typeOfUser;
        }

        public function setTypeOfUser($typeOfUser)
        {
                $this->typeOfUser = $typeOfUser;

                return $this;
        }

        public function getDescription()
        {
                return $this->description;
        }
        
        public function setDescription($description)
        {
                $this->description = $description;

                return $this;
        }
    }


?>