<?php
namespace Tests\Feature;
use Tests\TestCase;
final class BankingApiTest extends TestCase {
 public function test_login_mock(): void {
  $this->postJson('/api/v1/auth/login',['cif'=>'123456789012','password'=>'secret','device_id'=>'test-device'])
   ->assertOk()->assertJsonPath('success',true)->assertJsonPath('data.session_id','mock-session');
 }
 public function test_accounts_mock(): void {
  $this->withHeader('X-Bank-Session','mock-session')->getJson('/api/v1/accounts')
   ->assertOk()->assertJsonPath('success',true)->assertJsonCount(2,'data.accounts');
 }
 public function test_own_transfer_validation_and_mock(): void {
  $this->withHeader('X-Bank-Session','mock-session')->postJson('/api/v1/transfers/own',['from_account'=>'1000000001','to_account'=>'1000000002','amount'=>1000])
   ->assertOk()->assertJsonPath('success',true)->assertJsonPath('data.status','SUCCESS');
 }
 public function test_bill_inquiry_mock(): void {
  $this->withHeader('X-Bank-Session','mock-session')->postJson('/api/v1/bills/inquiry',['biller_id'=>'ZAIN','customer_reference'=>'0912345678'])
   ->assertOk()->assertJsonPath('success',true);
 }
 public function test_password_recovery_mock(): void {
  $this->postJson('/api/v1/password/forgot',['cif'=>'123456789012'])
   ->assertOk()->assertJsonPath('success',true)->assertJsonPath('data.otp_required',true);
 }
 public function test_device_reset_mock(): void {
  $this->postJson('/api/v1/device/reset',['cif'=>'123456789012','device_id'=>'new-device'])
   ->assertOk()->assertJsonPath('success',true)->assertJsonPath('data.otp_required',true);
 }
}
