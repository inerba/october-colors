<?php namespace Inerba\Colors\Classes;

use Cache;
use Mexitek\PHPColors\Color as PHPColors;
use Colorizer\Colorize;
use League\ColorExtractor\Color;
use League\ColorExtractor\ColorExtractor;
use League\ColorExtractor\Palette;

class ColorBase {

    public static function lighten($color, $percent=20)
    {
        $color = new PHPColors($color);
        return '#' . $color->lighten($percent);
    }

    public static function darken($color, $percent=20)
    {
        $color = new PHPColors($color);
        return '#' . $color->darken($percent);
    }

    public static function isLight($color)
    {
        $color = new PHPColors($color);
        return $color->isLight();
    }

    public static function isDark($color)
    {
        $color = new PHPColors($color);
        return $color->isDark();
    }

    public static function complementary($color)
    {
        $color = new PHPColors($color);
        return '#' . $color->complementary($color);
    }

    public static function greyscale($color)
    {
        $rgb = PHPColors::hexToRgb($color);

        $ds = $rgb['R'] * 0.3 + $rgb['G'] * 0.3 + $rgb['B'] * 0.3;

        return '#' . PHPColors::rgbToHex(['R'=>$ds,'G'=>$ds,'B'=>$ds]);

    }

    public static function desaturate($color,$saturation=20)
    {
        $hsl = PHPColors::hexToHsl($color);

        $saturation = $saturation/100;

        $hsl['S'] = $hsl['S'] - $saturation < 0 ? 0 : $hsl['S'] - $saturation;

        //dd($hsl,$saturation);

        return '#' . PHPColors::hslToHex($hsl);

    }

    public static function random($string=false,$normalize=false)
    {
        $colorize = new Colorize();

        if(!$string) $string = self::randomString();

        $color = $colorize->text($string);

        if(is_array($normalize)) {
            $color = $color->normalize($normalize[0], $normalize[1]);
        }

        return $color->hex();

    }

    public static function rgbToHex($r,$g,$b)
    {
        return '#' . PHPColors::rgbToHex(['R'=>$r,'G'=>$g,'B'=>$b]);
    }

    public static function hexToRgb($hex,$alpha=false)
    {
        $rgb = PHPColors::hexToRgb($hex);

        if($alpha) return "rgba({$rgb['R']},{$rgb['G']},{$rgb['B']},{$alpha});";
        
        return "rgb({$rgb['R']},{$rgb['G']},{$rgb['B']});";
    }

    public static function gradient($color,$steps=25,$old_browsers = true)
    {
        $color = new PHPColors($color);
        return $color->getCssGradient($steps,$old_browsers);
    }

    public static function mix($color,$color2, $amount = 50)
    {
        $color = new PHPColors($color);
        return '#' . $color->mix($color2, $amount);
    }

    public static function imageInfo($path,$palette_num=5,$num_samples=10,$threshold=170)
    {

        $key = 'colors-imageInfo'.$path.$palette_num.$num_samples;
        $info = Cache::rememberForever($key, function() use($path,$palette_num,$num_samples) {

            $filename = $path;

            $palette = Palette::fromFilename($filename);

            $extractor = new ColorExtractor($palette);
            $most_used_colors = $extractor->extract($palette_num);

            foreach ($most_used_colors as $colorInt) {
                $color[] = Color::fromIntToHex($colorInt);
            }

            $luminance = self::getluminance($filename, $num_samples);
            $color_palette = $color;
            
            return (object) [
                'palette'   => (object) $color,
                'luminance' => $luminance,
                'is_light'  => $luminance > $threshold ? true : false,
            ];
        });

        return $info;
    }

    public static function extract($path,$num=5)
    {
        $key = 'colors-extract'.$path.$num;
        $extract = Cache::rememberForever($key, function() use($path,$num) {
            $palette = Palette::fromFilename($path);
            //$most_used_colors = $palette->getMostUsedColors($num);
            $extractor = new ColorExtractor($palette);
            $most_used_colors = $extractor->extract($num);

            if($num >= 2){

                foreach ($most_used_colors as $colorInt) {
                    $color[] = Color::fromIntToHex($colorInt);
                }

            } else {
                $color = Color::fromIntToHex($most_used_colors[0]);
            }

            return $color;
        });

        return $extract;
    }

    public static function imgLight($filename,$num_samples=10,$threshold=170)
    {
        $key = 'colors-imgLight'.$filename.$num_samples;
        
        $luminance = Cache::rememberForever($key, function() use ($filename, $num_samples) {
            return self::getluminance($filename, $num_samples);
        });

        return $luminance > $threshold ? true : false;
    }

    /* outils */
    private static function getluminance($filename, $num_samples=10)
    {
        $img = imagecreatefromjpeg($filename);

        $width = imagesx($img);
        $height = imagesy($img);

        $x_step = intval($width/$num_samples);
        $y_step = intval($height/$num_samples);

        $total_lum = 0;

        $sample_no = 1;

        for ($x=0; $x<$width; $x+=$x_step) {
            for ($y=0; $y<$height; $y+=$y_step) {

                $rgb = imagecolorat($img, $x, $y);
                $r = ($rgb >> 16) & 0xFF;
                $g = ($rgb >> 8) & 0xFF;
                $b = $rgb & 0xFF;

                $lum = ($r+$r+$b+$g+$g+$g)/6;

                $total_lum += $lum;

                $sample_no++;
            }
        }

        // work out the average
        $avg_lum  = $total_lum/$sample_no;

        return $avg_lum;
    }

    private static function randomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

}