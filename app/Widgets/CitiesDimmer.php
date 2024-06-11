<?php

namespace App\Widgets;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Widgets\BaseDimmer;
use App\Models\City;

class CitiesDimmer extends BaseDimmer
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
        $count = City::count();
        $string = trans_choice('Cities', $count);

        return view('voyager::dimmer', array_merge($this->config, [
            'icon'   => 'voyager-location',
            'title'  => "{$count} {$string}",
            'text'   => "Click on button below to view all Cities now.",
            'button' => [
                'text' => __('view all Cities'),
                'link' => "/admin/city",
            ],
            'image' =>'images/06.jpg',
        ]));
    }



}
