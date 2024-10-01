<?php

namespace App\Helpers;

class ServiceHelper
{
    public static function customPagination($data)
    {
        return [
            'total' => $data->total(),
            'count' => $data->count(),
            'per_page' => $data->perPage(),
            'current_page' => $data->currentPage(),
            'total_pages' => $data->lastPage()
        ];
    }
}
