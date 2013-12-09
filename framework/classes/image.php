<?php
class image
{
public function crop($source_image, $target_image, $crop_area)
{
    $source_file_name  = basename($source_image);
    $source_image_type = substr($source_file_name, -3, 3);
    switch (strtolower($source_image_type)) {
        case 'jpg':
            $original_image = imagecreatefromjpeg($source_image);
            break;
        
        case 'gif':
            $original_image = imagecreatefromgif($source_image);
            break;
        
        case 'png':
            $original_image = imagecreatefrompng($source_image);
            break;
        
        default:
            return false;
    }
    $cropped_image = imagecreatetruecolor($crop_area['width'], $crop_area['height']);
    imagecopy($cropped_image, $original_image, 0, 0, $crop_area['left'], $crop_area['top'], $crop_area['width'], $crop_area['height']);
    $target_file_name  = basename($target_image);
    $target_image_type = substr($target_file_name, -3, 3);
    switch (strtolower($target_image_type)) {
        case 'jpg':
            imagejpeg($cropped_image, $target_image, 100);
            break;
        
        case 'gif':
            imagegif($cropped_image, $target_image);
            break;
        
        case 'png':
            imagepng($cropped_image, $target_image, 0);
            break;
        
        default:
            trigger_error('cropImage(): Invalid target image type', E_USER_ERROR);
            imagedestroy($cropped_image);
            imagedestroy($original_image);
            return false;
    }
    imagedestroy($cropped_image);
    imagedestroy($original_image);
    
    return true;
}
public function orientation($full_filename)
{
    $donr=null;
    $exif = exif_read_data($full_filename);
    if ($exif && isset($exif['Orientation'])) {
        $orientation = $exif['Orientation'];
        if ($orientation != 1) {
            $img = imagecreatefromjpeg($full_filename);
            
            $mirror = false;
            $deg    = 0;
            
            switch ($orientation) {
                case 2:
                    $mirror = true;
                    break;
                case 3:
                    $deg = 180;
                    break;
                case 4:
                    $deg    = 180;
                    $mirror = true;
                    break;
                case 5:
                    $deg    = 270;
                    $mirror = true;
                    break;
                case 6:
                    $deg = 270;
                    break;
                case 7:
                    $deg    = 90;
                    $mirror = true;
                    break;
                case 8:
                    $deg = 90;
                    break;
            }
            if ($deg)
                $img = imagerotate($img, $deg, 0);
            $done=1;
            if ($mirror)
                $img = _mirrorImage($img);
            if($img)return true;
            $done=imagejpeg($img, $full_filename, 95);
            if($done)return true;
        }
    }
    return false;
}
public function thumbnail($target_image)
{
    $file = $target_image;
    $thumb='_thumb'.$file;
    list($width, $height) = getimagesize($file);
    if ($width > 300) {
        $newWidth = 300.0;
    } else if ($width > 200) {
        $newWidth = 200.0;
    } else if ($width > 100) {
        $newWidth = 100.0;
    } else if ($width > 50) {
        $newWidth = 50.0;
    }
    $size         = $newWidth / $width;
    $newHeight    = $height * $size;
    $resizedImage = imagecreatetruecolor($newWidth, $newHeight);
    $image        = imagecreatefromjpeg($file);
    $opt          = imagerotate($image, 0, 0);
    imagecopyresampled($resizedImage, $opt, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
    imagejpeg($resizedImage, $thumb, 80);
}
public function qrcode($string,$height='300',$width='300')
{
	return "https://chart.googleapis.com/chart?chs=$heightx$width&cht=qr&chl=$string&choe=UTF-8";
}
public function watermark(&$img, $text='', $color='red',$font=14)
{
    if($font < 0 || $font > 5){ $font = 0; }
    $num = array(array(4.6, 6),
                 array(4.6, 6),
                 array(5.6, 12),
                 array(6.5, 12),
                 array(7.6, 16),
                 array(8.5, 16));
    $width = ceil(strlen($text) * $num[$font][0]);
    $x     = imagesx($img) - $width - 8;
    $y     = Imagesy($img) - ($num[$font][1] + 2);
    imagestring($img, $font, $x/2, $y/2, $text, $color);
}
}
?>