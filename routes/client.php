<?php
use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Route;


Route::get('/', [ClientController::class, 'index'])->name('index.client');
Route::post('/client/add', [ClientController::class, 'create'])->name('create.client');
Route::get('/client/edit/{id}', [ClientController::class, 'edit'])->name('client.edit');
Route::put('/client/update/{id}', [ClientController::class, 'update'])->name('client.update');
Route::get('/client/delete/{id}', [ClientController::class, 'delete'])->name('client.delete');
Route::get('/client/link/{id}', [ClientController::class, 'link'])->name('contact.link');
Route::get('/client/link/{id}', [ClientController::class, 'createClientLink'])->name('create.client-link');
Route::post('/client/create/link/{id}', [ClientController::class, 'storeClientLink'])->name('create.contact.link');
Route::get('/client/unlink/{clientId}/{contactId}', [ClientController::class, 'deleteClientLink'])->name('client.unlink.contact');
// Route::get('/contact-link/create/{id}', [ClientController::class, 'createClientLinkInfo'])->name('create.client-link.info');