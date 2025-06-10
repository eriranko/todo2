<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use Symfony\Component\HttpFoundation\StreamedResponse;

class CsvDownloadController extends Controller
{

    //CSV出力
    public function downloadCsv()
    {
        $todos = Todo::with('category', 'point')->all(['id', 'content', 'category', 'todo', 'deadline']);
        $csvHeader = ['id', 'content', 'category_name', 'point_level', 'deadline'];
        $csvData = $todos->toArray();

        $response = new StreamedResponse(function () use ($csvHeader, $csvData) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, $csvHeader);

            foreach ($csvData as $row) {
                fputcsv($handle, $row);
            }

            fclose($handle);
        }, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="users.csv"',
        ]);

        return $response;
    }

    public function csv() {

    }

}
