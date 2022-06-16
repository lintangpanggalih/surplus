<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Services\CategoryService;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }
    public function index()
    {
        $result = ['status' => 200];
        try {
            $result['data'] = $this->categoryService->getAll();
        } catch (Exception $e) {
            $result = [
                'status' => $e->getCode(),
                'message' => $e->getMessage()
            ];
        }
        return response()->json($result, $result['status']);
    }
    public function show($id)
    {
        $result = ['status' => 200];
        try {
            $result['data'] = $this->categoryService->getById($id);
        } catch (Exception $e) {
            $result = [
                'status' => $e->getCode(),
                'message' => $e->getMessage()
            ];
        }
        return response()->json($result, $result['status']);
    }

    public function store(CategoryRequest $request)
    {
        $validated = $request->validated();
        $result = ['status' => 200, 'message' => 'New category has been added.'];
        try {
            $result['data'] = $this->categoryService->saveCategory($validated);
        } catch (Exception $e) {
            $result = [
                'status' => $e->getCode(),
                'message' => $e->getMessage()
            ];
        }
        return response()->json($result, $result['status']);
    }

    public function update(CategoryRequest $request, $id)
    {
        $validated = $request->validated();
        $result = ['status' => 200, 'message' => 'Success to update category.'];

        try {
            $result['data'] = $this->categoryService->updateCategory($validated, $id);
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
        $result = ['status' => 200, 'message' => 'Category has been deleted.'];

        try {
            $result['data'] = $this->categoryService->deleteCategory($id);
        } catch (Exception $e) {
            $result = [
                'status' => $e->getCode(),
                'message' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }

}
