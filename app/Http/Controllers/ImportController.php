<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use SplFileObject;

class ImportController extends Controller
{
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt',
        ]);

        $file = $request->file('file')->getRealPath();
        $csvData = file_get_contents($file);

        $lines = explode("\n", $csvData);
        foreach ($lines as $line) {
            $data = str_getcsv($line);
            User::create([
                'firstname' => $data[0],
                'lastname' => $data[1],
                'email' => $data[2],
                'phone' => $data[3],
                'password' => $data[4],
                'date_of_birth' => $data[5],
                'educational_qualification' => $data[6],
                'photo' => $data[7],
                'resume' => $data[0],

            ]);
        }

        return redirect()->back()->with('success', 'Data imported successfully.');
    }
}
