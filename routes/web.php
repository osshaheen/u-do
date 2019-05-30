<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::middleware(['set_lang'])->group(function () {

    Route::resource('/users', 'userController')->except('show');
    Route::get('/trashedUsers', 'userController@trashedUsers')->name('users.trashed');
    Route::get('/restoreUsers/{user_id}', 'userController@restoreUsers')->name('users.restore');
    Route::get('/blockUser/{user_id}/{status}', 'userController@blockUser')->name('users.blockUser');
    Route::get('/makeProvider/{user_id}', 'userController@makeProvider')->name('users.makeProvider');
    Route::get('/getProviderDetails/{provider_id}', 'userController@getProviderDetails')->name('users.getProviderDetails');
    Route::get('/usersProviderEdit/{provider_id}/{trigger?}', 'userController@usersProviderEdit')->name('users.provider.edit');
    Route::get('/getProviderViews/{provider_id}', 'userController@getProviderViews')->name('users.provider.getProviderViews');
    Route::post('/updateUserProvider/{provider_id}', 'userController@updateUserProvider')->name('users.provider.updateUserProvider');
    Route::get('/providers', 'userController@providers')->name('users.providers');
    Route::get('/change_provider_rank/{provider_id}/{rank_id}', 'userController@change_provider_rank')->name('users.change_provider_rank');
    Route::get('/change_provider_service_type/{provider_id}/{service_type_id}', 'userController@change_provider_service_type')->name('users.change_provider_service_type');

    Route::resource('/branches', 'ProviderBranchesController')->except('index', 'create');
    Route::get('/providerBranches/{provider_id}', 'ProviderBranchesController@index')->name('branches.index');
    Route::get('/createProviderBranches/{provider_id}', 'ProviderBranchesController@create')->name('branches.create');
    Route::get('/restoreBranch/{branch_id}', 'ProviderBranchesController@restoreBranch')->name('branches.restore');
    Route::get('/trashedBranches/{provider_id}', 'ProviderBranchesController@trashedBranches')->name('branches.trashed');
    Route::get('/setBranchAsMain/{branch_id}', 'ProviderBranchesController@setBranchAsMain')->name('branches.main');
    Route::get('/setBranchAddress/{branch_id}', 'ProviderBranchesController@setBranchAddress')->name('branches.address');

    Route::get('/branchWorkDays/{branch_id}', 'ProviderBranchesController@branchWorkDays')->name('branches.work_days');
    Route::get('/addWeekDayToCalendar/{branch_id}/{week_day_id}/{status}', 'ProviderBranchesController@addWeekDayToCalendar')->name('branches.addWorkDay');
    Route::post('/set_work_day_customization', 'ProviderBranchesController@set_work_day_customization')->name('branches.set_work_day_customization');

    Route::resource('/countries', 'countriesController')->except('show');
    Route::get('/restoreCountry/{country_id}', 'countriesController@restoreCountry')->name('countries.restore');
    Route::get('/trashedCountries', 'countriesController@trashedCountries')->name('countries.trashed');

    Route::resource('/states', 'statesController')->except('show');
    Route::get('/restoreState/{state_id}', 'statesController@restoreState')->name('states.restore');
    Route::get('/trashedStates', 'statesController@trashedStates')->name('states.trashed');

    Route::resource('/cities', 'citiesController')->except('show');
    Route::get('/addCityAddress/{city_id}', 'citiesController@addCityAddress')->name('cities.addAddress');
    Route::get('/restoreCity/{city_id}', 'citiesController@restoreCity')->name('cities.restore');
    Route::get('/trashedCities', 'citiesController@trashedCities')->name('cities.trashed');

    Route::resource('/ranks', 'ranksController')->except('show');
    Route::get('/restoreRank/{rank_id}', 'ranksController@restoreRank')->name('ranks.restore');
    Route::get('/trashedRanks', 'ranksController@trashedRanks')->name('ranks.trashed');

    Route::resource('/point_types', 'PointTypeController')->except('show');
    Route::get('/restorePointType/{point_type_id}', 'PointTypeController@restorePointType')->name('point_types.restore');
    Route::get('/trashedPointType', 'PointTypeController@trashedPointType')->name('point_types.trashed');

    Route::resource('/service_types', 'ServiceTypeController');
    Route::get('/restoreServiceType/{service_type_id}', 'ServiceTypeController@restoreServiceType')->name('service_types.restore');
    Route::get('/trashedServiceType', 'ServiceTypeController@trashedServiceType')->name('service_types.trashed');

    Route::resource('/services', 'ServicesController')->except('index', 'create');
    Route::get('/providerBranchServices/{branch_id}', 'ServicesController@index')->name('services.index');
    Route::get('/providerBranchServiceTags/{service_id}', 'ServicesController@show')->name('services.tags');
    Route::get('/createProviderBranchService/{branch_id}', 'ServicesController@create')->name('services.create');
    Route::get('/restoreService/{service_id}', 'ServicesController@restoreService')->name('services.restore');
    Route::get('/trashedServices/{branch_id}', 'ServicesController@trashedServices')->name('services.trashed');
    Route::get('/addTagToService/{service_type_id}/{tag_id}/{status}', 'ServicesController@addTagToService')->name('services.addTag');

    Route::resource('/tags', 'TagController')->except('show');
    Route::get('/restoreTag/{tag_id}', 'TagController@restoreTag')->name('tags.restore');
    Route::get('/trashedTag', 'TagController@trashedTag')->name('tags.trashed');
    Route::get('/addTagToServiceType/{service_type_id}/{tag_id}/{status}', 'TagController@addTagToServiceType')->name('tags.addTagToServiceType');

    Route::resource('/places', 'PlaceController');
    Route::get('/restorePlace/{place_id}', 'PlaceController@restorePlace')->name('places.restore');
    Route::get('/trashedPlaces', 'PlaceController@trashedPlaces')->name('places.trashed');
    Route::post('/addPlaceWithExcel', 'PlaceController@addPlaceWithExcel')->name('places.addPlaceWithExcel');

    Route::get('/placeMedia/{place_id}', 'PlaceController@placeMedia')->name('places.media');
    Route::resource('/placesMedia', 'PlaceMediaController')->except('create', 'index');
    Route::get('/placeCreateMedia/{place_id}', 'PlaceMediaController@create')->name('places.media.create');
    Route::get('/trashedPlaceMedia/{place_id}', 'PlaceMediaController@trashedPlaceMedia')->name('places.media.trashed');
    Route::get('/restorePlaceMedia/{media_id}', 'PlaceMediaController@restorePlaceMedia')->name('places.media.restore');
    Route::get('/setMain/{media_id}', 'PlaceMediaController@setMain')->name('places.media.main');
    Route::get('/setPlaceBranchMain/{place_branch_id}', 'PlaceBranchController@setPlaceBranchMain')->name('setPlaceBranchMain');

    Route::resource('/placesBranch', 'PlaceBranchController')->except('create', 'index');
    Route::get('/placeCreateBranch/{place_id}', 'PlaceBranchController@create')->name('places.branch.create');
    Route::get('/placeBranchAddAddress/{place_branch_id}', 'PlaceBranchController@addAddress')->name('places.branch.addAddress');
    Route::get('/trashedPlaceBranches/{place_id}', 'PlaceBranchController@trashedPlaceBranches')->name('places.branch.trashed');
    Route::get('/restorePlaceBranch/{place_branch_id}', 'PlaceBranchController@restorePlaceBranch')->name('places.branch.restore');

    Route::resource('/placesBranch', 'PlaceBranchController');
    Route::get('/trashedPlaceBranches/{place_id}', 'PlaceBranchController@trashedPlaceBranches')->name('places.branch.trashed');
    Route::get('/restorePlaceBranch/{place_branch_id}', 'PlaceBranchController@restorePlaceBranch')->name('places.branch.restore');
    Route::get('/deleteDetail/{detail_id}', 'PlaceBranchController@deleteDetail')->name('places.branch.deleteDetail');

    Route::resource('/categories', 'CategoriesController')->except('index', 'create');
    Route::get('/categories/index/{category_id}', 'CategoriesController@index')->name('categories.index');
    Route::get('/categories/create/{category_id}', 'CategoriesController@create')->name('categories.create');
    Route::get('/trashedCategories/{category_id}', 'CategoriesController@trashedCategories')->name('categories.trashed');
    Route::get('/restoreCategories/{category_id}', 'CategoriesController@restoreCategories')->name('categories.restore');

    Route::post('/addPicture', 'HomeController@addPicture')->name('addPicture');
    Route::get('/getCitiesForMap', 'HomeController@getCitiesForMap')->name('getCitiesForMap');
    Route::post('/addMarker', 'HomeController@addMarker')->name('addMarker');
    Route::post('/updateMarker', 'HomeController@updateMarker')->name('updateMarker');

    Route::resource('/exceptionWorkingDays', 'ExceptionWorkingDaysController')->except('index', 'create');
    Route::get('/exceptionWorkingDaysIndex/{branch_id}', 'ExceptionWorkingDaysController@index')->name('exceptionWorkingDays.index');
    Route::get('/exceptionWorkingDaysCreate/{branch_id}', 'ExceptionWorkingDaysController@create')->name('exceptionWorkingDays.create');
    Route::get('/restoreExceptionWorkingDay/{exceptionWorkingDay}', 'ExceptionWorkingDaysController@restoreExceptionWorkingDay')->name('exceptionWorkingDays.restore');
    Route::get('/trashedExceptionWorkingDays/{branch_id}', 'ExceptionWorkingDaysController@trashedExceptionWorkingDays')->name('exceptionWorkingDays.trashed');

    Route::resource('/weekDays', 'weekDaysController')->except('show');
    Route::get('/restoreWeekDay/{week_day_id}', 'weekDaysController@restoreWeekDay')->name('weekDays.restore');
    Route::get('/trashedWeekDays', 'weekDaysController@trashedWeekDays')->name('weekDays.trashed');

    Route::resource('/packages', 'PackagesController')->except('show');
    Route::get('/restorePackage/{package_id}', 'PackagesController@restorePackage')->name('packages.restore');
    Route::get('/trashedPackages', 'PackagesController@trashedPackages')->name('packages.trashed');

    Route::resource('/roles', 'RolesController')->except('show');
    Route::get('/restoreRole/{role_id}', 'RolesController@restoreRole')->name('roles.restore');
    Route::get('/trashedRoles', 'RolesController@trashedRoles')->name('roles.trashed');
    Route::get('/rolePermissions/{role_id}', 'RolesController@rolePermissions')->name('roles.permissions');
    Route::get('/userRoles/{user_id}', 'RolesController@userRoles')->name('roles.user');
    Route::get('/userPermissions/{user_id}', 'RolesController@userPermissions')->name('roles.permissions.user');
    Route::get('/addRoleToUser/{user_id}/{role_id}/{status}', 'RolesController@addRoleToUser');
    Route::get('/addPermissionToUser/{user_id}/{permission_id}/{status}', 'RolesController@addPermissionToUser');
    Route::get('/addPermissionToRole/{role_id}/{permission_id}/{status}', 'RolesController@addPermissionToRole');

    Route::get('/addNewPermission/{permission}', 'permissionsController@addNewPermission');

    Route::get('/addNewRole/{role}', 'permissionsController@addNewRole');
    Route::get('/addAllPermissionsToRole/{role_id}', 'permissionsController@addAllPermissionsToRole');
    Route::get('/addRoleToUser/{user_id}', 'permissionsController@addRoleToUser');
    Route::get('/addPermissionToUser/{user_id}/{permission_id}', 'permissionsController@addPermissionToUser');

    Route::get('logout', function () {
        \Illuminate\Support\Facades\Auth::logout();
        return redirect('/login');
    })->name('logoutGet');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
