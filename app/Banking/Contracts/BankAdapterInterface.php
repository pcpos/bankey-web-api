<?php
namespace App\Banking\Contracts;
use App\Banking\DTO\LoginData;
use App\Banking\DTO\LoginResult;
interface BankAdapterInterface { public function login(LoginData $data): LoginResult; }
