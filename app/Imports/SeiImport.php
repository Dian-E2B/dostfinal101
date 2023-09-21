<?php

namespace App\Imports;

use App\Models\Gender;
use App\Models\Programs;
use App\Models\Scholars;
use App\Models\Sei;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Support\Facades\dd;

use function Psy\debug;

class SeiImport implements ToModel, WithBatchInserts
{



    public function model(array $row)
    {

        $existingRecord = Sei::where('spasno', $row[0])->first();

        // Check if the data in the first column (index 0) starts with "U"
        if (!str_starts_with($row[0], 'U')) {
            // If it doesn't start with "U", return null to skip inserting this row
            return null;
        } elseif ($existingRecord) {
            return null;
        }
        //FOR GENDER
        $genderValue = $row[8]; // Assuming this is the word from the Excel row
        //        if ($genderValue === 'M') {
        //            $genderValue = 'Male';
        //        }
        //        elseif ($genderValue === 'F'){
        //            $genderValue = 'Female';
        //        }
        $gender = Gender::where('name', $genderValue)->first();
        $genderId = $gender ? $gender->id : null;  // If a gender is found, use its ID; otherwise, use a default value


        //FOR PROVINCE
        // $provincefindvalue = $row[17]; 
        // $provincefindvaluetrimmed = $provincefindvalue;
        // $provincegetvalue = Provinces::whereRaw('TRIM(provname) = ?', $provincefindvaluetrimmed)->first();
        // $provinceID = $provincegetvalue ? $provincegetvalue->id : null;  // If a province is found, use its ID; otherwise, use a default value

        //FOR MUNICIPALITY
        // $municipalityfindvalue = $row[16]; 
        // $municipalityfindvaluetrimmed = $municipalityfindvalue;
        // $municipalityID = Municipalities::where('provincial_id', $provinceID)
        //     ->whereRaw('TRIM(muname) = ?', [$municipalityfindvaluetrimmed])
        //     ->value('id');

        //PROGRAM_ID
        $programfindvalue = $row[3]; //excel row
        $programfindvaluetrimmed = $programfindvalue;
        $programgetvalue = Programs::whereRaw('TRIM(progname) = ?', $programfindvaluetrimmed)->first();
        $programID = $programgetvalue ? $programgetvalue->id : null;

        //BIRTHDAY 
        $serialNumber = $row[9];
        $excelBaseDate = 25569; // Excel's base date (January 1, 1900) EEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEE

        // Convert Excel serial number to Unix timestamp
        $unixTimestamp = ($serialNumber - $excelBaseDate) * 86400; // 86400 seconds in a day

        // Convert Unix timestamp to a human-readable date
        $excelDate = date('Y-m-d', $unixTimestamp);

        //dd($excelDate);


        // SEIS TABLE
        $sei = new Sei([
            'spasno' => $row[0],
            'app_id' => $row[1],
            'strand' => $row[2],
            'program_id' => $programID,
            'gender_id' => $genderId,
            'province' => $row[17],
            'municipality' => $row[16],
            'barangay' => $row[15],
            'houseno' => $row[12],
            'street' => $row[13],
            'zipcode' => $row[18],
            'district' => $row[19],
            'region' => $row[20],
            'hsname' => $row[21],
            'lacking' => $row[22],
            'remarks' => $row[23],
        ]);

        $sei->save();


        // SCHOLAR TABLE
        $scholar = new Scholars([
            'spasno' => $sei->spasno,
            'lname' => $row[4],
            'fname' => $row[5],
            'mname' => $row[6],
            'suffix' => $row[7],
            'bday' => $excelDate,
            'email' => $row[10],
            'mobile' => $row[11]

        ]);
        if (!empty($row[22])) {
            $scholar->scholar_status_id = 0; // Set status_id to Lacking
        } else {
            // Set status_id to a default value if needed
            $scholar->scholar_status_id = 1; //pending
        }

        $scholar->save();
    }


    public function batchSize(): int
    {
        return 100;
    }
}
