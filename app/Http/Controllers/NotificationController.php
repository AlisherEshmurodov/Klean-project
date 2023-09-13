<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Notifications\PostCreated;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\Notification;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('notifications.index')->with([
            'notifications' => auth()->user()->unreadNotifications()->paginate(4),
        ]);
    }

    public function read(DatabaseNotification $notification)
    {
        $notification->markAsRead();
        return redirect()->back();
    }

    public function readall()
    {
        $user = User::find(auth()->user()->id);
        foreach ($user->unreadNotifications as $notification) {
            $notification->markAsRead();
        }

        return redirect()->route('posts.index');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
