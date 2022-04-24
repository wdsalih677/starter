<?php
namespace App\Traits;

Trait OfferTrait
{
     function saveImages($photo,$folder){
        $file_extension =  $photo -> extension();
        $file_name = time().'.'.$file_extension;
        $path =$folder;
        $photo->move($path,$file_name);
        return $file_name;
    }
}