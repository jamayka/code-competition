<?php

namespace Navigator;

class functionsTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider currentPageProvider
     */
    public function testCurrentPage($offset, $maxRowsPerPage, $expected)
    {
        $this->assertSame($expected, currentPage($offset, $maxRowsPerPage));
    }

    public function currentPageProvider()
    {
        return array(
            array(0, 10, 1),
            array(10, 10, 2),
            array(9, 10, 1),
            array(69, 10, 7),
        );
    }

// ---------------------------------------------------------------------------------------------------------------------

    public function testMaxPage()
    {
        $this->assertSame(101, maxPage(1004, 10));
    }

// ---------------------------------------------------------------------------------------------------------------------

    /**
     * @dataProvider navigatorByPagesProvider
     */
    public function testNavigatorByPages($expected, $currentPage, $maxPage, $maxNavigatorSize)
    {
        $this->assertSame($expected, navigatorByPages($currentPage, $maxPage, $maxNavigatorSize));
    }

    public function navigatorByPagesProvider()
    {
        return array(
            ['[1]', 1, 1, 5],
            ['[1] 2', 1, 2, 5],
            ['[1] 2 3', 1, 3, 5],
            ['[1] 2 3 4', 1, 4, 5],
            ['[1] 2 3 4 5', 1, 5, 5],
            ['[1] 2 3 4 5', 1, 6, 5],
            ['[1] 2 3 4 5', 1, 7, 5],
            ['1 [2] 3 4 5', 2, 7, 5],
            ['1 2 [3] 4 5', 3, 7, 5],
            ['2 3 [4] 5 6', 4, 7, 5],
            ['3 4 [5] 6 7', 5, 7, 5],
            ['3 4 5 [6] 7', 6, 7, 5],
            ['3 4 5 6 [7]', 7, 7, 5],

            ['[1]', 1, 1, 5],
            ['1 [2]', 2, 2, 5],
            ['9 10 [11] 12 13', 11, 50, 5],
            ['16 17 18 19 [20]', 20, 20, 5],
            ['6 7 8 [9] 10 11 12', 9, 20, 7],
            ['14 15 16 17 18 19 [20]', 20, 20, 7]
        );
    }

// ---------------------------------------------------------------------------------------------------------------------

    public function testNavigatorByRowsReturnsOnePageIfTotalIsEmpty()
    {
        $this->assertSame('[1]', navigatorByRows(0, 0, 10, 5));
    }

// ---------------------------------------------------------------------------------------------------------------------

    public function testNavigatorByRows()
    {
        $this->assertSame('14 15 16 17 18 [19] 20', navigatorByRows(471, 500, 25, 7));
    }

}
