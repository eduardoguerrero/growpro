<?php

declare(strict_types=1);

namespace Growpro\tests;

use Growpro\Task;
use PHPUnit\Framework\TestCase;

/**
 * Class TaskTest
 * @package Tests
 */
class TaskTest extends TestCase
{
    /** @var Task */
    protected $task;

    /**
     * This method is called before each test
     * @return void
     */
    protected function setUp(): void
    {
        $this->task = new Task();
    }

    /**
     * Run after each test
     * @return void
     */
    protected function tearDown(): void
    {
        $this->task = null;
    }

    /**
     * @dataProvider identifierNumericDataProvider
     * @param string $text
     * @param array $expected
     * @return void
     */
    public function testGetIdentifierNumeric(string $text, array $expected): void
    {
        $this->assertEqualsCanonicalizing($expected, $this->task->getIdentifierNumeric($text));
    }

    /**
     * @return array
     */
    public function identifierNumericDataProvider(): array
    {
        return
            [
                'title1' => [
                    'Hola @[Franklin](user-gpe-1071) avisa a @[Ludmina](user-gpe-1061)',
                    [1071, 1061]
                ],
                'title2' => [
                    'Hola @[Franklin](user-gpe-1061) avisa a @[Ludmina](user-gpe-1071) y @[Juan](user-gpe-1099)',
                    [1071, 1061, 1099]
                ],
            ];
    }

    /**
     * @dataProvider replacePatternDataProvider
     * @param string $text
     * @param string $expected
     * @return void
     */
    public function testReplacePattern(string $text, string $expected): void
    {
        $this->assertEquals($expected, $this->task->replacePattern($text));
    }

    /**
     * @return array
     */
    public function replacePatternDataProvider(): array
    {
        return
            [
                'title1' => [
                    'Hola @[Franklin](user-gpe-1071) avisa a @[Ludmina](user-gpe-1061)',
                    'Hola @Franklin avisa a @Ludmina'
                ],
                'title2' => [
                    '@[Franklin](user-gpe-1072) y @[Ludmina](user-gpe-1062)',
                    '@Franklin y @Ludmina'
                ],
                'title3' => [
                    '@[Franklin](user) avisa a @[Ludmina](user)',
                    '@Franklin avisa a @Ludmina',
                    ['age' => 'DESC', 'height' => 'DESC']
                ],
            ];
    }

    /**
     * @return void
     */
    public function testSortByCriterion(): void
    {
        $dataset = [
            ['user' => 'Oscar', 'age' => 18, 'scoring' => 40],
            ['user' => 'Mario', 'age' => 45, 'scoring' => 10],
            ['user' => 'Zulueta', 'age' => 33, 'scoring' => -78],
            ['user' => 'Mario', 'age' => 45, 'scoring' => 78],
            ['user' => 'Patricio', 'age' => 22, 'scoring' => 9],
        ];
        $sortDataset = $this->task->sortByCriterion($dataset, ['age' => 'DESC', 'scoring' => 'DESC']);
        $this->assertIsArray($sortDataset);
        $this->assertEquals(45, $sortDataset[0]['age']);
        $this->assertEquals(45, $sortDataset[1]['age']);
        $this->assertEquals(33, $sortDataset[2]['age']);
        $this->assertEquals(22, $sortDataset[3]['age']);
        $this->assertEquals(18, $sortDataset[4]['age']);
        $this->assertEquals(78, $sortDataset[0]['scoring']);
        $this->assertEquals(10, $sortDataset[1]['scoring']);
        $this->assertEquals(-78, $sortDataset[2]['scoring']);
        $this->assertEquals(9, $sortDataset[3]['scoring']);
        $this->assertEquals(40, $sortDataset[4]['scoring']);
    }

}
