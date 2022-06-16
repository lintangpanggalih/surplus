<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{

    private $product;
    public function __construct(Product $product)
    {
        $this->product = $product;
    }
    public function all()
    {
        return $this->product->all();
    }

    public function find($id)
    {
        return $this->product->with(['categories', 'images'])->findOrFail($id);
    }

    public function save($request)
    {
        return $this->product->create($request);
    }

    public function update($id, $request)
    {
        $product = $this->product->findOrFail($id);
        $product->update($request);
        return $product;
    }

    public function delete($id)
    {
        return $this->product->findOrFail($id)->delete();
    }

    public function attachCategory($product, $category)
    {
        $product = $this->product->findOrFail($product);
        $product->categories()->attach($category);
        return $product;
    }

    public function detachCategory($product, $category)
    {
        $product = $this->product->findOrFail($product);
        $product->categories()->detach($category);
        return $product;
    }

    public function attachImage($product, $image)
    {
        $product = $this->product->findOrFail($product);
        $product->images()->attach($image);
        return $product;
    }

    public function detachImage($product, $image)
    {
        $product = $this->product->findOrFail($product);
        $product->images()->detach($image);
        return $product;
    }
}
