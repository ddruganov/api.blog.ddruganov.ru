<?php

namespace common\components\auth;

use ddruganov\Yii2ApiEssentials\ExecutionResult;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use yii\base\Component;
use yii\helpers\Json;

final class AuthService extends Component implements AuthServiceInterface
{
    private function getBaseApiUrl()
    {
        return 'http://api.hub.ddruganov.ru.nginx:2000/api';
    }

    public function verify(string $accessToken): ExecutionResult
    {
        return $this->apiV1('get', 'auth/verify', [
            'headers' => [
                'Authorization' => "Bearer $accessToken"
            ]
        ]);
    }

    public function refresh(string $refreshToken): ExecutionResult
    {
        return $this->apiV1('post', 'auth/refresh', [
            RequestOptions::JSON => [
                'refreshToken' => $refreshToken
            ]
        ]);
    }

    public function checkPermission(string $accessToken, string $permissionName): ExecutionResult
    {
        return $this->apiV1('post', 'auth/check-permission', [
            'headers' => [
                'Authorization' => "Bearer $accessToken"
            ],
            RequestOptions::JSON => [
                'permissionName' => $permissionName
            ]
        ]);
    }

    public function getUserByAccessToken(string $accessToken): AuthServiceUser
    {
        $result = $this->apiV1('get', 'auth/current-user', [
            'headers' => [
                'Authorization' => "Bearer $accessToken"
            ]
        ]);

        if (!$result->isSuccessful()) {
            throw new Exception('Ошибка получения данных о пользователе с удалённого сервера');
        }

        return new AuthServiceUser(
            id: $result->getData('id'),
            email: $result->getData('email'),
            name: $result->getData('name'),
            isBanned: $result->getData('isBanned')
        );
    }

    private function apiV1(string $method, string $endpoint, array $options): ExecutionResult
    {
        return $this->request($method, "v1/$endpoint", $options);
    }

    private function request(string $method, string $endpoint, array $options): ExecutionResult
    {
        $client = new Client();
        $response = $client->request(
            $method,
            "{$this->getBaseApiUrl()}/$endpoint",
            ['http_errors' => false] + $options
        );

        $json = $response->getBody()->getContents();
        $data = Json::decode($json);
        return ExecutionResult::fromArray($data);
    }
}
