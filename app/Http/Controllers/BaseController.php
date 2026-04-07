<?php

namespace App\Http\Controllers;
use OpenApi\Attributes as OA;

#[OA\Info(title: "我的 APIs", version: "1.0.0")]
#[OA\Server(url: 'http://127.0.0.1:8000', description: '本地開發伺服器')]
//#[OA\Info(title: "我的 Todo API", version: "1.0.0")]
//#[OA\Server(url: 'http://127.0.0.1:8000', description: '本地開發伺服器')]

class BaseController extends \App\Http\Controllers\Controller
{
    //
}
