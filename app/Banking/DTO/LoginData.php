<?php
namespace App\Banking\DTO;
final readonly class LoginData {
 public function __construct(public string $cif,public string $password,public string $deviceId,public string $language='en_US') {}
}
