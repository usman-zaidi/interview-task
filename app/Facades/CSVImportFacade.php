<?php

// app/Facades/CSVImportFacade.php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class CSVImportFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'csv-import';
    }
}
