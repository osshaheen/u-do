<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Validator;
use Illuminate\Support\Arr;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Validator::extend('poly_exists', function ($attribute, $value, $parameters, $validator) {
            if (!$objectType = Arr::get($validator->getData(), $parameters[0], false)) {
                return false;
            }
            if (!class_exists($objectType)) {
                return false;
            }

            return !empty(resolve($objectType)->find($value));
        });
    }
}
