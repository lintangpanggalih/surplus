<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Services\ProductService;
use Exception;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $productService;
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }
    public function all()
    {
        $result = ['status' => 200];
        try {
            $result['data'] = $this->productService->getAll();
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
            $result['data'] = $this->productService->getById($id);
        } catch (Exception $e) {
            $result = [
                'status' => $e->getCode(),
                'message' => $e->getMessage()
            ];
        }
        return response()->json($result, $result['status']);
    }
    public function store(ProductRequest $request)
    {
        $validated = $request->validated();
        $result = ['status' => 200, 'message' => 'New product has been added.'];

        try {
            $result['data'] = $this->productService->saveProduct($validated);
        } catch (Exception $e) {
            $result = [
                'status' => $e->getCode(),
                'message' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }

    public function update(ProductRequest $request, $id)
    {
        $validated = $request->validated();
        $result = ['status' => 200, 'message' => 'Success to update product.'];

        try {
            $result['data'] = $this->productService->updateProduct($validated, $id);
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
        $result = ['status' => 200, 'message' => 'Product has been deleted.'];

        try {
            $result['data'] = $this->productService->deleteProduct($id);
        } catch (Exception $e) {
            $result = [
                'status' => $e->getCode(),
                'message' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }

    public function updateCategory($product, Request $request)
    {
        $data = $request->only('category','action');
        $result = ['status' => 200];

        try {
            $response = $this->productService->updateCategory($product, $data);
            $result['message'] = $response['message'];
            $result['data'] = $response['data'];
        } catch (Exception $e) {
            $result = [
                'status' => $e->getCode(),
                'message' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }

    public function updateImage($product, Request $request)
    {
        $data = $request->only('image', 'action');
        $result = ['status' => 200];

        try {
            $response = $this->productService->updateImage($product, $data);
            $result['message'] = $response['message'];
            $result['data'] = $response['data'];
        } catch (Exception $e) {
            $result = [
                'status' => $e->getCode(),
                'message' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }
}
