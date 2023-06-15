<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Concerns\FromCollection;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Http\Controllers\UploadFileController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    $data = DB::table('test_data')->get();
    return view('welcome', compact('data'));
});



// excel import/export        //controller          //function inside   //whatt is called in blade


 Route::post('/uploadfileX', [UploadFileController::class, 'index'])->name('PostUploadFile');

Route::get('ex', function()
{
    # Show Text that its here and running 
    #return "Excel Test PaGE";
    $users = DB::table('test_data')->get();
    #dd($users);
    #toarray
// Specify the column names to exclude
    $excludedColumns = ['id','created_at', 'updated_at'];

    // Convert the data to an array cause Spread sheets need this format
    $myarray = [];
    $columnNames = [];
    foreach ($users as $index => $user) {
        // Extract keys from the first object and use them as column headers
        if ($index === 0) {
            $columnNames = array_diff(array_keys(get_object_vars($user)), $excludedColumns);
            $myarray[] = $columnNames;
        }
    $rowData = [];
        
        foreach ($columnNames as $columnName) {
            $rowData[] = $user->$columnName;
        }
        $myarray[] = $rowData;   
}
    // dd($myarray);
    #save to excel


    if ($myarray==null){

        $myarray=[['name','level','class','parent_number']];
    }

    $spreadsheet = new Spreadsheet();
    $activeWorksheet = $spreadsheet->getActiveSheet();
    $activeWorksheet->fromArray($myarray[0], NULL, 'A1'); # save to excel at startign at A1
    $writer = new Xlsx($spreadsheet);
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="Pendaftaran.xlsx"');
    header('Cache-Control: max-age=0');
    $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
    $writer->save('php://output');

})->name('exportUser');



