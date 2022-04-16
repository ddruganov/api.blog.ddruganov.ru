<?php

namespace api\components;

use Yii;
use yii\base\Component;

final class HeaderAccessTokenProvider extends Component implements AccessTokenProviderInterface
{
    public function getAccessToken(): string
    {
        $accessToken = Yii::$app->getRequest()->getHeaders()->get('Authorization') ?? '';
        $accessToken = str_replace('Bearer', '', $accessToken);
        return trim($accessToken);
    }
}
