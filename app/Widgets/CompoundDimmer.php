<?php

namespace App\Widgets;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Widgets\BaseDimmer;
use App\Models\Compound;

class CompoundDimmer extends BaseDimmer
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
        $count = Compound::count();
        $string = trans_choice('Compound', $count);

        return view('voyager::dimmer', array_merge($this->config, [
            'icon'   => 'voyager-github',
            'title'  => "{$count} {$string}",
            'text'   => "Click on button below to view all Compound.",
            'button' => [
                'text' => __('view all Compound'),
                'link' => "/admin/compound",
            ],
            'image' => 'images/04.jpg',
        ]));
    }



}
