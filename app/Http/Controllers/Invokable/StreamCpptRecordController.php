<?php

namespace App\Http\Controllers\Invokable;

use App\Http\Controllers\Controller;
use App\Models\Cppt;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class StreamCpptRecordController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke($id)
    {
        $model = Cppt::with(['patient', 'hospital'])->findOrFail($id);
        return Pdf::loadView('pdf.cppt-pdf', ['data' => $model])->stream();
    }
}
