<?php
// controllers/UserController.php

require_once __DIR__ . '/../models/User.php';

class UserController
{
    private $userModel;

    public function __construct($db)
    {
        $this->userModel = new User($db);
    }

    public function createUser($data)
    {
        if ($this->userModel->insertUser($data)) {
            return "New record created successfully";
        } else {
            return "An error occurred while creating the record.";
        }
    }
}
