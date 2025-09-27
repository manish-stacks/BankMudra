<?php

namespace App\Traits;

use App\Models\Upload;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
// use Intervention\Image\Facades\Image;

use Carbon\Carbon;
use enshrined\svgSanitize\Sanitizer;
use Illuminate\Support\Facades\Auth;


use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

trait ImageStore
{
    public function saveImage($image, $height = null, $lenght = null)
    {


        if (isset($image)) {

            //$current_date = Carbon::now()->format('d-m-Y');
            if (!File::isDirectory('public/uploads/images/')) {
                File::makeDirectory('public/uploads/images/', 0777, true, true);
            }


            $type = $this->getFiletype();
            $extension = strtolower($image->extension());

            if ($image->extension() == "svg") {

                $sanitizer = new Sanitizer();
                $dirtySVG = file_get_contents($image);
                $cleanSVG = $sanitizer->sanitize($dirtySVG);
                file_put_contents($image, $cleanSVG);


                $fileName1 = md5(rand(0, 9999) . '_' . time()) . '.' . $image->clientExtension();
                $img_name = 'public/uploads/images/' . $fileName1;
                $image->move(public_path('uploads/images'), $fileName1);

                $modelUpload = Upload::create([
                    'file_original_name' => $image->getClientOriginalName(),
                    'external_link' => $img_name,
                    'user_id' => auth()->guard('admin')->user()->id,
                    'extension' => $image->clientExtension(),
                    'type' => $type[$extension],
                    'file_size' => 0,
                ]);

                $img_id = $modelUpload->id;
                clearstatcache();
            } else {
                try {

                    $manager = new ImageManager(new Driver());
                    $img = $manager->read($image);

                    $image_extention =  $image->clientExtension();
                    if ($height != null) {
                        $img = $img->resize($height, $lenght);
                    }

                    $img_name = 'public/uploads/images/' . uniqid() . '.' . $image_extention;

                    $img->save($img_name);



                    $modelUpload = Upload::create([
                        'file_original_name' => $image->getClientOriginalName(),
                        'external_link' => $img_name,
                        'user_id' => auth()->guard('admin')->user()->id,
                        'extension' => $image->clientExtension(),
                        'type' => $type[$extension],
                        'file_size' => $image->getSize(),
                    ]);

                    $img_id = $modelUpload->id;
                    clearstatcache();
                } catch (\Exception $e) {
                    // Log the error message for debugging
                    Log::error('Image upload error: ' . $e->getMessage());
                    Toastr::error('Invalid Image Format', 'error');
                    return null;
                }
            }

            return $img_id;
        } else {
            return null;
        }
    }


    
    
   




    public function uploadMultiImage(Request $request, $inputName, $path)
    {
        $uploadedImages = [];

        if ($request->hasFile($inputName)) {
            $images = $request->file($inputName);

            foreach ($images as $image) {
                $ext = $image->getClientOriginalExtension();
                $imageName = 'media_' . uniqid() . '.' . $ext;
                $image->move(public_path($path), $imageName);

                $uploadedImages[] = $path . '/' . $imageName;
            }
        }

        return $uploadedImages;
    }


    public function deleteImages(string $path)
    {
        if (File::exists(public_path($path))) {
            File::delete(public_path($path));
        }
    }
    

    public function deleteImage($id)
    {
        $file = Upload::find($id);

        if ($file && File::exists($file->external_link)) {
            $file->delete();
            File::delete($file->external_link);
            return true;
        }

        return false;
    }

    public function saveAvatar($image, $height = null, $lenght = null)
    {
        if (isset($image)) {

            $current_date = Carbon::now()->format('d-m-Y');

            if (!File::isDirectory('uploads/avatar/' . $current_date)) {

                File::makeDirectory('uploads/avatar/' . $current_date, 0777, true, true);
            }

            $manager = new ImageManager(new Driver());
            $img = $manager->read($image);
            $image_extention =  $image->clientExtension();



            if ($height != null && $lenght != null) {
                $img = $img->resize($height, $lenght);
            }

            $img_name = 'uploads/avatar/' . $current_date . '/' . uniqid() . '.' . $image_extention;
            $img->save($img_name);

            return $img_name;
        } else {

            return null;
        }
    }




    public function getFiletype()
    {
        $type = array(
            "jpg" => "image",
            "jpeg" => "image",
            "png" => "image",
            "svg" => "image",
            "webp" => "image",
            "gif" => "image",
            "mp4" => "video",
            "mpg" => "video",
            "mpeg" => "video",
            "webm" => "video",
            "ogg" => "video",
            "avi" => "video",
            "mov" => "video",
            "flv" => "video",
            "swf" => "video",
            "mkv" => "video",
            "wmv" => "video",
            "wma" => "audio",
            "aac" => "audio",
            "wav" => "audio",
            "mp3" => "audio",
            "zip" => "archive",
            "rar" => "archive",
            "7z" => "archive",
            "doc" => "document",
            "txt" => "document",
            "docx" => "document",
            "pdf" => "document",
            "csv" => "document",
            "xml" => "document",
            "ods" => "document",
            "xlr" => "document",
            "xls" => "document",
            "xlsx" => "document"
        );

        return $type;
    }
}
