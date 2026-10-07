<?php
namespace App\Banking\Bankak;
use Illuminate\Support\Facades\Http;
use RuntimeException;
final class BankakClient {
 public function send(string $payload): string {
  $base=rtrim((string)config('banking.bankak.base_url'),'/');
  if($base==='') throw new RuntimeException('BANKAK_BASE_URL is not configured.');
  $request=Http::connectTimeout(config('banking.bankak.connect_timeout'))->timeout(config('banking.bankak.timeout'));
  if(!config('banking.bankak.verify_ssl')) $request=$request->withoutVerifying();
  $response=$request->asForm()->post($base.config('banking.bankak.api_path'),['mfsapiin'=>$payload]);
  if(!$response->successful()) throw new RuntimeException('Bank upstream HTTP '.$response->status());
  return $response->body();
 }
}
