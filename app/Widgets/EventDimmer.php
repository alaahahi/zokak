<?php

namespace App\Widgets;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Widgets\BaseDimmer;
use App\Models\Event;

class EventDimmer extends BaseDimmer
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
        $count = Event::count();
        $string = trans_choice('Event', $count);

        return view('voyager::dimmer', array_merge($this->config, [
            'icon'   => 'voyager-params',
            'title'  => "{$count} {$string}",
            'text'   => "Click on button below to view all event.",
            'button' => [
                'text' => __('view all event'),
                'link' => "/admin/event",
            ],
            'image' => 'images/05.jpg',
        ]));
    }



}
