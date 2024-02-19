<?php
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

Route::get('/contacts', [ContactController::class, 'index'])->name('index.contact');
Route::post('/contact/add', [ContactController::class, 'create'])->name('create.contact');
Route::get('/contact/edit/{id}', [ContactController::class, 'edit'])->name('contact.edit');
Route::put('/contact/update/{id}', [ContactController::class, 'update'])->name('contact.update');
Route::get('/contact/delete/{id}', [ContactController::class, 'delete'])->name('contact.delete');
Route::get('/contact/link/{id}', [ContactController::class, 'createContactLink'])->name('create.contact-link');
Route::post('/contact/create/link/{id}', [ContactController::class, 'storeContactLink'])->name('create.client.link');
Route::get('/contact/unlink/{contactId}/{clientId}', [ContactController::class, 'deleteContactLink'])->name('contact.unlink.client');