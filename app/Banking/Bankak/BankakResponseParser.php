<?php
namespace App\Banking\Bankak;
use App\Banking\DTO\LoginResult;
use RuntimeException;
final class BankakResponseParser {
 public function parseLogin(string $raw): LoginResult {
  throw new RuntimeException('Live Bankak response mapping requires an authorized upstream API specification.');
 }
}
