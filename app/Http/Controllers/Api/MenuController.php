<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\MenuRequest;
use App\Models\Menu;

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

    public function store(MenuRequest $request)
    {
        $menu = new Menu;
        $menu->forceFill($request->validated())->save();

        return $this->success('Menu berhasil dibuat.', $menu->refresh(), 201);
    }

    public function update(MenuRequest $request, Menu $menu)
    {
        $menu->forceFill($request->validated())->save();

        return $this->success('Menu berhasil diperbarui.', $menu->refresh());
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();

        return $this->success('Menu berhasil dihapus.');
    }
}
