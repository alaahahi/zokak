<?php

namespace App\Widgets;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Widgets\BaseDimmer;
use App\Models\Event;

class FeaturedEventsDimmer extends BaseDimmer
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
        $count = Event::where('featured','1')->count();
        $string = trans_choice('Featured Events', $count);

        return view('voyager::dimmer', array_merge($this->config, [
            'icon'   => 'voyager-star-half',
            'title'  => "{$count} {$string}",
            'text'   => "Click on button below to view all featured events now.",
            'button' => [
                'text' => __('view all featured'),
                'link' => "/admin/event",
            ],
            'image' => 'images/12.jpg',
        ]));
    }



}
