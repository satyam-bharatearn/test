<?php

use App\Http\Controllers\NewController;
use App\Services\PDF2Text;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Smalot\PdfParser\Parser;
use Spatie\PdfToText\Pdf;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('show-input',function(){
    return '
        <form action="/show-input" method="post" enctype="multipart/form-data">
            '.csrf_field().'
            <input type="file" name="myfile">
            <input type="text" name="password">
            <button type="submit">Upload</button>
        </form>
    ';
});
Route::get('/video-call', function () {
    return view('welcome');
});


// Route::post('/show-input',function(Request $request){
//     // $obj = new PDF2Text();
//     // $obj->setFilename($request->file('myfile'));
//     // $obj->decodePDF();
//     // dd($obj->output());    
//     // $text = Pdf::getText($request->file('myfile'));
//     $request->validate([
//         'myfile' => 'required|mimes:pdf',
//     ]);
//     $file = $request->myfile;
//     // $config = new \Smalot\PdfParser\Config();
//     // $config->setIgnoreEncryption(false);
//     // $pdfParser = new Parser([],$config);
//     // $pdf = $pdfParser->parseFile($file->path());
//     // // if($pdf->hasPass)
//     // $text = $pdf->getText();
//     // $text = preg_replace('/ {3,}/', "\n", $text);
//     // return nl2br($text);    
// });
Route::post('/show-input',[NewController::class,'index']);

// Jobs routes
Route::resource('jobs', App\Http\Controllers\JobController::class);
Route::get('/jobs/new', [App\Http\Controllers\JobController::class, 'create'])->name('jobs.new');
