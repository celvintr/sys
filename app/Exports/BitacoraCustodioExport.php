<?php

namespace App\Exports;

use App\Models\BitacoraCustodio;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class BitacoraCustodioExport implements FromView, ShouldAutoSize
{
    use Exportable;
    protected $bitacoras;

    public function __construct($bitacoras = null)
    {
        $this->bitacoras = $bitacoras;
    }

     /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('bitacoracustodio.bitacorasexcel', [
            'bitacoras' => $this->bitacoras,
        ]);
    }
}
