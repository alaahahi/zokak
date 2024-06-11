<?php

namespace App\Widgets;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Widgets\BaseDimmer;
use App\Models\Event;
use Carbon\Carbon;

class TodayEventsDimmer extends BaseDimmer
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
        $count = Event::whereDate('start',Carbon::today()->toDateString())
        ->accepted()
        ->count();

        $string = trans_choice('Today Events', $count);

        return view('voyager::dimmer', array_merge($this->config, [
            'icon'   => 'voyager-bomb',
            'title'  => "{$count} {$string}",
            'text'   => "Click on button below to view all today events now.",
            'button' => [
                'text' => __('view all today'),
                'link' => "/admin/event",
            ],
            'image' => 'images/13.jpg',
        ]));
    }



}
