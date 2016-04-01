<?php

namespace gestiune_cimitire\Providers;

use Form;
use Illuminate\Support\ServiceProvider;

class FormMacroServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Form::macro(
    'groupSelect', 
    function ($name, $collection, $relation, $groupName = 'name', $optName = 'numar', $optValue = 'id', $selected = null, $attributes = []) 
    {

        $groups = [];

        foreach ($collection as $model)
        {
            $groups[$model->$groupName] = $model->$relation->lists($optName, $optValue);
        }

        return Form::select($name, $groups, $selected, $attributes);
    }
);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
