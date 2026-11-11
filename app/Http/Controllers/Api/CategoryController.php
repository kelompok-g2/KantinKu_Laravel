<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class CategoryController extends ApiController
{
    public function index()
    {
        return $this->success('Daftar kategori KantinKu', Category::orderBy('id', 'asc')->get());
    }

    public function store(Request $request)
    {
        $category = new Category;
        $category->forceFill($this->validated($request, $category))->save();

        return $this->success('Kategori berhasil dibuat.', $category, 201);
    }

    public function update(Request $request, Category $category)
    {
        $category->forceFill($this->validated($request, $category))->save();

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

    private function validated(Request $request, Category $category): array
    {
        return $request->validate([
            'name' => [$category->exists ? 'sometimes' : 'bail', 'required', 'string', 'max:255', Rule::unique('categories')->ignore($category)],
            'description' => 'nullable|string|max:1000',
        ]);
    }
}
