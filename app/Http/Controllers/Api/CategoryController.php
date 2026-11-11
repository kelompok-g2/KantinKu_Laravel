<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CategoryRequest;
use App\Models\Category;
use App\Models\Menu;
use Illuminate\Support\Facades\DB;

class CategoryController extends ApiController
{
    public function index()
    {
        return $this->success('Daftar kategori KantinKu', Category::orderBy('id', 'asc')->get());
    }

    public function store(CategoryRequest $request)
    {
        $category = new Category;
        $category->forceFill($request->validated())->save();

        return $this->success('Kategori berhasil dibuat.', $category, 201);
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $category->forceFill($request->validated())->save();

        return $this->success('Kategori berhasil diperbarui.', $category);
    }

    public function destroy(Category $category)
    {
        DB::transaction(function () use ($category) {
            $category = Category::whereKey($category->id)->lockForUpdate()->firstOrFail();
            abort_if(Menu::where('category_id', $category->id)->exists(), 409, 'Kategori masih dipakai oleh menu.');
            $category->delete();
        });

        return $this->success('Kategori berhasil dihapus.');
    }
}
