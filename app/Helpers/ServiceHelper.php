<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Cache;

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

    public static function clearCache($model)
    {
        // You need to know the range of pages that might have been cached
        // Assuming up to 100 pages were cached, you can loop through and clear them
        for ($page = 1; $page <= 100; $page++) {
            for ($limit = 10; $limit <= 50; $limit += 10) {
                $cacheKey = "{$model}_page_{$page}_limit_{$limit}";
                Cache::forget($cacheKey);
            }
        }
    }
}
