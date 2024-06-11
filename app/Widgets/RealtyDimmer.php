<?php

namespace App\Widgets;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Widgets\BaseDimmer;
use App\Models\Realty;

class RealtyDimmer extends BaseDimmer
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
        $count = Realty::count();
        $string = trans_choice('Realtys', $count);

        return view('voyager::dimmer', array_merge($this->config, [
            'icon'   => 'voyager-ticket',
            'title'  => "{$count} {$string}",
            'text'   => "Click on button below to view all Realtys now.",
            'button' => [
                'text' => __('view all Realtys'),
                'link' => "/admin/realty",
            ],
            'image' =>'images/14.jpg',
        ]));
    }



}
