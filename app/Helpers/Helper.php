<?php

namespace App\Helpers;

class Helper
{
    /**
     * Get the depth of deeply nested array
     *
     * @param array $array      Nested array
     * @param string $key       Key of child to assess and do recursive checking
     * @return int              Depth of the array from parent
     */
    public static function arrayDepth($array, $key)
    {
        $maxDepth = 1;

        foreach ($array as $value) {
            $childArray = $value[$key] ?? [];

            if (is_array($childArray)) {
                $depth = self::arrayDepth($childArray, $key) + 1;

                if ($depth > $maxDepth) $maxDepth = $depth;
            }
        }

        return $maxDepth;
    }
}