<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\TestData;

use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Schema;
class UploadFileController extends Controller {


   public function index(Request $request) {
    $file = $request->file('xlsx');


    if ($file ==null) {
        return redirect()->back()->with('error', 'please select a file');

    }



     # dd( $request); CHECK WHAT IS UPLOADED
      #dd($file );
      //Move Uploaded File
      $destinationPath = storage_path('app/uploads');

      // Read the uploaded XLSX file
      $filePath = $destinationPath . "/temp.xlsx";
      $file->move($destinationPath, "temp.xlsx");

      $spreadsheet = IOFactory::load($filePath);
      
      // Do something with the spreadsheet data
      $worksheet = $spreadsheet->getActiveSheet();
      $data = $worksheet->toArray();

      
    #load all and delete all
        

      
      // Drop and recreate the "testdata" table
    // //   Schema::dropIfExists('test_data');
    //   Schema::create('test_data', function ($table) {
    //      $table->increments('id');
    //      $table->string('column1')->default('');
    //      $table->double('column2')->default(0);
    //      $table->string('column3')->default('');
    //      // Add more columns as needed
    //      $table->timestamps();
    //   });

      // Insert data into the "testdata" table
      $firstRowSkipped = false;

      foreach ($data as $row) {
          if (!$firstRowSkipped) {
                $firstRowSkipped = true;
                continue;
          }
                //skiping the first row


                  
               if  (
                  
                  (TestData::
                  where('name', $row[0])->
                  where('level', $row[1])->
                  where('class', $row[2])->
                  where('parent_number', $row[3])->
                  get()->
                  count()) > 0) {
                        continue;    
                  }  
// Iterate over the retrieved records
// Access attributes using $one->attribute_name
         $newdat = TestData::create([
            'name' => $row[0], // Replace 'column1' with the actual column name in your table
            'level' => $row[1],
            'class' => $row[2],
            'parent_number' => $row[3], 
            // Add more columns as needed
         ]);
         $newdat->save();  
      }
      return redirect()->back()->with('message', 'File uploaded successfully.');
   }


}