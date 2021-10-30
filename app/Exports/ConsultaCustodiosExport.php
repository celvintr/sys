<?php

namespace App\Exports;

use App\Models\Custodios;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;

class ConsultaCustodiosExport extends \PhpOffice\PhpSpreadsheet\Cell\StringValueBinder implements FromView, ShouldAutoSize, WithCustomValueBinder
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;
    protected $custodios;

    public function __construct($custodios = null)
    {
        $this->custodios = $custodios;
    }

     /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('custodios.custodiosexcel', [
            'custodios' => $this->custodios,
        ]);
    }
}
