<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewController extends Controller
{
    public function index(Request $request)
    {
        $file = $request->file('myfile');
        $escapedPath = escapeshellarg($file->getPathname());
        $string = explode('.',$file->getClientOriginalName());
        $filename = "$string[0].txt";
        $escapedPassword = $request->password ? escapeshellarg($request->password) : '';
        $pythonScript = base_path('Extra/extractor.py');
        $command = "python $pythonScript $escapedPath $escapedPassword $filename";
        $output = shell_exec($command);
        $data = json_decode($output, true);
        if (isset($data['error'])) {
            return response()->json(['status' => false, 'message' => $data['error']]);
        }
        // return $data['raw_text'];
        return $data;
    }
}
