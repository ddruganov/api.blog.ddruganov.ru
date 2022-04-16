<?php

namespace api\components;

interface AccessTokenProviderInterface
{
    public function getAccessToken(): string;
}
