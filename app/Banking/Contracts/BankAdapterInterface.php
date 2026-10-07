<?php
namespace App\Banking\Contracts;
use App\Banking\DTO\BankResult;
use App\Banking\DTO\LoginData;
use App\Banking\DTO\LoginResult;
interface BankAdapterInterface {
 public function login(LoginData $data): LoginResult;
 public function accounts(string $session): BankResult;
 public function miniStatement(string $session,string $account): BankResult;
 public function statement(string $session,string $account,array $input): BankResult;
 public function ownTransfer(string $session,array $input): BankResult;
 public function otherTransfer(string $session,array $input): BankResult;
 public function p2pTransfer(string $session,array $input): BankResult;
 public function confirmTransfer(string $session,array $input): BankResult;
 public function billers(string $session): BankResult;
 public function billInquiry(string $session,array $input): BankResult;
 public function billPay(string $session,array $input): BankResult;
 public function forgotPassword(array $input): BankResult;
 public function verifyRecoveryOtp(array $input): BankResult;
 public function resetPassword(array $input): BankResult;
 public function deviceReset(array $input): BankResult;
 public function verifyDeviceReset(array $input): BankResult;
}
