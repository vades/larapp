<?php
declare(strict_types=1);


namespace App\Services\Import;

use Illuminate\Support\Facades\Log;

class PostService
{
    # region PROPERTIES
    # endregion PROPERTIES

    # region PROPERTY_ACCESSORS
    # endregion PROPERTY_ACCESSORS

    # region METHODS
    public static function process(): void
    {

        throw new \Exception('An Error from post service');
        /* Log::info('Importing posts to the database');
        dd('Importing posts to the database');*/

    }
    # endregion METHODS
}