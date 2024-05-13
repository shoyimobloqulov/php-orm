<?php
    namespace Shoyim\ORM;

    abstract class DataBaseORM
    {
        protected $conn;
        protected $user;
        protected $db_name;
        protected $password;

        public function __construct()
        {

        }
    }