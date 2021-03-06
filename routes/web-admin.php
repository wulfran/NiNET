<?php
    Route::group(['prefix' => 'admin/', 'as' => 'admin.'], function () {
//        Route::any('', ['as' => 'dashboard', 'uses' => 'Admin\DashboardController@getIndex']);

        $sections = [
            'users' => ['list', 'add', 'edit', 'delete'],
            'companies' => ['list', 'add', 'edit', 'delete'],
            'invoices' => ['list', 'archive', 'add', 'edit', 'delete'],
            'timers' => ['list', 'delete', 'edit']
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
                if(in_array('delete', $actions)){
                    Route::get('{'.str_singular($section).'}/delete', ['as' => 'delete', 'uses' => 'Admin\\'.ucfirst($section).'Controller@postDelete']);
                }
                if(in_array('archive', $actions)){
                    Route::get('archive', ['as' => 'archive', 'uses' => 'Admin\\'.ucfirst($section). 'Controller@getArchive']);
                }
            });
        }
        Route::any('timers/toggle', ['as' => 'timers.toggle', 'uses' => 'Admin\TimersController@toggle']);
        Route::post('timers/process', ['as' => 'timers.process', 'uses' => 'Admin\TimersController@postProcess']);
        Route::get('timers/print', ['as' => 'timers.print', 'uses' => 'Admin\TimersController@printTimers']);
    });
