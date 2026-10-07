<?php
namespace App\Http\Requests\Api\V1;
use Illuminate\Foundation\Http\FormRequest;
final class LoginRequest extends FormRequest {
 public function authorize(): bool { return true; }
 public function rules(): array { return ['cif'=>['required','string','max:50'],'password'=>['required','string','max:255'],'device_id'=>['required','string','max:255'],'language'=>['sometimes','string','in:en_US,ar_SA']]; }
}
