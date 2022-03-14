<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repository\UploadFile\UploadFileService;

use App\Repository\UploadFile\UploadFileInterface;

class UploadFileServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UploadFileInterface::class, UploadFileService::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
