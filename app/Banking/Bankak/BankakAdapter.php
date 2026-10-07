<?php
namespace App\Banking\Bankak;
use App\Banking\Contracts\BankAdapterInterface;
use App\Banking\DTO\LoginData;
use App\Banking\DTO\LoginResult;
final class BankakAdapter implements BankAdapterInterface {
 public function __construct(private readonly BankakClient $client,private readonly BankakRequestBuilder $builder,private readonly BankakResponseParser $parser) {}
 public function login(LoginData $data): LoginResult {
  if(config('banking.mode')==='mock') return new LoginResult(true,'mock-session',['cif'=>$data->cif,'name'=>'Mock Customer','mobile'=>null,'email'=>null],[['account_number'=>'0000000000','currency'=>'SDG','balance'=>0]],false,'Mock login successful','MOCK');
  return $this->parser->parseLogin($this->client->send($this->builder->buildLogin($data)));
 }
}
