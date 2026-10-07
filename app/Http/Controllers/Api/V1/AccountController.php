<?php
namespace App\Http\Controllers\Api\V1;
use App\Banking\Contracts\BankAdapterInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
final class AccountController extends Controller {
 public function __construct(private readonly BankAdapterInterface $bank) {}
 public function index(Request $r): JsonResponse { return response()->json($this->bank->accounts($r->header('X-Bank-Session',''))->toArray()); }
 public function miniStatement(Request $r,string $account): JsonResponse { return response()->json($this->bank->miniStatement($r->header('X-Bank-Session',''),$account)->toArray()); }
 public function statement(Request $r,string $account): JsonResponse {
  $v=$r->validate(['from'=>['required','date'],'to'=>['required','date','after_or_equal:from'],'type'=>['sometimes','string','max:30']]);
  return response()->json($this->bank->statement($r->header('X-Bank-Session',''),$account,$v)->toArray());
 }
}
