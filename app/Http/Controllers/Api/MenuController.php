<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\JsonResponse;

class MenuController extends Controller
{
    public function index(): JsonResponse
    {
        throw new \RuntimeException('Demo rollback P06 - kerusakan disengaja');

        $menus = Menu::orderBy('id', 'desc')->get();

        return response()->json([
            'success' => true,
            'message' => 'Daftar menu KantinKu',
            'data' => $menus,
        ]);
    }
}