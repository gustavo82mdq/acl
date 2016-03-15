<?php

use \Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web', 'role:admin']], function(){
    /**
     * Users routes
     */
    Route::resource('user', 'UsersController', ['only' => [
        'index', 'create', 'store', 'edit', 'update', 'destroy'
    ]]);

    /**
     * Roles routes
     */
    Route::resource('role', 'RolesController', ['only' => [
        'index', 'create', 'store', 'edit', 'update', 'destroy'
    ]]);

    /**
     * ACL
     */
    Route::get('/acl', ['as' => 'acl.index', 'uses' => 'AclController@index']);
    Route::post('/acl/set/{action}/{role}', ['as' => 'acl.setpermission', 'uses' => 'AclController@setPermission']);
    Route::post('/acl/unset/{action}/{role}', ['as' => 'acl.unsetpermission', 'uses' => 'AclController@unsetPermission']);
    Route::post('/acl/setAll/{role}', ['as' => 'acl.setall', 'uses' => 'AclController@setAll']);
    Route::post('/acl/unsetAll/{role}', ['as' => 'acl.unsetall', 'uses' => 'AclController@unsetAll']);
});