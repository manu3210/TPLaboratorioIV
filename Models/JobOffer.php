<?php 

    namespace Models;

    class JobOffer
    {
        private $idJobOffer;
        private $companyId;
        private $jobPosition;
        private $fechaCaducidad;
        private $isActive;
        private $nombreImagen;

        public function getNombreImagen()
        {
                return $this->nombreImagen;
        }

        public function setNombreImagen($nombreImagen)
        {
                $this->nombreImagen = $nombreImagen;
                return $this;
        }

        public function getIdJobOffer()
        {
                return $this->idJobOffer;
        }

        public function setIdJobOffer($idJobOffer)
        {
                $this->idJobOffer = $idJobOffer;
                return $this;
        }

        public function getCompanyId()
        {
                return $this->companyId;
        }
 
        public function setCompanyId($companyId)
        {
                $this->companyId = $companyId;
                return $this;
        }

        public function getJobPosition()
        {
                return $this->jobPosition;
        }

        public function setJobPosition($jobPosition)
        {
                $this->jobPosition = $jobPosition;
                return $this;
        }

        public function getFechaCaducidad()
        {
                return $this->fechaCaducidad;
        }

        public function setFechaCaducidad($fechaCaducidad)
        {
                $this->fechaCaducidad = $fechaCaducidad;
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
    }
?>