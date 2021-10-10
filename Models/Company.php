<?php 

    namespace Models;

    class Company
    {
        private $companyId;
        private $email;
        private $isActive;
        private $name;
        private $phoneNumber;
        
        public function getCompanyId()
        {
                return $this->companyId;
        }

        public function setCompanyId($companyId)
        {
                $this->companyId = $companyId;
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

        public function getName()
        {
                return $this->name;
        }

        public function setName($name)
        {
                $this->name = $name;
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
    }


?>