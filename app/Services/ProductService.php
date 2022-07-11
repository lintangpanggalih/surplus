<?php

namespace App\Services;

use App\Repositories\ProductRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProductService
{
    private $productRepo;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepo = $productRepository;
    }

    public function getAll()
    {
        return $this->productRepo->all();
    }

    public function getById($id)
    {
        try {
            $product = $this->productRepo->find($id);
        } catch (\Throwable $th) {
            throw new Exception("Product doesn't exists.", 404);
        }
        return $product;
    }

    public function saveProduct($request)
    {
        DB::beginTransaction();
        try {
            $product = $this->productRepo->save($request);
        } catch (\Throwable $th) {
            DB::rollBack();

            throw new Exception('Failed to save new product.', 500);
        }
        DB::commit();

        return $product;
    }

    public function updateProduct($request, $id)
    {
        DB::beginTransaction();
        try {
            $product = $this->productRepo->update($id, $request);
        } catch (\Throwable $th) {
            DB::rollBack();

            throw new Exception('Failed to update product.', 500);
        }
        DB::commit();

        return $product;
    }

    public function deleteProduct($id)
    {
        DB::beginTransaction();
        try {
            $product = $this->productRepo->delete($id);
        } catch (\Throwable $th) {
            DB::rollBack();

            throw new Exception('Failed to delete product.', 500);
        }
        DB::commit();

        return $product;
    }

    public function updateCategory($product_id, $data)
    {
        // Check category
        $validator = Validator::make($data, [
            'category' => ['required', 'exists:categories,id'],
            'action' => ['required', 'in:remove,add']
        ]);

        if ($validator->fails())
            throw new Exception($validator->errors()->first(), 422);

        $category_id = $data['category'];
        $action = $data['action'];

        // Check category product
        $category_exists = $this->productRepo->find($product_id)
            ->categories()->where('id', $category_id)
            ->count();

        if ($action === 'add' && $category_exists)
            throw new Exception('Category of product already exists.', 422);
        if ($action === 'remove' && !$category_exists)
            throw new Exception('Category of product not exists.', 422);

        DB::beginTransaction();
        try {

            if ($action === 'add') {
                $product = $this->productRepo->attachCategory($product_id, $category_id);
                $message = 'Category of product has been added.';
            } elseif ($action === 'remove') {
                $product = $this->productRepo->detachCategory($product_id, $category_id);
                $message = 'Category of product has been removed.';
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new Exception('Failed to update product category.', 500);
        }
        DB::commit();

        return ['data' => $product->load('categories'), 'message' => $message];
    }

    public function updateImage($product_id, $data)
    {
        // Check image
        $validator = Validator::make($data, [
            'image' => ['required', 'exists:images,id'],
            'action' => ['required', 'in:remove,add']
        ]);
        if ($validator->fails())
            throw new Exception($validator->errors()->first(), 422);

        $image_id = $data['image'];
        $action = $data['action'];

        // Check image product
        $image_exists = $this->productRepo->find($product_id)
            ->images()->where('id', $image_id)
            ->count();

        if ($action === 'add' && $image_exists)
            throw new Exception('Image of product already exists.', 422);
        if ($action === 'remove' && !$image_exists)
            throw new Exception('Image of product not exists.', 422);

        DB::beginTransaction();
        try {
            if ($action === 'add') {
                $product = $this->productRepo->attachImage($product_id, $image_id);
                $message = 'Image of product has been added.';
            } elseif ($action === 'remove') {
                $product = $this->productRepo->detachImage($product_id, $image_id);
                $message = 'Image of product has been removed.';
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new Exception("Failed to add product's image.", 500);
        }
        DB::commit();

        return ['data' => $product->load('images'), 'message' => $message];
    }
}
