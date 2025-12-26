<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\MicrosoftAuthService;
use Illuminate\Http\Request;

class MicrosoftAuthController extends Controller
{
    protected $microsoftAuthService;

    public function __construct(MicrosoftAuthService $microsoftAuthService)
    {
        $this->microsoftAuthService = $microsoftAuthService;
    }

    public function redirect()
    {
        return $this->microsoftAuthService->redirectToMicrosoft();
    }

    public function callback()
    {
        return $this->microsoftAuthService->handleMicrosoftCallback();
    }
}