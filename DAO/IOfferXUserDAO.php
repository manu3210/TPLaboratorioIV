<?php
    namespace DAO;

    use Models\OfferXUser as OfferXUser;

    interface IOfferXUserDAO
    {
        function Add(OfferXUser $OfferXUser);
        function GetAll();
    }
?>