<?php

use App\Http\Controllers\auth\PasswordController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DropzoneController;
use App\Http\Controllers\google\GoogleMapsController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\product\ProductController;
use App\Http\Controllers\schedule\ScheduleController;
use App\Http\Controllers\sidebar\SidebarController;
use App\Http\Controllers\store\StoreController;
use App\Http\Controllers\store\StoreProductController;
use App\Http\Controllers\SubStoreController;
use App\Http\Controllers\user\UserController;
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

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('sidebarScreens.dashboard.index');
})->middleware(['auth', 'verified', 'checkStore'])->name('dashboard');

// Middleware Role Administrator Store and Administrator SubStore
Route::middleware(['auth', 'checkAdmin', 'checkStore'])->group(function () {
    Route::get('/sucursals', [SubStoreController::class, 'obtainSubStores']);

    // Routes Management Products
    Route::get('/inventory', [SidebarController::class, 'inventoryManagementIndex'])->name('inventory.index');
    Route::get('/inventory/${id}', [SidebarController::class, 'inventoryManagementIndexSelected'])->name('inventory-selected.index');
    Route::get('product/create/${subStore}', [ProductController::class, 'create'])->name('product.create');
    Route::get('product/edit/${id}', [ProductController::class, 'update'])->name('product.edit');
    Route::get('status/product/{id}', [StoreProductController::class, 'changeStatus'])->name('status.product');

    // Routes Management Collaborators
    Route::get('/collaborators', [SidebarController::class, 'manageCollaboratorsIndex'])->name('collaborators.index');
    Route::get('collaborator/create', [UserController::class, 'createCollaborator'])->name('collaborator.create');

    // Routes Management Categories
    Route::get('category/create', [CategoryController::class, 'create'])->name('category.create');

    Route::post('/uploadTempo', [DropzoneController::class, 'storeTempStorage'])->name('dropzone.storeTemp');

    // Routes Images Dropzone
    Route::post('/upload', [DropzoneController::class, 'store'])->name('dropzone.store');
    Route::post('/delete-image', [DropzoneController::class, 'delete'])->name('dropzone.delete');

    // Routes Management Orders
    Route::get('/orders/subStore/management', [SidebarController::class, 'ordersManagementStoreIndex'])->name('orders-store-management.index');
    Route::get('/orders/subStore/management/${id}', [SidebarController::class, 'ordersManagementStoreIndexSelected'])->name('orders-selected.index');

    // Routes Profile Store
    Route::get('/profile/store', [SidebarController::class, 'profileStoreIndex'])->name('profile-store.index');

    // Routes Schedule Stores
    Route::get('/schedule/store', [SidebarController::class, 'scheduleStoresIndex'])->name('schedule-stores.index');
    Route::get('/schedule/store/${id}', [SidebarController::class, 'scheduleStoresIndexSelected'])->name('schedule-stores-selected.index');
    Route::get('schedule/create/${subStore}', [ScheduleController::class, 'create'])->name('schedule.create');
});

// Middleware Role Administrator Kairapp
Route::middleware(['auth', 'checkAdminKairapp'])->group(function () {
    // Routes Management Stores
    Route::get('/stores/management', [SidebarController::class, 'storesManagementIndex'])->name('stores-management.index');
    Route::get('store/create', [StoreController::class, 'createStore'])->name('store.create');

    // Routes Management SubStores
    Route::get('subStore/create/${id}', [StoreController::class, 'createSubStore'])->name('subStore.create');
    Route::get('subStore/edit/${id}', [SubStoreController::class, 'update'])->name('subStore.edit');
    Route::get('store/sucursals/${id}', [StoreController::class, 'sucursalsIndex'])->name('store.sucursals.index');
    Route::get('wizard', function () {
        return view('sidebarScreens.storesManagement.store.create');
    });
    // Routes Management Orders
    Route::get('/orders/management', [SidebarController::class, 'ordersManagementIndex'])->name('orders-management.index');
    Route::get('order/create', [OrderController::class, 'createOrder'])->name('order.create');

    Route::get('/get/stores', [StoreController::class, 'obtainStores']);

    // Route Google Maps
    Route::get('/load-google-maps-script', [GoogleMapsController::class, 'loadScript'])->name('load-google-maps-script');
});

// Comun Routes
Route::middleware('auth', 'checkStore')->group(function () {
    // Route Change Password
    Route::get('/change/password', [PasswordController::class, 'changePasswordAuthIndex'])->name('change-password.index');
    Route::get('/support', [SidebarController::class, 'supportIndex'])->name('support.index');
    Route::get('/orders/subStore/management', [SidebarController::class, 'ordersManagementStoreIndex'])->name('orders-store-management.index');
});

Route::middleware(['auth', 'selectedStore'])->group(function () {
    // Routes Check Store
    Route::get('/stores', [UserController::class, 'userStores'])->middleware(['auth', 'verified'])->name('stores');
    Route::get('/stores/{id}', [StoreController::class, 'index'])->name('store.index');
});

require __DIR__.'/auth.php';
