<?php

namespace gestiune_cimitire\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use gestiune_cimitire\Concesiune;
use gestiune_cimitire\Tarif;
use gestiune_cimitire\Rata;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'gestiune_cimitire\Events\SomeEvent' => [
            'gestiune_cimitire\Listeners\EventListener',
        ],
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        //
        Concesiune::saved(function ($concesiune){
            //
            $tarife=Tarif::where('an','>=',$concesiune->tarif->an)->get();
            foreach ($tarife as $tarif) {
                $rata=new Rata();
                $tarif->rate()->save($rata);
                $concesiune->rate()->save($rata);
            }

        });
    }
}
