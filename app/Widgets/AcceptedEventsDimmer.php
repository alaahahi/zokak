<?php

namespace App\Widgets;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Widgets\BaseDimmer;
use App\Models\Event;

class AcceptedEventsDimmer extends BaseDimmer
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
        $count = Event::where('is_accepted','1')->count();
        $string = trans_choice('Accepted Events', $count);

        return view('voyager::dimmer', array_merge($this->config, [
            'icon'   => 'voyager-check',
            'title'  => "{$count} {$string}",
            'text'   => "Click on button below to view all events now.",
            'button' => [
                'text' => __('view all events'),
                'link' => "/admin/event",
            ],
            'image' => 'images/10.jpg',
        ]));
    }



}
