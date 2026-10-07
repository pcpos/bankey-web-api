<?php
return [
 'provider'=>env('BANK_PROVIDER','bankak'),
 'mode'=>env('BANK_MODE','mock'),
 'bankak'=>[
  'base_url'=>env('BANKAK_BASE_URL'),
  'api_path'=>env('BANKAK_API_PATH','/mfmbs/mbintf/ina/processapirequest.jsp'),
  'connect_timeout'=>(int)env('BANKAK_CONNECT_TIMEOUT',10),
  'timeout'=>(int)env('BANKAK_TIMEOUT',30),
  'verify_ssl'=>filter_var(env('BANKAK_VERIFY_SSL',true),FILTER_VALIDATE_BOOL),
 ],
];
