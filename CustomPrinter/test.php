<?php


class Test
{
    private $a = 1;
    protected $b = 2;
    public $c = 3;
    protected $arr = [1,2,3];
}

class TestChild extends Test
{
    private $my_a = 24;
    protected $b = 5;
}

$arr = ['1', 2, null, new Test(), 'arr' => [
    1,
    2,
    3 => [
        'more' => 1,
        'tv' => 2,
        'child' => new TestChild
    ]
]
];

\Merexo\CustomPrinter::print_r($arr, true);