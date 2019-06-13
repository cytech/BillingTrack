<?php

Route::get('tasks/run', ['uses' => 'BT\Modules\Tasks\Controllers\TaskController@run', 'as' => 'tasks.run']);
