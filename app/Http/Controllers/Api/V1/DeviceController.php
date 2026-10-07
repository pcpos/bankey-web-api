<?php
namespace App\Http\Controllers\Api\V1;
use App\Banking\Contracts\BankAdapterInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
final class DeviceController extends Controller {
 public function __construct(private readonly BankAdapterInterface $bank) {}
 public function reset(Request $r): JsonResponse { $v=$r->validate(['cif'=>'required|string|max:50','device_id'=>'required|string|max:255']); return response()->json($this->bank->deviceReset($v)->toArray()); }
 public function verify(Request $r): JsonResponse { $v=$r->validate(['reset_id'=>'required|string|max:100','otp'=>'required|string|max:20']); return response()->json($this->bank->verifyDeviceReset($v)->toArray()); }
}
