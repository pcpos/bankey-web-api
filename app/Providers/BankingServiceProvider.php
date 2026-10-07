<?php
namespace App\Providers;
use App\Banking\Bankak\BankakAdapter;
use App\Banking\Contracts\BankAdapterInterface;
use Illuminate\Support\ServiceProvider;
final class BankingServiceProvider extends ServiceProvider { public function register(): void { $this->app->bind(BankAdapterInterface::class,BankakAdapter::class); } }
