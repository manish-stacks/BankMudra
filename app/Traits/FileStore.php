<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;



trait FileStore
{

    public static function saveFile(UploadedFile $file)
    {
        if (isset($file)) {
            $current_date  = Carbon::now()->format('d-m-Y');

            if (!File::isDirectory('uploads/file/' . $current_date)) {
                File::makeDirectory('uploads/file/' . $current_date, 0777, true, true);
            }

            $file_name = uniqid() . '.' . $file->extension();
            $file->storeAs('uploads/file/' . $current_date . '/', $file_name);
            return 'uploads/file/' . $current_date . '/' . $file_name;
        } else {
            return null;
        }
    }


    public function imageUpload($image, $filePath)
    {
        if (isset($image)) {
            // $directoryPath = public_path("uploads/{$filePath}/");
            
            if (!File::isDirectory("public/uploads/{$filePath}/")) {
                File::makeDirectory("public/uploads/{$filePath}/", 0777, true, true);
            }


            $fileName = md5(rand(0, 9999) . '_' . time()) . '.' . $image->clientExtension();
            $imgPath = "public/uploads/{$filePath}/" . $fileName;
            $image->move(public_path("uploads/{$filePath}"), $fileName);

            clearstatcache();
            return $imgPath;
        }
    
        return null; 
    }

    public function deleteImageDirect($file)
    {
        if ($file && File::exists($file)) {
            File::delete($file);
            return true;
        }

        return false;
    }
    
    
    
 public function uploadPDF(Request $request, $inputName, $path)
{
    try {
        // Check if the request has the specified file
        if ($request->hasFile($inputName)) {
            $file = $request->file($inputName);
            $ext = $file->getClientOriginalExtension();

            // Ensure the uploaded file is a PDF
            if ($ext === 'pdf') {
                // Ensure the directory exists
                if (!file_exists(public_path($path))) {
                    mkdir(public_path($path), 0777, true); // Create the directory if it doesn't exist
                }

                // Generate a unique file name
                $fileName = 'document_' . uniqid() . '.' . $ext;

                // Move the file to the specified path
                $file->move(public_path($path), $fileName);

                // Return the relative path to be stored in the database
                return $path . '/' . $fileName;
            } else {
                return false; // Return false if the file is not a PDF
            }
        }

        return false; // Return false if no file is provided
    } catch (\Exception $e) {
        // Log any errors for debugging
        Log::error('PDF Upload Error: ' . $e->getMessage());
        return false;
    }
}





    public function updatePdf(Request $request, $inputName, $path, $existingFilePath = null)
    {
        if ($request->hasFile($inputName)) {
            $file = $request->{$inputName};
            $ext = $file->getClientOriginalExtension();

            // Check if the file extension is PDF
            if ($ext === 'pdf') {
                $fileName = 'document_' . uniqid() . '.' . $ext;
                $file->move(public_path($path), $fileName);

                // Delete the existing PDF file if it exists
                if ($existingFilePath && file_exists(public_path($existingFilePath))) {
                    unlink(public_path($existingFilePath));
                }

                return $path . '/' . $fileName;
            } else {
                return false; // Return false if the file extension is not PDF
            }
        } else {
            return false; // Return false if no file is uploaded
        }
    }

    
}
