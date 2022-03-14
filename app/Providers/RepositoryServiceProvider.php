<?php

namespace App\Providers;

use App\Repository\CategoryRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use App\Repository\Eloquent\BaseRepository;
use App\Repository\EloquentRepositoryInterface;
use App\Repository\Eloquent\UserRepository;
use App\Repository\UserRepositoryInterface;
use App\Repository\ForgotPasswordRepositoryInterface;
use App\Repository\Eloquent\ForgotPasswordRepository;
use App\Repository\Eloquent\UserProfileRepository;
use App\Repository\UserProfileRepositoryInterface;
use App\Repository\CountryRepositoryInterface;
use App\Repository\StateRepositoryInterface;
use App\Repository\CityRepositoryInterface;
use App\Repository\Eloquent\CategoryRepository;
use App\Repository\Eloquent\CountryRepository;
use App\Repository\Eloquent\StateRepository;
use App\Repository\Eloquent\CityRepository;
use App\Repository\Eloquent\ExtragigRepository;
use App\Repository\Eloquent\FaqRepository;
use App\Repository\Eloquent\GalleryRepository;
use App\Repository\Eloquent\UserAccountTypeRepository;
use App\Repository\UserAccountTypeRepositoryInterface;
use App\Repository\Eloquent\GeneralAccountTypeRepository;
use App\Repository\Eloquent\GigquestionRepository;
use App\Repository\Eloquent\GiGRepository;
use App\Repository\Eloquent\ProjectManagementRepository;
use App\Repository\Eloquent\ScopePackageRepository;
use App\Repository\Eloquent\TagRepository;
use App\Repository\Eloquent\TaskContainerRepository;
use App\Repository\Eloquent\TaskRepository;
use App\Repository\ExtragigRepositoryInterface;
use App\Repository\FaqRepositoryInterface;
use App\Repository\GalleryRepositoryInterface;
use App\Repository\GeneralAccountTypeRepositoryInterface;
use App\Repository\GigquestionRepositoryInterface;
use App\Repository\GiGRepositoryInterface;
use App\Repository\ProjectManagementRepositoryInterface;
use App\Repository\ScopePackageRepositoryInterface;
use App\Repository\TagRepositoryInterface;
use App\Repository\TaskContainerRepositoryInterface;
use App\Repository\TaskRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(EloquentRepositoryInterface::class, BaseRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(ForgotPasswordRepositoryInterface::class, ForgotPasswordRepository::class);
        $this->app->bind(UserProfileRepositoryInterface::class, UserProfileRepository::class);
        $this->app->bind(CountryRepositoryInterface::class, CountryRepository::class);
        $this->app->bind(StateRepositoryInterface::class, StateRepository::class);
        $this->app->bind(CityRepositoryInterface::class, CityRepository::class);
        $this->app->bind(UserAccountTypeRepositoryInterface::class, UserAccountTypeRepository::class);
        $this->app->bind(GeneralAccountTypeRepositoryInterface::class, GeneralAccountTypeRepository::class);
        $this->app->bind(GiGRepositoryInterface::class, GiGRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(FaqRepositoryInterface::class, FaqRepository::class);
        $this->app->bind(GigquestionRepositoryInterface::class, GigquestionRepository::class);
        $this->app->bind(ExtragigRepositoryInterface::class, ExtragigRepository::class);
        $this->app->bind(TagRepositoryInterface::class, TagRepository::class);
        $this->app->bind(ScopePackageRepositoryInterface::class, ScopePackageRepository::class);
        $this->app->bind(ProjectManagementRepositoryInterface::class, ProjectManagementRepository::class);
        $this->app->bind(TaskContainerRepositoryInterface::class, TaskContainerRepository::class);
        $this->app->bind(TaskRepositoryInterface::class, TaskRepository::class);
        $this->app->bind(GalleryRepositoryInterface::class, GalleryRepository::class);
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
