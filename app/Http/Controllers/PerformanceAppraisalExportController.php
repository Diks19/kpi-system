<?php

namespace App\Http\Controllers;

use App\Exports\PerformanceAppraisalsExport;
use Maatwebsite\Excel\Facades\Excel;

class PerformanceAppraisalExportController extends Controller
{
    public function export()
    {
        return Excel::download(
            new PerformanceAppraisalsExport(),
            'laporan-penilaian-' . now()->format('Y-m-d') . '.xlsx'
        );
    }
}
