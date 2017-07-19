<?php

namespace App\Traits;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

trait SaveAvatarTrait
{

  // path image and table name
  public $imgPath = 'images/avatars/';
  public $imgFieldTable = 'avatar';

  public function getAvatarAttribute($value)
  {
      //add full path to image
        if ($value) {
            return '/'. $this->imgPath . $value;
        }
  }

  public function setAvatarAttribute($value)
  {
    $imgField = $this->imgFieldTable;

      //remove file
      if (is_null($value)) {
          $image = $this->imgPath . $this->attributes[$imgField];
          if (File::exists($image)) {
              File::delete($image);
          }
          //clean field
          $this->attributes[$imgField] = null;
      } else {
          //add file
          //get name from path and rename md5(email)
          $imageName = last(explode('/', $value));
          $imageNameExtension = last(explode('.', $value));
          $imageNameNew = md5(strtolower(trim($this->email))). '.' .$imageNameExtension;

          //save in field only image name (without upload directory)
          $this->attributes[$imgField] = $imageNameNew;

          //move image to a new directory
          if (File::exists($value)) {
              File::move($value, $this->imgPath . $imageNameNew);
          }
      }
  }
}
