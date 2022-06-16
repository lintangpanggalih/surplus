<?php

namespace App\Services;

use App\Repositories\imageRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use InvalidArgumentException;

class imageService
{
    private $imageRepo;

    public function __construct(ImageRepository $imageRepository)
    {
        $this->imageRepo = $imageRepository;
    }

    public function getAll()
    {
        return $this->imageRepo->all();
    }
    public function fileChecker($path)
    {
        if (!Storage::exists('public/' . $path))
            throw new Exception("Image doesn't exists.", 404);
        return true;
    }
    public function getById($id)
    {
        try {
            $image =  $this->imageRepo->find($id);
            $this->fileChecker($image->file);
        } catch (\Throwable $th) {
            throw new Exception("Image doesn't exists.", 404);
        }
        return $image;
    }

    public function saveImage($request)
    {
        $path = 'images';
        $file = $request->file('image');

        $filename = $file->getClientOriginalName();
        $ext = $file->getClientOriginalExtension();

        DB::beginTransaction();
        try {
            // Saving new image into storage/app/public/$path directory
            $file_path = $file->storeAs($path, Str::random(32) . '.' . $ext, 'public');
            $input = [
                'name' => $filename,
                'file' => $file_path,
                'enable' => $request->enable,
            ];
            $image = $this->imageRepo->save($input);
        } catch (\Throwable $th) {
            DB::rollBack();

            throw new Exception('Failed to save new image.', 500);
        }
        DB::commit();

        return $image;
    }

    public function updateImage($request, $id)
    {
        DB::beginTransaction();
        try {
            $image = $this->imageRepo->update($id, $request);
        } catch (Exception $e) {
            DB::rollBack();

            throw new InvalidArgumentException('Failed to update image.', 500);
        }
        DB::commit();

        return $image;
    }

    public function deleteImage($id)
    {
        $image = $this->getById($id);

        DB::beginTransaction();
        try {
            Storage::delete('public/' . $image->file);
            $image = $this->imageRepo->delete($id);
        } catch (Exception $e) {
            DB::rollBack();

            throw new Exception('Failed to delete image.', 500);
        }
        DB::commit();

        return $image;
    }
}
