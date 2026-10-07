<?php
namespace App\Banking\DTO;
final readonly class BankResult {
 public function __construct(public bool $success,public array $data=[],public ?string $message=null,public ?string $code=null) {}
 public static function ok(array $data=[],?string $message=null): self { return new self(true,$data,$message); }
 public static function fail(string $code,string $message,array $data=[]): self { return new self(false,$data,$message,$code); }
 public function toArray(): array {
  $out=['success'=>$this->success,'data'=>$this->data];
  if($this->message!==null) $out['message']=$this->message;
  if(!$this->success) $out['error']=['code'=>$this->code,'message'=>$this->message];
  return $out;
 }
}
