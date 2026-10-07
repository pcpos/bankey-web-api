<?php
namespace App\Banking\Bankak;
use App\Banking\DTO\LoginData;
use RuntimeException;
final class BankakRequestBuilder {
 public function buildLogin(LoginData $data): string {
  throw new RuntimeException('Live Bankak request mapping requires an authorized upstream API specification.');
 }
}
