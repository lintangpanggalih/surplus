# Tentang Repository
Repository ini berisi source code (REST API) untuk asesmen Backend. Dibangun menggunakan [Laravel 8](https://laravel.com/docs/8.x/).

# Install Project
1. Buat database baru `surplus`
2. Run `composer install`
3. Run `php artisan key:generate` 
4. Run `php artisan migrate`
5. Run `php artisan db:seed`
6. Run `php artisan serve`

# Endpoint
Struktur endpoint (URLs) untuk masing-masing data resources menggunakan HTTP methods - GET, PUT, POST, DELETE. 
Semua endpoint dibawah ini diakses diawali dengan URI `domain.com/api/`, sesuai dengan standar pada `route/api.php` pada Framework Laravel.

<details><summary>Product Endpoint</summary>
<p>

Endpoint | Data Params |HTTP Method | CRUD Method | Result
-- | -- |-- |-- |--
`product` | `none` | GET | READ | Get all products
`product` | `name`<br />`description`<br />`enable (boolean)` | POST | CREATE | Create a new product
`product/{id}` |`none` |  GET | READ | Get a single product
`product/{id}` | `name`<br/>`description`<br/>`enable (boolean)` |  PUT | UPDATE | Update a product
`product/{id}` |`none` |  DELETE | DELETE | Delete a product
`product/{id}/update-image` | `image: [image_id]`<br/>`action: ["add" or "remove"]` |  PUT | UPDATE | Update **(add or remove)** a image of product
`product/{id}/update-category` | `image: [category_id]`<br/>`action: ["add" or "remove"]` |  PUT | UPDATE | Update **(add or remove)** a category of product
    
</p>
</details>


<details><summary>Category Endpoint</summary>
<p>

Endpoint | Data Params |HTTP Method | CRUD Method | Result
-- | -- |-- |-- |--
`category` | `none` | GET | READ | Get all categories
`category` | `name`<br />`enable (boolean)` | POST | CREATE | Create a new category
`category/{id}` |`none` |  GET | READ | Get a single category
`category/{id}` | `name`<br/>`enable (boolean)` |  PUT | UPDATE | Update a category
`category/{id}` |`none` |  DELETE | DELETE | Delete a category
    
</p>
</details>

<details><summary>Image Endpoint</summary>
<p>

Endpoint | Data Params |HTTP Method | CRUD Method | Result
-- | -- |-- |-- |--
`image` | `none` | GET | READ | Get all images
`image` | `image (file)`<br />`enable (boolean)` | POST | CREATE | Create a new image
`image/{id}` |`none` |  GET | READ | Get a single image
`image/{id}` | `enable (boolean)` |  PUT | UPDATE | Update a image
`image/{id}` |`none` |  DELETE | DELETE | Delete a image
    
</p>
</details>
