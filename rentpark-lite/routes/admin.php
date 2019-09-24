<?php

 
Route::group(['middleware' => 'web'], function() {

    Route::group(['as' => 'admin.', 'prefix' => 'admin'], function() {

        Route::get('/clear-cache', function() {

            $exitCode = Artisan::call('config:cache');

            return back();

        })->name('clear-cache');

        Route::get('login', 'Auth\AdminLoginController@showLoginForm')->name('login');

        Route::post('login', 'Auth\AdminLoginController@login')->name('login.post');

        Route::post('logout', 'Auth\AdminLoginController@logout')->name('logout');

        Route::get('/', 'AdminController@index')->name('dashboard');


        /***
         *
         * Users management
         *
         */       
        Route::get('/users/index', 'AdminController@users_index')->name('users.index');

        Route::get('/users/create', 'AdminController@users_create')->name('users.create');

        Route::get('/users/edit', 'AdminController@users_edit')->name('users.edit');

        Route::post('/users/save', 'AdminController@users_save')->name('users.save');

        Route::get('/users/view', 'AdminController@users_view')->name('users.view');

        Route::get('/users/delete/{user_id}', 'AdminController@users_delete')->name('users.delete');

        Route::get('/users/status/{user_id}', 'AdminController@users_status')->name('users.status');


        /***
         *
         * Providers management
         *
         */       
        Route::get('/providers/index', 'AdminController@providers_index')->name('providers.index');

        Route::get('/providers/create', 'AdminController@providers_create')->name('providers.create');

        Route::get('/providers/edit/{id}', 'AdminController@providers_edit')->name('providers.edit');

        Route::match(array('PUT','POST'),'/providers/save/{id?}', 'AdminController@providers_save')->name('providers.save');

        Route::get('/providers/view/{id}', 'AdminController@providers_view')->name('providers.view');

        Route::get('/providers/delete/{id}', 'AdminController@providers_delete')->name('providers.delete');
        
        Route::get('/providers/status/{id}', 'AdminController@providers_status')->name('providers.status');


        /***
         *
         * Service Locations management
         *
         */       
        Route::get('/locations/index', 'AdminController@service_locations_index')->name('service_locations.index');

        Route::get('/locations/create', 'AdminController@service_locations_create')->name('service_locations.create');

        Route::get('/locations/edit/{id}', 'AdminController@service_locations_edit')->name('service_locations.edit');

        Route::post('/locations/save', 'AdminController@service_locations_save')->name('service_locations.save');

        Route::get('/locations/view/{id}', 'AdminController@service_locations_view')->name('service_locations.view');

        Route::get('/locations/delete/{id}', 'AdminController@service_locations_delete')->name('service_locations.delete');


        Route::get('/locations/status/{id}', 'AdminController@service_locations_status')->name('service_locations.status');
        
        /***
         *
         * Hosts management
         *
         */       
        Route::get('/hosts/index', 'AdminController@hosts_index')->name('hosts.index');

        Route::get('/hosts/create', 'AdminController@hosts_create')->name('hosts.create');

        Route::get('/hosts/edit/{id}', 'AdminController@hosts_edit')->name('hosts.edit');

        Route::post('/hosts/save', 'AdminController@hosts_save')->name('hosts.save');

        Route::get('/hosts/view/{id}', 'AdminController@hosts_view')->name('hosts.view');

        Route::get('/hosts/delete/{id}', 'AdminController@hosts_delete')->name('hosts.delete');

        Route::get('/hosts/status/{id}', 'AdminController@hosts_status')->name('hosts.status');

         /***
         *
         * Static pages management
         *
         */       
        Route::get('/static_pages/index', 'AdminController@static_pages_index')->name('static_pages.index');

        Route::get('/static_pages/create', 'AdminController@static_pages_create')->name('static_pages.create');

        Route::get('/static_pages/edit', 'AdminController@static_pages_edit')->name('static_pages.edit');

        Route::post('/static_pages/save', 'AdminController@static_pages_save')->name('static_pages.save');

        Route::get('/static_pages/view/{id}', 'AdminController@static_pages_view')->name('static_pages.view');

        Route::get('/static_pages/delete/{id}', 'AdminController@static_pages_delete')->name('static_pages.delete');

        Route::get('/static_pages/status/{id}', 'AdminController@static_pages_status')->name('static_pages.status');
        

        /***
         *
         * Booking management
         *
         */       
        Route::get('/bookings/index', 'AdminController@bookings_index')->name('bookings.index');

        Route::get('/bookings/view/{id}', 'AdminController@bookings_view')->name('bookings.view');



        /***
         *
         * Settings
         *
         */ 
        Route::get('/settings/index', 'AdminController@settings_index')->name('settings.index');

        Route::post('/settings/save', 'AdminController@settings_save')->name('settings.save');


        # admin profile

        Route::get('/profile/view', 'AdminController@admin_profile_view')->name('profile.view');

        Route::post('/profile/save', 'AdminController@admin_profile_save')->name('profile.save');

        Route::get('/profile/edit', 'AdminController@admin_profile_edit')->name('profile.edit');

        Route::get('/profile/password', 'AdminController@change_password')->name('profile.password');

        Route::post('/profile/password','AdminController@change_password_save')->name('profile.password');



    });

});
