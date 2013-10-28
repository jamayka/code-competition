<?php

namespace Navigator;

function currentPage($offset, $maxRowsPerPage)
{
    return intval(floor($offset / $maxRowsPerPage) + 1);
}

function maxPage($total, $maxRowsPerPage)
{
    return intval(ceil($total / $maxRowsPerPage));
}

function navigatorByRows($offset, $total, $maxRowsPerPage, $maxNavigatorSize) {
    if (!$total) {
        return '[1]';
    }

    return navigatorByPages(
        currentPage($offset, $maxRowsPerPage),
        maxPage($total, $maxRowsPerPage),
        $maxNavigatorSize
    );
}

function navigatorByPages($currentPage, $maxPage, $maxNavigatorSize)
{
    // comments for $currentPage = 3, $maxPage = 6, $maxNavigatorSize = 5
    return implode(
        " ",
        \__::chain(\__::range($maxNavigatorSize - 1, -$maxNavigatorSize, -1))                             // [ 4, 3, 2, 1, 0, -1 -2 -3 -4 ]
            ->sortBy(function ($a) { return abs($a); })                                                   // [ 0, 1, -1, 2, -2, 3, -3, 4, -4 ]
            ->map(function($i) use ($currentPage) { return $currentPage + $i; })                          // [ 3, 4, 2, 5, 1, 6, 0, 7, -1 ]
            ->reject(function ($i) use ($maxPage) { return $i > $maxPage || $i < 1 ; })                   // [ 3, 4, 2, 5, 1, 6 ]
            ->first($maxNavigatorSize)                                                                    // [ 3, 4, 2, 5, 1 ]
            ->sortBy(function ($a) { return $a; })                                                        // [ 1, 2, 3, 4, 5 ]
            ->map(function ($v) use ($currentPage) { return $v === $currentPage ? '[' . $v . ']' : $v; }) // [ 1, 2, '[3]', 4, 5 ]
            ->value()
    );

}
