<?php

use App\Http\Controllers\Consumables;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'consumables', 'middleware' => ['auth']], function () {
    Route::get(
        '{consumablesID}/checkout',
        [Consumables\ConsumableCheckoutController::class, 'create']
    )->name('consumables.checkout.show');

    Route::post(
        '{consumablesID}/checkout',
        [Consumables\ConsumableCheckoutController::class, 'store']
    )->name('consumables.checkout.store');

    Route::post(
        '{consumableId}/upload',
        [Consumables\ConsumablesFilesController::class, 'store']
    )->name('upload/consumable');

    Route::delete(
        '{consumableId}/deletefile/{fileId}',
        [Consumables\ConsumablesFilesController::class, 'destroy']
    )->name('delete/consumablefile');

    Route::get(
        '{consumableId}/showfile/{fileId}/{download?}',
        [Consumables\ConsumablesFilesController::class, 'show']
    )->name('show.consumablefile');

    Route::get(
        '{consumablesID}/history',
        [Consumables\ConsumablesController::class, 'history']
    )->name('consumables.history');
});

Route ::group(['prefix' => 'consumablestransaction', 'middleware' => ['auth']], function() {

    Route::get('{consumablesID}/getDataConsumables', [Consumables\ConsumablesTransactionController::class, 'getDataConsumables']);

});
    
Route::resource('consumables', Consumables\ConsumablesController::class, [
    'middleware' => ['auth'],
    'parameters' => ['consumable' => 'consumable_id'],
]);

Route::resource('transactiondashboard', Consumables\TransactionDashboardController::class, [
    'middleware' => ['auth'],
    'parameters' => ['transactiondashboard' => 'transactiondashboard'],
]);

Route::resource('consumablestransaction', Consumables\ConsumablesTransactionController::class, [
    'middleware' => ['auth'],
    'parameters' => ['consumabletransaction' => 'transaction_id'],
]);
