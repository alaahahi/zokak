<?php

namespace App\Widgets;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Widgets\BaseDimmer;
use App\Models\Event;
use Carbon\Carbon;

class WeekendEventsDimmer extends BaseDimmer
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {

        $dt = Carbon::now();
        $count = Event::whereDate('start',$dt->next('Friday')->format('Y-m-d'))
        ->accepted()->count();
        $string = trans_choice('Weekend Events', $count);

        return view('voyager::dimmer', array_merge($this->config, [
            'icon'   => 'voyager-github',
            'title'  => "{$count} {$string}",
            'text'   => "Click on button below to view all Weekend events now.",
            'button' => [
                'text' => __('view all Weekend'),
                'link' => "/admin/event",
            ],
            'image' => 'images/15.jpg',
        ]));
    }



}
