<?php 

    namespace Models;

    class Student
    {
        
        private $idUsuario;
        private $email;
        private $pass;
        private $descripcion;
        private $alreadyAplied;
        private $tipo;
        private $idAPI;

        public function getIdUsuario()
        {
                return $this->idUsuario;
        }

        public function setIdUsuario($idUsuario)
        {
                $this->idUsuario = $idUsuario;
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

        public function getPass()
        {
                return $this->pass;
        }
 
        public function setPass($pass)
        {
                $this->pass = $pass;
                return $this;
        }

        public function getDescripcion()
        {
                return $this->descripcion;
        }

        public function setDescripcion($descripcion)
        {
                $this->descripcion = $descripcion;
                return $this;
        }

        public function getAlreadyAplied()
        {
                return $this->alreadyAplied;
        }
 
        public function setAlreadyAplied($alreadyAplied)
        {
                $this->alreadyAplied = $alreadyAplied;
                return $this;
        }

        public function getTipo()
        {
                return $this->tipo;
        }

        public function setTipo($tipo)
        {
                $this->tipo = $tipo;
                return $this;
        }

        public function getIdAPI()
        {
                return $this->idAPI;
        }

        public function setIdAPI($idAPI)
        {
                $this->idAPI = $idAPI;
                return $this;
        }
    }


?>