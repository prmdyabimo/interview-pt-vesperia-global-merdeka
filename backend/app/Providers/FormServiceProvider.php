<?php

namespace App\Providers;

use App\Domain\Form\Repositories\FormRepositoryInterface;
use App\Infrastructure\Database\Repositories\DatabaseFormRepository;
use Illuminate\Support\ServiceProvider;

class FormServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Bind repository interface to implementation
        $this->app->bind(
            FormRepositoryInterface::class,
            DatabaseFormRepository::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}