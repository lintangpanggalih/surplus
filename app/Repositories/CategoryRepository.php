<?php 
namespace App\Repositories;

use App\Models\Category;

class CategoryRepository {

    private $category;
    
    public function __construct(Category $category)
    {
        $this->category = $category;
    }
    public function all()
    {
        return $this->category->all();
    }
    
    public function find($id)
    {
        return $this->category->findOrFail($id);
    }
    
    public function save($request)
    {
        return $this->category->create($request);
    }

    public function update($id, $request)
    {
        $category = $this->category->findOrFail($id);
        $category->update($request);
        return $category;
    }

    public function delete($id)
    {
        return $this->category->findOrFail($id)->delete();
    }
}