<?php
namespace App\Http\Controllers\Api\V1;
use App\Banking\Contracts\BankAdapterInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
final class BillPaymentController extends Controller {
 public function __construct(private readonly BankAdapterInterface $bank) {}
 public function billers(Request $r): JsonResponse { return response()->json($this->bank->billers($r->header('X-Bank-Session',''))->toArray()); }
 public function inquiry(Request $r): JsonResponse { $v=$r->validate(['biller_id'=>'required|string|max:100','customer_reference'=>'required|string|max:150']); return response()->json($this->bank->billInquiry($r->header('X-Bank-Session',''),$v)->toArray()); }
 public function pay(Request $r): JsonResponse { $v=$r->validate(['account'=>'required|string|max:50','biller_id'=>'required|string|max:100','customer_reference'=>'required|string|max:150','amount'=>'required|numeric|gt:0']); return response()->json($this->bank->billPay($r->header('X-Bank-Session',''),$v)->toArray()); }
}
