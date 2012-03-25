<?php
namespace MyMR\Tests;

use \MyMR\Progress;

use \SymfonyX\Component\Console\Output\SpyOutput;

class ProgressTest extends \PHPUnit_Framework_Testcase
{
    /**
     * @test
     * @dataProvider provideInputsOfProgress
     */
    public function progress_should_work_correctly($max, $inputs, $expected)
    {
        $spy = new SpyOutput;
        $progress = new Progress($max, $spy);
        foreach ($inputs as $input) {
            $progress->setCurrentPosition($input);
        }
        $this->assertEquals($expected, $spy->getMessage());
    }

    public function provideInputsOfProgress()
    {
        $data = array();

        $data[] = array(
            1,
            array(1),
            "0/1   (0%)" . PHP_EOL .
            "1/1 (100%)". PHP_EOL
        );

        $data[] = array(
            10,
            range(1, 10),
            "  0/10   (0%)" . PHP_EOL .
            " 10/10  (10%)" . PHP_EOL .
            " 20/10  (20%)" . PHP_EOL .
            " 30/10  (30%)" . PHP_EOL .
            " 40/10  (40%)" . PHP_EOL .
            " 50/10  (50%)" . PHP_EOL .
            " 60/10  (60%)" . PHP_EOL .
            " 70/10  (70%)" . PHP_EOL .
            " 80/10  (80%)" . PHP_EOL .
            " 90/10  (90%)" . PHP_EOL .
            "100/10 (100%)" . PHP_EOL
        );

        return $data;
    }
}
