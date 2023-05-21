<?php

declare(strict_types=1);

namespace Growpro;

/**
 * Class Task
 * @package Growpro
 */
class Task
{
    public const SORT_DESC = 'DESC';
    public const SORT_ASC = 'ASC';

    /**
     * Ejercicio 1: Expresiones regulares (A)
     *
     * @param string $text
     * @return array
     */
    public function getIdentifierNumeric(string $text): array
    {
        preg_match_all('/[0-9]+/', $text, $matches);

        return $matches[0];
    }

    /**
     * Ejercicio 1: Expresiones regulares (B)
     *
     * @param string $text
     * @return string
     */
    public function replacePattern(string $text): string
    {
        return preg_replace("/\[(.*?)\]\([^)]+\)/", "$1", $text);
    }

    /**
     * Ejercicio 2: Manipulación de arrays
     *
     * @param array $a
     * @param array $b
     * @param array $sortCriterion
     * @return mixed|null
     */
    public function compare(array $a, array $b, array $sortCriterion)
    {
        $result = null;
        foreach ($sortCriterion as $key => $order) {
            if (!array_key_exists($key, $a) || !array_key_exists($key, $b)) {
                continue;
            }
            if ($a[$key] !== $b[$key]) {
                if (self::SORT_ASC === $order) {
                    $result = $a[$key] - $b[$key];
                    break;
                } elseif (self::SORT_DESC === $order) {
                    $result = $b[$key] - $a[$key];
                    break;
                }
            }
        }

        return $result;
    }

    /**
     * Ejercicio 2: Manipulación de arrays
     *
     * @param array $dataset
     * @param array|null $sortCriterion
     * @return array
     */
    public function sortByCriterion(array $dataset, array $sortCriterion = null): array
    {
        if (empty($sortCriterion)) {
            return $dataset;
        }
        usort($dataset, function ($a, $b) use ($sortCriterion) {
            return $this->compare($a, $b, $sortCriterion);
        });

        return $dataset;
    }
}

