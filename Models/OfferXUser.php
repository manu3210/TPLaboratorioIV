<?php 

    namespace Models;

    class OfferXUser
    {
        private $idPostulacionesXUsuarios;
        private $idJobOffer;
        private $idUsuario;

        public function getIdPostulacionesXUsuarios()
        {
                return $this->idPostulacionesXUsuarios;
        }

        public function setIdPostulacionesXUsuarios($idPostulacionesXUsuarios)
        {
                $this->idPostulacionesXUsuarios = $idPostulacionesXUsuarios;
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

        public function getIdUsuario()
        {
                return $this->idUsuario;
        }

        public function setIdUsuario($idUsuario)
        {
                $this->idUsuario = $idUsuario;
                return $this;
        }
    }
?>