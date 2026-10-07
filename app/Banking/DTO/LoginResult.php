<?php
namespace App\Banking\DTO;
final readonly class LoginResult {
 public function __construct(public bool $success,public ?string $sessionId=null,public ?array $customer=null,public array $accounts=[],public bool $passwordChangeRequired=false,public ?string $message=null,public ?string $upstreamCode=null) {}
 public function toArray(): array { return ['success'=>$this->success,'data'=>['session_id'=>$this->sessionId,'customer'=>$this->customer,'accounts'=>$this->accounts,'password_change_required'=>$this->passwordChangeRequired],'message'=>$this->message,'upstream_code'=>$this->upstreamCode]; }
}
