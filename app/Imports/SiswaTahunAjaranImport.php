<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class SiswaTahunAjaranImport implements ToCollection
{
    public function __construct($tahun_ajaran)
    {
        $this->tahun_ajaran = $tahun_ajaran;
    }

    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {

    }
}
