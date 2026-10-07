<?php
namespace App\Http\Controllers\Api\V1;
use App\Banking\Contracts\BankAdapterInterface;
use App\Banking\DTO\LoginData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\LoginRequest;
use Illuminate\Http\JsonResponse;
final class AuthController extends Controller {
 public function __construct(private readonly BankAdapterInterface $bank) {}
 public function login(LoginRequest $request): JsonResponse {
  $v=$request->validated();
  $result=$this->bank->login(new LoginData($v['cif'],$v['password'],$v['device_id'],$v['language']??'en_US'));
  return response()->json($result->toArray(),$result->success?200:401);
 }
}
