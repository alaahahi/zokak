<?php

namespace App\Widgets;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Widgets\BaseDimmer;
use App\Models\Brand;

class SponsorsBrandsDimmer  extends BaseDimmer
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
        $count = Brand::where('is_sponsors','1')->count();
        $string = trans_choice('Sponsors Brands', $count);

        return view('voyager::dimmer', array_merge($this->config, [
            'icon'   => 'voyager-diamond',
            'title'  => "{$count} {$string}",
            'text'   => "Click on button below to view all sponsors brands now.",
            'button' => [
                'text' => __('view all brands'),
                'link' => "/admin/brand",
            ],
            'image' => 'images/11.jpg',
        ]));
    }



}
