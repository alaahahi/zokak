<?php

namespace App\Widgets;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Widgets\BaseDimmer;
use App\Models\Governorate;

class GovernorateDimmer extends BaseDimmer
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
        $count = Governorate::count();
        $string = trans_choice('Governorate', $count);

        return view('voyager::dimmer', array_merge($this->config, [
            'icon'   => 'voyager-news',
            'title'  => "{$count} {$string}",
            'text'   => "Click on button below to view all Governorate.",
            'button' => [
                'text' => __('view all Governorate'),
                'link' => "/admin/governorate",
            ],
            'image' => 'images/11.jpg',
        ]));
    }



}
