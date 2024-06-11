<?php

namespace App\Widgets;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Widgets\BaseDimmer;
use App\Models\Property;

class PropertyDimmer extends BaseDimmer
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
        $count = Property::count();
        $string = trans_choice('Property', $count);

        return view('voyager::dimmer', array_merge($this->config, [
            'icon'   => 'voyager-diamond',
            'title'  => "{$count} {$string}",
            'text'   => "Click on button below to view all Property.",
            'button' => [
                'text' => __('view all Property'),
                'link' => "/admin/property",
            ],
            'image' => 'images/12.jpg',
        ]));
    }



}
