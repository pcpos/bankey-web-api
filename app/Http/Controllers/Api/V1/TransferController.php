<?php
namespace App\Http\Controllers\Api\V1;
use App\Banking\Contracts\BankAdapterInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
final class TransferController extends Controller {
 public function __construct(private readonly BankAdapterInterface $bank) {}
 public function own(Request $r): JsonResponse { $v=$r->validate(['from_account'=>'required|string|max:50','to_account'=>'required|string|max:50','amount'=>'required|numeric|gt:0','comment'=>'nullable|string|max:255']); return response()->json($this->bank->ownTransfer($r->header('X-Bank-Session',''),$v)->toArray()); }
 public function other(Request $r): JsonResponse { $v=$r->validate(['from_account'=>'required|string|max:50','to_account'=>'required|string|max:50','amount'=>'required|numeric|gt:0','beneficiary_name'=>'nullable|string|max:150','mobile'=>'nullable|string|max:30','comment'=>'nullable|string|max:255']); return response()->json($this->bank->otherTransfer($r->header('X-Bank-Session',''),$v)->toArray()); }
 public function p2p(Request $r): JsonResponse { $v=$r->validate(['from_account'=>'required|string|max:50','recipient'=>'required|string|max:100','amount'=>'required|numeric|gt:0','comment'=>'nullable|string|max:255']); return response()->json($this->bank->p2pTransfer($r->header('X-Bank-Session',''),$v)->toArray()); }
 public function confirm(Request $r): JsonResponse { $v=$r->validate(['transaction_id'=>'required|string|max:100','otp'=>'required|string|max:20']); return response()->json($this->bank->confirmTransfer($r->header('X-Bank-Session',''),$v)->toArray()); }
}
