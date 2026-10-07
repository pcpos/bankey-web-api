<?php
namespace App\Http\Controllers\Api\V1;
use App\Banking\Contracts\BankAdapterInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
final class RecoveryController extends Controller {
 public function __construct(private readonly BankAdapterInterface $bank) {}
 public function forgot(Request $r): JsonResponse { $v=$r->validate(['cif'=>'required|string|max:50']); return response()->json($this->bank->forgotPassword($v)->toArray()); }
 public function verifyOtp(Request $r): JsonResponse { $v=$r->validate(['recovery_id'=>'required|string|max:100','otp'=>'required|string|max:20']); return response()->json($this->bank->verifyRecoveryOtp($v)->toArray()); }
 public function reset(Request $r): JsonResponse { $v=$r->validate(['recovery_token'=>'required|string|max:255','new_password'=>'required|string|min:6|max:255']); return response()->json($this->bank->resetPassword($v)->toArray()); }
}
