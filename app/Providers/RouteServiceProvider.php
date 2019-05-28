<?php

namespace App\Providers;

use App\Branch;
use App\Category;
use App\City;
use App\Country;
use App\Package;
use App\Place;
use App\PlaceBranch;
use App\PointType;
use App\Provider;
use App\Rank;
use App\Service;
use App\ServiceType;
use App\State;
use App\Tag;
use App\User;
use App\WeekDay;
use App\WorkExceptionDate;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {

        Route::bind('user_id',function ($user_id){
//            User::onlyTrashed()->find($user_id)
            if(User::find($user_id)) {
                return User::find($user_id);
            }elseif (User::onlyTrashed()->find($user_id)) {
                return User::onlyTrashed()->find($user_id);
            }else{
                abort(404);
            }
        });
        Route::bind('provider_id',function ($provider_id){
            if(Provider::find($provider_id)) {
                return Provider::find($provider_id);
            }elseif (Provider::onlyTrashed()->find($provider_id)) {
                return Provider::onlyTrashed()->find($provider_id);
            }else{
                abort(404);
            }
        });
        Route::bind('country_id',function ($country_id){
            if(Country::find($country_id)) {
                return Country::find($country_id);
            }elseif (Country::onlyTrashed()->find($country_id)) {
                return Country::onlyTrashed()->find($country_id);
            }else{
                abort(404);
            }
        });
        Route::bind('state_id',function ($state_id){
            if(State::find($state_id)) {
                return State::find($state_id);
            }elseif (State::onlyTrashed()->find($state_id)) {
                return State::onlyTrashed()->find($state_id);
            }else{
                abort(404);
            }
        });
        Route::bind('city_id',function ($city_id){
            if(City::find($city_id)) {
                return City::find($city_id);
            }elseif (City::onlyTrashed()->find($city_id)) {
                return City::onlyTrashed()->find($city_id);
            }else{
                abort(404);
            }
        });
        Route::bind('rank_id',function ($rank_id){
            if(Rank::find($rank_id)) {
                return Rank::find($rank_id);
            }elseif (Rank::onlyTrashed()->find($rank_id)) {
                return Rank::onlyTrashed()->find($rank_id);
            }elseif ($rank_id == 'null'){
                return $rank_id;
            }else{
                abort(404);
            }
        });
        Route::bind('service_type_id',function ($service_type_id){
            if(ServiceType::find($service_type_id)) {
                return ServiceType::find($service_type_id);
            }elseif (ServiceType::onlyTrashed()->find($service_type_id)) {
                return ServiceType::onlyTrashed()->find($service_type_id);
            }elseif ($service_type_id == 'null'){
                return $service_type_id;
            }else{
                abort(404);
            }
        });
        Route::bind('point_type_id',function ($point_type_id){
            if(PointType::find($point_type_id)) {
                return PointType::find($point_type_id);
            }elseif (PointType::onlyTrashed()->find($point_type_id)) {
                return PointType::onlyTrashed()->find($point_type_id);
            }elseif ($point_type_id == 'null'){
                return $point_type_id;
            }else{
                abort(404);
            }
        });
        Route::bind('tag_id',function ($tag_id){
            if(Tag::find($tag_id)) {
                return Tag::find($tag_id);
            }elseif (Tag::onlyTrashed()->find($tag_id)) {
                return Tag::onlyTrashed()->find($tag_id);
            }elseif ($tag_id == 'null'){
                return $tag_id;
            }else{
                abort(404);
            }
        });
        Route::bind('place_id',function ($place_id){
            if(Place::find($place_id)) {
                return Place::find($place_id);
            }elseif (Place::onlyTrashed()->find($place_id)) {
                return Place::onlyTrashed()->find($place_id);
            }elseif ($place_id == 'null'){
                return $place_id;
            }else{
                abort(404);
            }
        });
        Route::bind('place_branch_id',function ($branch_id){
            if(PlaceBranch::find($branch_id)) {
//                dd($branch_id);
                return PlaceBranch::find($branch_id);
            }elseif (PlaceBranch::onlyTrashed()->find($branch_id)) {
                return PlaceBranch::onlyTrashed()->find($branch_id);
            }elseif ($branch_id == 'null'){
                return $branch_id;
            }else{
                abort(404);
            }
        });
        Route::bind('category_id',function ($category_id){
            if(Category::find($category_id)) {
//                dd($branch_id);
                return Category::find($category_id);
            }elseif (Category::onlyTrashed()->find($category_id)) {
                return Category::onlyTrashed()->find($category_id);
            }elseif ($category_id == 'null'){
                return $category_id;
            }elseif ($category_id == 0){
                return $category_id;
            }else{
                abort(404);
            }
        });
        Route::bind('branch_id',function ($branch_id){
            if(Branch::find($branch_id)) {
//                dd($branch_id);
                return Branch::find($branch_id);
            }elseif (Branch::onlyTrashed()->find($branch_id)) {
                return Branch::onlyTrashed()->find($branch_id);
            }elseif ($branch_id == 'null'){
                return $branch_id;
            }else{
                abort(404);
            }
        });
        Route::bind('service_id',function ($service_id){
            if(Service::find($service_id)) {
//                dd($branch_id);
                return Service::find($service_id);
            }elseif (Service::onlyTrashed()->find($service_id)) {
                return Service::onlyTrashed()->find($service_id);
            }elseif ($service_id == 'null'){
                return $service_id;
            }else{
                abort(404);
            }
        });
        Route::bind('week_day_id',function ($week_day_id){
            if(WeekDay::find($week_day_id)) {
//                dd($branch_id);
                return WeekDay::find($week_day_id);
            }elseif (WeekDay::onlyTrashed()->find($week_day_id)) {
                return WeekDay::onlyTrashed()->find($week_day_id);
            }elseif ($week_day_id == 'null'){
                return $week_day_id;
            }else{
                abort(404);
            }
        });
        Route::bind('exceptionWorkingDay',function ($work_exception_date){
            if(WorkExceptionDate::find($work_exception_date)) {
//                dd($branch_id);
                return WorkExceptionDate::find($work_exception_date);
            }elseif (WorkExceptionDate::onlyTrashed()->find($work_exception_date)) {
                return WorkExceptionDate::onlyTrashed()->find($work_exception_date);
            }elseif ($work_exception_date == 'null'){
                return $work_exception_date;
            }else{
                abort(404);
            }
        });
        Route::bind('package_id',function ($package_id){
            if(Package::find($package_id)) {
//                dd($branch_id);
                return Package::find($package_id);
            }elseif (Package::onlyTrashed()->find($package_id)) {
                return Package::onlyTrashed()->find($package_id);
            }elseif ($package_id == 'null'){
                return $package_id;
            }else{
                abort(404);
            }
        });
        Route::bind('role_id',function ($role_id){
            if(Role::find($role_id)) {
//                dd($branch_id);
                return Role::find($role_id);
            }elseif (Role::onlyTrashed()->find($role_id)) {
                return Role::onlyTrashed()->find($role_id);
            }elseif ($role_id == 'null'){
                return $role_id;
            }else{
                abort(404);
            }
        });
        Route::bind('permission_id',function ($permission_id){
            if(Permission::find($permission_id)) {
//                dd($branch_id);
                return Permission::find($permission_id);
            }elseif ($permission_id == 'null'){
                return $permission_id;
            }else{
                abort(404);
            }
        });
        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }
}
