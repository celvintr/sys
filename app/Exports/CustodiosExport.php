<?php

namespace App\Exports;

use App\Models\Custodios;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class CustodiosExport implements FromView, ShouldAutoSize
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
