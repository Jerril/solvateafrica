<?php

namespace App\Repository\UploadFile;

interface UploadFileInterface 
{
    public function UploadFile($attribute, $foldername): string;
}
