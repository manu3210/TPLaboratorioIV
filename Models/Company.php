<?php 

    namespace Models;

    class Company
    {
        private $companyId;
        private $email;
        private $isActive;
        private $name;
        private $phoneNumber;
        private $pass;
        private $tipo;
        
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

        public function showIsActive()
        {
                if( $this->isActive == 0)
                        return "Empresa Inactiva";
                else 
                        return "Empresa Activa";
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

        public function getPass()
        {
                return $this->pass;
        }

        public function setPass($pass)
        {
                $this->pass = $pass;
                return $this;
        }

        public function getTipo()
        {
                return $this->tipo;
        }

        public function getTypeOfUser()
        {
                return $this->tipo;
        }

        public function setTipo($tipo)
        {
                $this->tipo = $tipo;
                return $this;
        }

        public function setTypeOfUser($tipo)
        {
                $this->tipo = $tipo;
                return $this;
        }
    }


?>