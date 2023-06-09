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

 Route::get('users/export/', [UsersController::class, 'export'])->name('users.export');
 Route::post('/uploadfileX', [UploadFileController::class, 'index'])->name('PostUploadFile');


Route::get('ex', function()
{
    # Show Text that its here and running 
    #return "Excel Test PaGE";
    $users = DB::table('test_data')->get();
    #dd($users);
    #toarray
// Specify the column names to exclude
    $excludedColumns = ['password', 'remember_token', 'created_at', 'updated_at','email_verified_at'];

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

    $spreadsheet = new Spreadsheet();
    $activeWorksheet = $spreadsheet->getActiveSheet();
    $activeWorksheet->fromArray($myarray, NULL, 'A1'); # save to excel at startign at A1
    $writer = new Xlsx($spreadsheet);
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="Pendaftaran.xlsx"');
    header('Cache-Control: max-age=0');
    $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
    $writer->save('php://output');

})->name('exportUser');

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




// https://phpspreadsheet.readthedocs.io/en/latest/topics/reading-files/
Route::POST('im', function()
{
    $inputFileName = './sampleData/example1.xls';

    /** Load $inputFileName to a Spreadsheet Object  **/
    $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileName);

    /** Create a new Xls Reader  **/
    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
    //    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
    //    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xml();
    //    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Ods();
    //    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Slk();
    //    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Gnumeric();
    //    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
    /** Load $inputFileName to a Spreadsheet Object  **/
    $spreadsheet = $reader->load($inputFileName);

})->name('importUser');