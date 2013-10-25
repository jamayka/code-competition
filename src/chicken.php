<?php

function chicken_paginator_source($offset, $total, $maxRowsPerPage, $maxNavigatorSize) {
    return sprintf(
        file_get_contents(__DIR__ . '/paginator.chicken'),
        str_repeat(' chicken', intval($offset)),
        str_repeat(' chicken', intval($total)),
        str_repeat(' chicken', intval($maxRowsPerPage)),
        str_repeat(' chicken', intval($maxNavigatorSize))
    );
}
