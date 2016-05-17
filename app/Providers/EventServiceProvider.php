<?php

namespace gestiune_cimitire\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use gestiune_cimitire\Concesiune;
use gestiune_cimitire\Tarif;
use gestiune_cimitire\Rata;
use gestiune_cimitire\Cimitir;
use gestiune_cimitire\Tip;
use gestiune_cimitire\Parcela;
use gestiune_cimitire\Persoana;
use gestiune_cimitire\Loc; 

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
        Cimitir::deleting(function ($cimitir) {
            foreach ($cimitir->parcele()->get() as $parcela) {
                $parcela->delete();
            };
        });
        Cimitir::restoring(function ($cimitir) {
            foreach ($cimitir->parcele()->get() as $parcela) {
                $parcela->restore();
            };
        });
        Parcela::deleting(function ($parcela) {
            foreach ($parcela->locuri()->get() as $loc) {
                $loc->delete();
            };
        });
        Parcela::restoring(function ($parcela) {
            foreach ($parcela->locuri()->get() as $loc) {
                $loc->restore();
            };
        });
        Loc::deleting(function ($loc) {
            foreach ($loc->concesiuni()->get() as $concesiune) {
                $concesiune->delete();
            };
        });
        Loc::restoring(function ($loc) {
            foreach ($loc->concesiuni()->get() as $concesiune) {
                $concesiune->restore();
            };
        });
        Tarif::deleting(function ($tarif) {
            foreach ($tarif->rate()->get() as $rata) {
                $rata->delete();
            };
        });
        Tarif::restoring(function ($tarif) {
            foreach ($tarif->rate()->get() as $rata) {
                $rata->restore();
            };
        });
        Tip::deleting(function ($tip) {
            if ($tip->concesiuni->count()>0) {
                return false;
            }
        });
        Concesiune::created(function ($concesiune){
          $tarife=Tarif::where('an','>=',$concesiune->tarif->an)
                        ->where('an','<',$concesiune->tarif->an+$concesiune->durata)
                        ->get();
          foreach ($tarife as $tarif) {
             $rata=new Rata();
             $rata->tarif()->associate($tarif);
             $rata->concesiune()->associate($concesiune);
             $rata->save();
           
            }

        });
        //
        Tarif::created(function ($tarif) {
            $concesiuni=Concesiune::all();
            foreach($concesiuni as $concesiune){
                if ( ( $concesiune->tarif->an <= $tarif->an) && 
                    (($concesiune->tarif->an + $concesiune->durata) > $tarif->an)  ) 
                {
                    $rata=new Rata();
                    $rata->tarif()->associate($tarif);
                    $rata->concesiune()->associate($concesiune);
                    $rata->save();
                }
            }

        });
        Tarif::deleted(function ($tarif) {
            foreach ($tarif->rate()->get() as $rata) {
                $rata->delete();
            }
        });


    }
}
