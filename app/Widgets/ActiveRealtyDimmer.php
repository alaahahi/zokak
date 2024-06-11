<?php

namespace App\Widgets;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Widgets\BaseDimmer;
use App\Models\Realty;

class ActiveRealtyDimmer extends BaseDimmer
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
        $count = Realty::where('is_active','1')->count();
        $string = trans_choice('Active Realty', $count);

        return view('voyager::dimmer', array_merge($this->config, [
            'icon'   => 'voyager-check',
            'title'  => "{$count} {$string}",
            'text'   => "Click on button below to view all Realty now.",
            'button' => [
                'text' => __('view all realty'),
                'link' => "/admin/realty",
            ],
            'image' => 'images/07.jpg',
        ]));
    }



}
