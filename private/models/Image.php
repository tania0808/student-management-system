<?php

class Image
{
    public function crop($src_image_path, $dest_image_path, $max_size = 600 ){
        if(file_exists($src_image_path)){
            $extention = strtolower(pathinfo($src_image_path, PATHINFO_EXTENSION));
            if($extention == 'jpeg' || $extention == 'jpg'){
                $src_image = imagecreatefromjpeg($src_image_path);
            } else
            if($extention == 'png'){
                $src_image = imagecreatefrompng($src_image_path);
            } else
            if($extention == 'gif'){
                $src_image = imagecreatefromgif($src_image_path);
            } else {
                $src_image = imagecreatefromjpeg($src_image_path);
            }
            if($src_image){
                $height = imagesy($src_image);
                $width = imagesx($src_image);
                // check which side is larger
                if($width > $height){
                    $extra_space = $width - $height;
                    $src_x = $extra_space / 2;
                    $src_y = 0;
                    $src_w = $height;
                    $src_h = $height;
                } else {
                    $extra_space = $height - $width;
                    $src_y = $extra_space / 2;
                    $src_x = 0;
                    $src_w = $width;
                    $src_h = $width;
                }
                $dst_image = imagecreatetruecolor($max_size, $max_size);
                imagecopyresampled($dst_image, $src_image, 0, 0, $src_x, $src_y, $max_size, $max_size, $src_w, $src_h);
                imagejpeg($dst_image, $dest_image_path, 98);
            }
        }
    }

    public function profile_thumb($image_path){
        $crop_size = 600;
        $extension = strtolower(pathinfo($image_path, PATHINFO_EXTENSION));
        $thumbnail = str_replace('.' . $extension, '_thumb.' . $extension, $image_path);

        if(!file_exists($thumbnail)){
            $this->crop($image_path, $thumbnail, $crop_size);
        }

        return$thumbnail;
    }

    public function resize(){

    }
}
