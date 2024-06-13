<?php

namespace App\DTOs;

class SubmissionDTO
{
    public $name;
    public $email;
    public $message;

    public function __construct(array $data)
    {
        $this->name = $data['name'];
        $this->email = $data['email'];
        $this->message = $data['message'];
    }
}
