<?php

namespace App\Services;

use App\Repositories\CategoryRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;

class CategoryService
{
    private $categoryRepo;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepo = $categoryRepository;
    }

    public function getAll()
    {
        return $this->categoryRepo->all();
    }

    public function getById($id)
    {
        try {
            $category =  $this->categoryRepo->find($id);
        } catch (\Throwable $th) {
            throw new Exception("Category doesn't exists.", 404);
        }
        return $category;
    }

    public function saveCategory($request)
    {
        DB::beginTransaction();
        try {
            $category = $this->categoryRepo->save($request);
        } catch (\Throwable $th) {
            DB::rollBack();

            throw new Exception('Failed to save new category.', 500);
        }
        DB::commit();

        return $category;
    }

    public function updateCategory($request, $id)
    {
        DB::beginTransaction();
        try {
            $category = $this->categoryRepo->update($id, $request);
        } catch (Exception $e) {
            DB::rollBack();

            throw new InvalidArgumentException('Failed to update category.', 500);
        }
        DB::commit();

        return $category;
    }

    public function deleteCategory($id)
    {
        DB::beginTransaction();
        try {
            $category = $this->categoryRepo->delete($id);
        } catch (Exception $e) {
            DB::rollBack();

            throw new InvalidArgumentException('Failed to delete category.', 500);
        }
        DB::commit();

        return $category;
    }
}
