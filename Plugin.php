<?php namespace Inerba\Colors;

use Backend;
use System\Classes\PluginBase;
use Inerba\Colors\Classes\ColorBase;

/**
 * Colors Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'Colors',
            'description' => 'No description provided yet...',
            'author'      => 'Inerba',
            'icon'        => 'icon-leaf'
        ];
    }

    public function registerMarkupTags()
    {
        return [
            'functions' => [
                'color_lighten'       => [ColorBase::class, 'lighten'],
                'color_darken'        => [ColorBase::class, 'darken'],
                'color_isLight'       => [ColorBase::class, 'isLight'],
                'color_isDark'        => [ColorBase::class, 'isDark'],
                'color_complementary' => [ColorBase::class, 'complementary'],
                'color_greyscale'     => [ColorBase::class, 'greyscale'],
                'color_desaturate'    => [ColorBase::class, 'desaturate'],
                'color_mix'           => [ColorBase::class, 'mix'],
                'color_random'        => [ColorBase::class, 'random'],
                'color_gradient'      => [ColorBase::class, 'gradient'],

                'color_extract'       => [ColorBase::class, 'extract'],
                'color_imgLight'      => [ColorBase::class, 'imgLight'],
                
                'color_imageInfo'     => [ColorBase::class, 'imageInfo'],
                'color_rgbToHex'      => [ColorBase::class, 'rgbToHex'],
                'color_hexToRgb'      => [ColorBase::class, 'hexToRgb'],
            ]
        ];
    }

}
