<?php

namespace App\Providers;

use App\Models\Course;
use App\Models\Comment;
use App\Policies\CoursePolicy;
use App\Policies\CommentPolicy;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }

    protected $policies = [
        Course::class => CoursePolicy::class,
        Comment::class => CommentPolicy::class,
    ];
}
