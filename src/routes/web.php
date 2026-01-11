use App\Http\Controllers\ImageToPdfController;

Route::get('/', function () {
    return redirect('/img2pdf');
});

Route::get('/img2pdf', [ImageToPdfController::class, 'form']);
Route::post('/img2pdf', [ImageToPdfController::class, 'convert']);
