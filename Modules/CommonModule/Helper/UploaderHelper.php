<?php

namespace Modules\CommonModule\Helper;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

trait UploaderHelper
{
    /**
     * upload file through $request, Compress it.
     * to the server in public folder: /public/images/{categoryNameFolder}.
     * if_not_exist : create it with 775 permission.
     *
     * @param Request $request
     * @return string
     */
    public function upload($imageFromRequest, $imageFolder, $resize = false)
    {



        $location =  public_path('images/' . $imageFolder);

        if (!is_dir($location) && !file_exists($location))
        {
            mkdir($location);
        }
        $photoOrigin=$imageFromRequest->getClientOriginalName();
        $stripped = str_replace(' ', '', $photoOrigin);

        $fileName = time() . $stripped;

        $location = $location . '/' . $fileName;

        $image = Image::make($imageFromRequest);
        $image->save($location, 70);
        # Optional Resize.
        if ($resize == true) {
            $image->resize(600, 600);
            $newlocation = public_path('images/' . $imageFolder . '/thumb' . '/' . $fileName);
            $image->save($newlocation, 70);
        }


        return $fileName;
    }

    public function uploadFile($fileFromRequest,$fileFolder){

        $fileName = time().'.'.$fileFromRequest->getClientOriginalExtension();
        $location = public_path('files/'. $fileFolder . '/');
        $fileFromRequest->move($location, $fileName);

        return $fileName;

    }

    /**
     * Call upload() func to upload photo album.
     *
     * @param [type] $photos
     * @return array
     */
    public function uploadAlbum($photos, $folder = 'cars')
    {
        foreach ($photos as $album) {
            $imageName = $this->upload($album, $folder);
            $car_photos[] = $imageName;
        }
        return $car_photos;

    }


    public function deleteFile($folder, $image_name)
    {
        if (File::exists(public_path('images/' . $folder . '/').$image_name)){
            File::delete(public_path('images/' . $folder . '/').$image_name);
        }
    }
}
