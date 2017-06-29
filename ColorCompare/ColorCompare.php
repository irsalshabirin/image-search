<?php
error_reporting(E_ERROR | E_PARSE);
// Filename: ColorCompare.php
// Copyright (C) Chris Gosling 2011

class ColorCompare {

    // max width and height for testing and resampling
    static private $resize_dim = 512;
    // define colour swatches
//    static public $swatches = array(
//        "WHITE" => "FFFFFF",
//        "CREAM" => "F2EAC6",
//        "YELLOW" => "F8E275",
//        "ORANGE" => "FA9A4D",
//        "PEACH" => "F9A986",
//        "PINK" => "FAACA8",
//        "MANGENTA" => "FC6D99",
//        "RED" => "FF0000",
//        "BURGANDY" => "AC2424",
//        "PURPLE" => "A746B1",
//        "LAVENDER" => "C791F1",
//        "LIGHT_BLUE" => "A4A6FD",
//        "DARK_BLUE" => "1D329D",
//        "TURQUIOSE" => "2CCACD",
//        "AQUA" => "9CD8F4",
//        "DARK_GREEN" => "62854F",
//        "LIGHT_GREEN" => "A9CB6C",
//        "TAN" => "CAB775",
//        "BROWN" => "815B10",
//        "GRAY" => "777777",
//        "BLACK" => "000000"
//    );
    
    static public $swatches = array(
        "1" => "660000",
        "2" => "990000",
        "3" => "CC0000",
        "4" => "CC3333",
        "5" => "EA4C88",
        "6" => "993399",
        "7" => "663399",
        "8" => "333399",
        "9" => "0066CC",
        "10" => "0099CC",
        "11" => "66CCCC",
        "12" => "77CC33",
        "13" => "669900",
        "14" => "336600",
        "15" => "666600",
        "16" => "999900",
        "17" => "CCCC33",
        "18" => "FFFF00",
        "19" => "FFCC33",
        "20" => "FF9900",
        "21" => "FF6600",
        "22" => "CC6633",
        "23" => "996633",
        "24" => "663300",
        "25" => "000000",
        "26" => "999999",
        "27" => "CCCCCC",
        "28" => "FFFFFF",
        "29" => "E7D8B1",
        "30" => "FDADC7",
        "31" => "424153",
        "32" => "ABBCDA",
        "33" => "F5DD01"
    );
    
//    static public $swatches = array(
//        "1" => "000000",
//        "2" => "000040",
//        "3" => "000080",
//        "4" => "0000C0",
//        "5" => "0000FF",
//        
//        "6" => "00C000",
//        "7" => "00C040",
//        "8" => "00C080",
//        "9" => "00C0C0",
//        "10" => "00C0FF",
//        
//        "11" => "400000",
//        "12" => "400040",
//        "13" => "400080",
//        "14" => "4000C0",
//        "15" => "4000FF",
//        
//        "16" => "40C000",
//        "17" => "40C040",
//        "18" => "40C080",
//        "19" => "40C0C0",
//        "20" => "40C0FF",
//        
//        "21" => "800000",
//        "22" => "800040",
//        "23" => "800080",
//        "24" => "8000C0",
//        "25" => "8000FF",
//        
//        "26" => "80C000",
//        "27" => "80C040",
//        "28" => "80C080",
//        "29" => "80C0C0",
//        "30" => "80C0FF",
//        
//        "31" => "C00000",
//        "32" => "C00040",
//        "33" => "C00080",
//        "34" => "C000C0",
//        "35" => "C000FF",
//        
//        "36" => "C0C000",
//        "37" => "C0C040",
//        "38" => "C0C080",
//        "39" => "C0C0C0",
//        "40" => "C0C0FF",
//        
//        "41" => "FF0000",
//        "42" => "FF0040",
//        "43" => "FF0080",
//        "44" => "FF00C0",
//        "45" => "FF00FF",
//        
//        "46" => "FFC000",
//        "47" => "FFC040",
//        "48" => "FFC080",
//        "49" => "FFC0C0",
//        "50" => "FFC0FF",
//        
//        "51" => "004000",
//        "52" => "004040",
//        "53" => "004080",
//        "54" => "0040C0",
//        "55" => "0040FF",
//        
//        "56" => "00FF00",
//        "57" => "00FF40",
//        "58" => "00FF80",
//        "59" => "00FFC0",
//        "60" => "00FFFF",
//        
//        "61" => "404000",
//        "62" => "404040",
//        "63" => "404080",
//        "64" => "4040C0",
//        "65" => "4040FF",
//        
//        "66" => "40FF00",
//        "67" => "40FF40",
//        "68" => "40FF80",
//        "69" => "40FFC0",
//        "70" => "40FFFF",
//        
//        "71" => "804000",
//        "72" => "804040",
//        "73" => "804080",
//        "74" => "8040C0",
//        "75" => "8040FF",
//        
//        "76" => "80FF00",
//        "77" => "80FF40",
//        "78" => "80FF80",
//        "79" => "80FFC0",
//        "80" => "80FFFF",
//        
//        "81" => "C04000",
//        "82" => "C04040",
//        "83" => "C04080",
//        "84" => "C040C0",
//        "85" => "C040FF",
//        
//        "86" => "C0FF00",
//        "87" => "C0FF40",
//        "88" => "C0FF80",
//        "89" => "C0FFC0",
//        "90" => "C0FFFF",
//        
//        "91" => "FF4000",
//        "92" => "FF4040",
//        "93" => "FF4080",
//        "94" => "FF40C0",
//        "95" => "FF40FF",
//        
//        "96" => "FFFF00",
//        "97" => "FFFF40",
//        "98" => "FFFF80",
//        "99" => "FFFFC0",
//        "100" => "FFFFFF",
//        
//        "101" => "008000",
//        "102" => "008040",
//        "103" => "008080",
//        "104" => "0080C0",
//        "105" => "0080FF",
//        
//        "106" => "408000",
//        "107" => "408040",
//        "108" => "408080",
//        "109" => "4080C0",
//        "110" => "4080FF",
//        
//        "111" => "808000",
//        "112" => "808040",
//        "113" => "808080",
//        "114" => "8080C0",
//        "115" => "8080FF",
//        
//        "116" => "C08000",
//        "117" => "C08040",
//        "118" => "C08080",
//        "119" => "C080C0",
//        "120" => "C080FF",
//        
//        "121" => "FF8000",
//        "122" => "FF8040",
//        "123" => "FF8080",
//        "124" => "FF80C0",
//        "125" => "FF80FF",
//    );
//    
    // this will be the swatch index for each color		
    // eg: $swatch_index[0] = "WHITE" and so on														
    static private $swatch_index;
    // this image contains the palette the test image will be compared to																	
    static private $comp_palette = false;
    // percentage that colour needs to reach of total
    // pixels for colour to be considered significant
    static public $threshold_filter = 5;

    // ------------------------------------------------------
    // ACCEPTS: max number of colours to return
    // 					filename of image
    //					comparison method id
    //						1 = resize method
    // RETURNS: array (up to max_colors) containing indexed with the color 
    //						name and
    //					the value will be the pixel count in order of highest to 
    //						lowest pixels
    //					eg: "TAN" => 1000, "PINK" => 800, "MAGENTA" => 600
    //					or false if failed
    static public function compare($max_colors, $filename) {
        
        $tally = array();

        // size image to something managable (256 x 256)
        $image_data = getimagesize($filename);

        // if small image then use its current size
//        if ($image_data[0] < self::$resize_dim && $image_data[1] < self::$resize_dim) {
        $image = self::createImage($filename, $image_data[2]);
        $width = $image_data[0];
        $height = $image_data[1];
//        } else {  // resize the image
//            $res = self::createResizedImage($filename, $image_data[0], $image_data[1], $image_data[2]);
//
//            if ($res == false) {
//                print "[failed on resize]";
//                return false;
//            } else {
//                $image = $res[0];
//                $width = $res[1];
//                $height = $res[2];
//            }
//        }
        // create the comparison palette
        self::createComparisonPalette();

        // loop through x axis
        for ($x = 0; $x < $width; $x++) {
            // loop through y axis
            for ($y = 0; $y < $height; $y++) {
                // compare to find colest match and tally
                list($red, $green, $blue) = self::getRGBFromPixel($image, $x, $y);
                
                $index = imagecolorclosest(self::$comp_palette, $red, $green, $blue);
                
                $tally[$index] = $tally[$index] + 1;
//                var_dump($tally);
//                die();
            }
        }

        // sort the tally results
        arsort($tally);
        $ret_array = array();
        $i = 0;
        $threshold = ($width * $height) * (self::$threshold_filter / 100);

        // build the return array of the top results
        foreach ($tally as $index => $count) {
            // make sure the count is high enough to be considered significant
            if ($count >= $threshold) {
                $ret_array[self::$swatch_index[$index]] = $count;
                $i++;
            } else
                break;

            if ($i >= $max_colors)
                break;
        }

        return $ret_array;
    }

    // --------------------------------------------------------
    // ACCEPTS: image resource
    //					x/y coordinate
    // RETURNS: array contain red, green, blue value of pixel	
    static private function getRGBFromPixel($image, $x, $y) {
        $rgb = imagecolorat($image, $x, $y);
        $red = ($rgb >> 16) & 0xFF;
        $green = ($rgb >> 8) & 0xFF;
        $blue = $rgb & 0xFF;
        return array($red, $green, $blue);
    }

    // -------------------------------------------------------
    // Creates the comparison palette if not already created
    static private function createComparisonPalette() {
        if (self::$comp_palette === false) {
            $swatch_index = array();
            self::$comp_palette = imagecreate(16, 16);
//            var_dump(self::$comp_palette);
            foreach (self::$swatches as $name => $hex) {
                $color = self::hexToRGB($hex);
                $index = imagecolorallocate(self::$comp_palette, $color['red'], $color['green'], $color['blue']);
                self::$swatch_index[$index] = $name;
            }
        }
    }

    // ------------------------------------------------------
    // ACCEPTS: hex color value without the # (eg: FF0000)
    // RETURNS: associative array with values for ref, green and blue
    static private function hexToRGB($hexStr) {
        $colorVal = hexdec($hexStr);
        $rgbArray['red'] = 0xFF & ($colorVal >> 0x10);
        $rgbArray['green'] = 0xFF & ($colorVal >> 0x8);
        $rgbArray['blue'] = 0xFF & $colorVal;
        return $rgbArray;
    }

    // ------------------------------------------------------
    // ACCEPTS: filename of input image, 
    //					original width and height of image
    //					type of image
    // RETURNS: resized image or false if failed
    static private function createResizedImage($filename, $width, $height, $type) {
        // create image from file
        $image = self::createImage($filename, $type);

        if (!$image)
            return false;

        //calculate dimensions based on smallest size
        $new_width = $width < self::$resize_dim ? $width : self::$resize_dim;
        $new_height = $height < self::$resize_dim ? $height : self::$resize_dim;

        // create resampled image
        $new_image = imagecreatetruecolor($new_width, $new_height);

        if ($new_image === false)
            return false;

        if (imagecopyresampled($new_image, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height))
            return array($new_image, $new_width, $new_height);
        else
            return false;
    }

    // ---------------------------------------------------
    // Creates an image object for the supplied image file and type
    // ACCEPTS: the filename of the image and the image type
    // RETURNS: image object
    static private function createImage($filename, $image_type) {
        // determine image type
        switch ($image_type) {
            case IMAGETYPE_GIF:
                $image = imagecreatefromgif($filename);
                break;

            case IMAGETYPE_JPEG:
                $image = imagecreatefromjpeg($filename);
                break;

            case IMAGETYPE_PNG:
                $image = imagecreatefrompng($filename);
                break;

            default:
                return false;
        }

        return $image;
    }

}

?>