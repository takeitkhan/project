<?php 
namespace Tritiyo\Project;
use Illuminate\Support\ServiceProvider;

use Tritiyo\Project\Repositories\Project\ProjectEloquent;
use Tritiyo\Project\Repositories\Project\ProjectInterface;

class ProjectServiceProvider extends ServiceProvider {

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__. '/routes/modules/projects.php');
        $this->loadViewsFrom(__DIR__. '/views', 'project');
        $this->loadMigrationsFrom(__DIR__. '/database/migrations');
    }

    public function register()
    {
        $this->app->singleton(ProjectInterface::class, ProjectEloquent::class);
    }
}


?>