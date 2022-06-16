<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageRequest;
use App\Repositories\ImageRepository;
use App\Services\imageService;
use Exception;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    private $imageService;

    public function __construct(imageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function index()
    {
        return $this->imageService->getAll();
    }

    public function show($id)
    {
        $result = ['status' => 200];
        try {
            $result['data'] = $this->imageService->getById($id);
        } catch (Exception $e) {
            $result = [
                'status' => $e->getCode(),
                'message' => $e->getMessage()
            ];
        }
        return response()->json($result, $result['status']);
    }

    public function store(ImageRequest $request)
    {
        $result = ['status' => 200, 'message' => 'New image has been added.'];
        try {
            $result['data'] = $this->imageService->saveImage($request);
        } catch (Exception $e) {
            $result = [
                'status' => $e->getCode(),
                'message' => $e->getMessage()
            ];
        }
        return response()->json($result, $result['status']);
    }
    
    public function update(ImageRequest $request, $id)
    {
        $validated = $request->validated();
        $result = ['status' => 200, 'message' => 'Success to update Image.'];

        try {
            $result['data'] = $this->imageService->updateImage($validated, $id);
        } catch (Exception $e) {
            $result = [
                'status' => $e->getCode(),
                'message' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }
    
    public function destroy($id)
    {
        $result = ['status' => 200, 'message' => 'Image has been deleted.'];

        try {
            $result['data'] = $this->imageService->deleteImage($id);
        } catch (Exception $e) {
            $result = [
                'status' => $e->getCode(),
                'message' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }
}
