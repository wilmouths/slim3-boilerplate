<?php

namespace App\Utils;

/**
 * Paginator.php
 *
 * Create pagination
 *
 * @package    Utils
 * @author     WILMOUTH Steven
 * @version    1
 */
class Paginator
{

    /**
     * Returns a pagination table
     * @param int $perPage elements per page
     * @param int $total total of elements
     * @param int $currentPage current page
     * @return array
     */
    public static function paginate($perPage, $total, $currentPage) {
        $pagination = [
            'currentPage' => (!is_null($currentPage) ? $currentPage : 1),
            'lastPage' => ((ceil($total / $perPage) == 0) ? 1 : ceil($total / $perPage))
        ];
        return $pagination;
    }

}