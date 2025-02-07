<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Intervention\Image\ImageServiceProvider as InterventionImageServiceProvider;
use Intervention\Image\Facades\Image as InterventionImage;

class ImageServiceProvider extends ServiceProvider
{
    public function register()
    {
        // // Register the Intervention Image service provider
        // $this->app->register(InterventionImageServiceProvider::class);

        // // Register the Image facade alias
        // $this->app->alias(InterventionImage::class, 'Image');
    }

    public function boot()
    {
        // Boot logic if needed
    }
}
