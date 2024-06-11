<?php

namespace App\Widgets;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Widgets\BaseDimmer;
use TCG\Voyager\Models\Setting;

class AutoAcceptedDimmer extends BaseDimmer
{
    /**setting('admin.auto_accepted_realties')
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
        $is_auto = Setting::firstOrNew(['key' =>'admin.auto_accepted_realties'])->value ;
        if($is_auto ){
            $string = 'Auto Accepte Realties Active' ;
        }
        else{
            $string = 'Auto Accepte Reltys Not Active' ;
        }
        return view('voyager::dimmer', array_merge($this->config, [
            'icon'   => 'voyager-ticket',
            'title'  => "{$string}",
            'text'   => "Click on button below to view all Realtys now.",
            'button' => [
                'text' => __('view all Realtys'),
                'link' => "/admin/realty",
            ],
            'image' => voyager_asset('images/widget-backgrounds/02.jpg'),
        ]));
    }



}
