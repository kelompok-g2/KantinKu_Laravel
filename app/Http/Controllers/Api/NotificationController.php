<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

class NotificationController extends ApiController
{
    public function index(Request $request)
    {
        return $this->success('Notifikasi pengguna.', $request->user()->notifications()->paginate(20));
    }

    public function read(Request $request, string $id)
    {
        $notification = $request->user()->notifications()->findOrFail($id);
        $notification->markAsRead();

        return $this->success('Notifikasi sudah dibaca.', $notification);
    }
}
