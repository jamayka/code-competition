<?php

class ChickenTest extends PHPUnit_Framework_TestCase
{

    public function testChickenProgramIsReallyChicken() {
        $this->assertSame(
            '',
            trim(
                str_replace(
                    'chicken',
                    '',
                    chicken_paginator_source(1, 1, 1, 1)
                )
            )
        );
    }

}
