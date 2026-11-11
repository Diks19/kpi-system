<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PerformanceAppraisalExportController;

Route::redirect('/', '/admin');

Route::middleware('auth')->get(
  '/performance-appraisals/export',
  [PerformanceAppraisalExportController::class, 'export']
)->name('performance-appraisals.export');
