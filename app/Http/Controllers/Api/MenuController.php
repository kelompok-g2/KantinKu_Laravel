<?php

namespace App\Http\Controllers\Api;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends ApiController
{
    public function index()
    {
        return $this->success('Daftar menu KantinKu', Menu::orderBy('id', 'desc')->get());
    }

    public function show(Menu $menu)
    {
        return $this->success('Detail menu KantinKu.', $menu);
    }

    public function store(Request $request)
    {
        $menu = new Menu;
        $menu->forceFill($this->validated($request, false))->save();

        return $this->success('Menu berhasil dibuat.', $menu->refresh(), 201);
    }

    public function update(Request $request, Menu $menu)
    {
        $menu->forceFill($this->validated($request, true))->save();

        return $this->success('Menu berhasil diperbarui.', $menu->refresh());
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();

        return $this->success('Menu berhasil dihapus.');
    }

    private function validated(Request $request, bool $update): array
    {
        $presence = $update ? 'sometimes|required' : 'required';

        return $request->validate([
            'name' => $presence.'|string|max:255',
            'category_id' => $presence.'|integer|exists:categories,id',
            'price' => $presence.'|numeric|decimal:0,2|min:0|max:9999999999.99',
            'stand' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',
            'image_url' => 'nullable|url:http,https|max:255',
            'is_available' => 'sometimes|boolean',
        ]);
    }
}
