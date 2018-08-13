<?php
    Route::group(['prefix' => 'admin/', 'as' => 'admin.'], function () {
//        Route::any('', ['as' => 'dashboard', 'uses' => 'Admin\DashboardController@getIndex']);

        $sections = [
            'users' => ['list', 'add', 'edit', 'delete'],
        ];

        foreach($sections as $section => $actions){
            Route::group(['prefix' => $section.'/', 'as' => $section.'.'], function () use ($section, $actions){
                if(in_array('list', $actions)){
                    Route::get('', ['as' => 'list', 'uses' => 'Admin\\'.ucfirst($section). 'Controller@getIndex']);
                }
                if(in_array('add', $actions)){
                    Route::get('add', ['as' => 'add', 'uses' => 'Admin\\'.ucfirst($section) . 'Controller@getAdd']);
                    Route::post('add', ['as' => 'create', 'uses' => 'Admin\\'.ucfirst($section) . 'Controller@postSave']);
                }
                if(in_array('edit', $actions)){
                    Route::any('{'.str_singular($section).'}/edit', ['as' => 'edit', 'uses' => 'Admin\\'.ucfirst($section).'Controller@getEdit']);
                    Route::post('{'.str_singular($section).'}/update', ['as' => 'update', 'uses' => 'Admin\\'.ucfirst($section).'Controller@postSave']);
                } elseif(in_array('update', $actions)){
                    Route::post('/update', ['as' => 'update', 'uses' => 'Admin\\'.ucfirst($section).'Controller@postSave']);
                }
            });
        }
    });
