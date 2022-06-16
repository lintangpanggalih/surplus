<?php 
namespace App\Repositories;

use App\Models\Image;

class ImageRepository {

    private $image;
    
    public function __construct(Image $image)
    {
        $this->image = $image;
    }
    public function all()
    {
        return $this->image->all();
    }
    
    public function find($id)
    {
        return $this->image->findOrFail($id);
    }
    
    public function save($request)
    {
        return $this->image->create($request);
    }

    public function update($id, $request)
    {
        $image = $this->image->findOrFail($id);
        $image->update($request);
        return $image;
    }

    public function delete($id)
    {
        return $this->image->findOrFail($id)->delete();
    }
}