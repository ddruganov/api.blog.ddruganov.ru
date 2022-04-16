<?php

namespace common\components\auth;

final class AuthServiceUser
{
    public function __construct(
        private int $id,
        private string $email,
        private string $name,
        private bool $isBanned
    ) {
    }

    public function getId()
    {
        return $this->id;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getName()
    {
        return $this->name;
    }

    public function isBanned()
    {
        return $this->isBanned;
    }
}
