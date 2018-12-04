<?php
namespace App\Helpers;

use Illuminate\Support\Facades\Storage;
use Image;



class ImageUpload
{
    public $path;

    public function add($request, $data, $path)
    {
        if ($request->image) {
            $this->path = $path;

            $imageOldName = $data->image;
            $imageNewName = config('app.name') . '-' . $data->slug . '-' . time() . '.' . $request->image->getClientOriginalExtension();

            $this->upload($request, $data, $path, $imageNewName, $imageOldName);

            $sliderPath = $path . '/slider';
            $this->upload($request, $data, $sliderPath, $imageNewName, $imageOldName);
        }
    }

    public function upload($request, $data, $path, $imageNewName, $imageOldName)
    {
        if ($request->hasFile('image')) {
            // create path
            if (!Storage::disk('public')->exists($path)) {
                Storage::disk('public')->makeDirectory($path);
            }
            //resize image for data or slider data and sat template image
            if ($path == $this->path) {
                $imageFile = Image::make($request->file('image'))->resize(1600, 1000)->save('storage/' . $path . '/' . 'default.png');
                $data->image = $imageNewName;
                $data->save();
            } else {
                $imageFile = Image::make($request->file('image'))->resize(200, 200)->save('storage/' . $path . '/' . 'default.png');
            }
            $this->delete($path, $imageOldName);

            Storage::disk('public')->put($path . '/' . $imageNewName, $imageFile);
        }
    }

    public function delete($path, $image)
    {
        if ($image != 'default.png') {
            try {
                Storage::disk('public')->delete($path . '/' . $image);
            } catch (FileNotFoundException $e) {
                //throw $th;
            }
        }
    }
}