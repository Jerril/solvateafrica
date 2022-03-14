<?php

namespace App\Repository\UploadFile;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Str;

class UploadFileService implements UploadFileInterface
{
     /**
     * Delete a Model
     * @param $attribute
     * @param  $foldername
     * @return bool
     */

    public function UploadFile($file, $foldername, $resize = false, $width = null, $height = null): string
    {
        $filename = Str::random(14).'.'.$file->getClientOriginalExtension();
        $file_resize = Image::make($file->getRealPath()); 
        if($width != null)             
            $file_resize->resize($width, $height);

        $file_resize->save(public_path($foldername.'/'.$filename ));

        return $filename;
    }
}