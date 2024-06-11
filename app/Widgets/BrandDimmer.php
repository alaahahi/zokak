<?php

namespace App\Widgets;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Widgets\BaseDimmer;
use App\Models\Brand;

class BrandDimmer extends BaseDimmer
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
        $count = Brand::count();
        $string = trans_choice('Brands', $count);

        return view('voyager::dimmer', array_merge($this->config, [
            'icon'   => 'voyager-shop',
            'title'  => "{$count} {$string}",
            'text'   => "Click on button below to view all brand.",
            'button' => [
                'text' => __('view all brand'),
                'link' => "/admin/brand",
            ],
            'image' => 'images/04.jpg',
        ]));
    }



}
