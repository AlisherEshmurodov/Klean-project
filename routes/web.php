<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PostController;
use App\Models\Post;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});


/*//callback function
Route::get('/test', function () {
    return "Bu test";
});

Route::get('/test2', function () {
    return view('/test2');
});

Route::get('/testId/{id?}', function ($test_id="id tanlanmagan") {
    return "id: ".$test_id;
});

Route::view('/test2', 'test2');

Route::get('/test', [\App\Http\Controllers\TestController::class, "actionTest"]);

Route::redirect('/extra', '/test');*/


Route::get("/users", [\App\Http\Controllers\UserController::class, "index"]);

//Route::get("/users/create/{user_id}", [\App\Http\Controllers\UserController::class, "create"]);

Route::get("users/create", [\App\Http\Controllers\UserController::class, "create"]);
Route::post('/user-create', [\App\Http\Controllers\UserController::class, 'store']);

Route::get("/users/{user}", [\App\Http\Controllers\UserController::class, 'show']);


Route::get('/', [\App\Http\Controllers\PageController::class, 'main'])->name('main');
Route::get('/about', [\App\Http\Controllers\PageController::class, 'about'])->name('about');
Route::get('/service', [\App\Http\Controllers\PageController::class, 'service'])->name('service');
Route::get('/project', [\App\Http\Controllers\PageController::class, 'project'])->name('project');

Route::get('/contact', [\App\Http\Controllers\PageController::class, 'contact'])->name('contact');
Route::get('/single', [\App\Http\Controllers\PageController::class, 'single'])->name('single');
Route::get('/welcome', [\App\Http\Controllers\PageController::class, 'welcome']);


/*Route::get('/posts', [\App\Http\Controllers\PostController::class, 'index'])->name('posts.index');
Route::get('/posts/{post}', [\App\Http\Controllers\PostController::class, 'show'])->name('posts.show');
Route::delete('/posts/{post}/delete', [\App\Http\Controllers\PostController::class, 'delete'])->name('posts.delete');

Route::get('/posts/{post}/edit', [\App\Http\Controllers\PostController::class, 'update'])->name('posts.update');
Route::put('/posts/{post}/edit', [\App\Http\Controllers\PostController::class, 'edit'])->name('posts.edit');

Route::get('/posts/create', [\App\Http\Controllers\PostController::class, 'create'])->name('posts.create');
Route::post('/posts/create', [\App\Http\Controllers\PostController::class, 'store'])->name('posts.store');*/


Route::resource('posts', PostController::class);
Route::resource('comments', CommentController::class);
Route::resource('notifications', NotificationController::class);

Route::post('authenticate', [AuthController::class, 'authenticate'])->name('authenticate');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::get('register', [AuthController::class, 'register'])->name('register');

Route::post('register', [AuthController::class, 'register_store'])->name('register.store');

Route::middleware('auth')->group(function () {
    Route::get('notifications/{notification}/read', [NotificationController::class, 'read'])->name('notifications.read');
});
    Route::get('readall', [NotificationController::class, 'readall'])->name('readall');

    /*Route::get('/posts', function (){
        $posts = Cache::remember('posts', 120, function () {
            return Post::latest()->get();
        });
        return view('posts.index')->name('posts.index')->with('posts', $posts);
    });*/






