<?php
namespace App\Banking\Bankak;
use App\Banking\Contracts\BankAdapterInterface;
use App\Banking\DTO\BankResult;
use App\Banking\DTO\LoginData;
use App\Banking\DTO\LoginResult;
use RuntimeException;
final class BankakAdapter implements BankAdapterInterface {
 public function __construct(private readonly BankakClient $client,private readonly BankakRequestBuilder $builder,private readonly BankakResponseParser $parser) {}
 private function mock(): bool { return config('banking.mode')==='mock'; }
 private function requireLiveSpec(): never { throw new RuntimeException('This live banking operation requires the authorized upstream API specification.'); }
 public function login(LoginData $d): LoginResult {
  if($this->mock()) return new LoginResult(true,'mock-session',['cif'=>$d->cif,'name'=>'Mock Customer','mobile'=>null,'email'=>null],[['account_number'=>'1000000001','currency'=>'SDG','balance'=>250000]],false,'Mock login successful','MOCK');
  return $this->parser->parseLogin($this->client->send($this->builder->buildLogin($d)));
 }
 public function accounts(string $s): BankResult { if(!$this->mock()) $this->requireLiveSpec(); return BankResult::ok(['accounts'=>[['account_number'=>'1000000001','type'=>'CURRENT','currency'=>'SDG','balance'=>250000,'available_balance'=>245000],['account_number'=>'1000000002','type'=>'SAVINGS','currency'=>'SDG','balance'=>80000,'available_balance'=>80000]]]); }
 public function miniStatement(string $s,string $a): BankResult { if(!$this->mock()) $this->requireLiveSpec(); return BankResult::ok(['account_number'=>$a,'transactions'=>[['id'=>'TXN-001','date'=>'2026-10-06','description'=>'Mock payment','amount'=>-5000,'currency'=>'SDG'],['id'=>'TXN-002','date'=>'2026-10-05','description'=>'Mock credit','amount'=>20000,'currency'=>'SDG']]]); }
 public function statement(string $s,string $a,array $i): BankResult { if(!$this->mock()) $this->requireLiveSpec(); return BankResult::ok(['account_number'=>$a,'from'=>$i['from'],'to'=>$i['to'],'transactions'=>[]]); }
 public function ownTransfer(string $s,array $i): BankResult { if(!$this->mock()) $this->requireLiveSpec(); return BankResult::ok(['transaction_id'=>'OWN-'.uniqid(),'status'=>'SUCCESS','from_account'=>$i['from_account'],'to_account'=>$i['to_account'],'amount'=>(float)$i['amount'],'currency'=>'SDG'],'Mock own-account transfer completed'); }
 public function otherTransfer(string $s,array $i): BankResult { if(!$this->mock()) $this->requireLiveSpec(); return BankResult::ok(['transaction_id'=>'OTHER-'.uniqid(),'status'=>'PENDING_CONFIRMATION','amount'=>(float)$i['amount'],'confirmation_required'=>true],'Mock transfer created'); }
 public function p2pTransfer(string $s,array $i): BankResult { if(!$this->mock()) $this->requireLiveSpec(); return BankResult::ok(['transaction_id'=>'P2P-'.uniqid(),'status'=>'PENDING_CONFIRMATION','recipient'=>$i['recipient'],'amount'=>(float)$i['amount'],'confirmation_required'=>true],'Mock P2P transfer created'); }
 public function confirmTransfer(string $s,array $i): BankResult { if(!$this->mock()) $this->requireLiveSpec(); return BankResult::ok(['transaction_id'=>$i['transaction_id'],'status'=>'SUCCESS'],'Mock transfer confirmed'); }
 public function billers(string $s): BankResult { if(!$this->mock()) $this->requireLiveSpec(); return BankResult::ok(['billers'=>[['id'=>'ZAIN','name'=>'Zain'],['id'=>'SUDANI','name'=>'Sudani']]]); }
 public function billInquiry(string $s,array $i): BankResult { if(!$this->mock()) $this->requireLiveSpec(); return BankResult::ok(['biller_id'=>$i['biller_id'],'customer_reference'=>$i['customer_reference'],'customer_name'=>'Mock Customer','amount_due'=>10000,'currency'=>'SDG']); }
 public function billPay(string $s,array $i): BankResult { if(!$this->mock()) $this->requireLiveSpec(); return BankResult::ok(['transaction_id'=>'BILL-'.uniqid(),'status'=>'SUCCESS','biller_id'=>$i['biller_id'],'amount'=>(float)$i['amount'],'currency'=>'SDG'],'Mock bill paid'); }
 public function forgotPassword(array $i): BankResult { if(!$this->mock()) $this->requireLiveSpec(); return BankResult::ok(['recovery_id'=>'REC-'.uniqid(),'otp_required'=>true],'Mock recovery started'); }
 public function verifyRecoveryOtp(array $i): BankResult { if(!$this->mock()) $this->requireLiveSpec(); return BankResult::ok(['recovery_token'=>'mock-recovery-token','verified'=>true]); }
 public function resetPassword(array $i): BankResult { if(!$this->mock()) $this->requireLiveSpec(); return BankResult::ok(['reset'=>true],'Mock password reset successful'); }
 public function deviceReset(array $i): BankResult { if(!$this->mock()) $this->requireLiveSpec(); return BankResult::ok(['reset_id'=>'DEV-'.uniqid(),'otp_required'=>true],'Mock authorized device reset started'); }
 public function verifyDeviceReset(array $i): BankResult { if(!$this->mock()) $this->requireLiveSpec(); return BankResult::ok(['reset_id'=>$i['reset_id'],'reset'=>true],'Mock authorized device reset completed'); }
}
