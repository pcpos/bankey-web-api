<?php
use Illuminate\Support\Facades\Artisan;
Artisan::command('bankey:status',function(){ $this->info('Bankey Web API is ready. Mode: '.config('banking.mode')); })->purpose('Show Bankey API status');
