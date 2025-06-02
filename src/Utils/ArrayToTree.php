<?php

namespace Ninjacode\UI\Utils;

class ArrayToTree
{
    public static function convert(array $data, array $options = [])
    {
        $options = array_merge([
            'parentProperty' => 'parent_id',
            'childrenProperty' => 'children',
            'customID' => 'id',
            'rootID' => '0',
        ], $options);

        // Подготавливаем данные, ключом будет customID
        $data = collect($data)->keyBy($options['customID']);

        // Группируем элементы по parentProperty
        $grouped = $data->groupBy($options['parentProperty']);

        // Создаем дерево начиная с корневых узлов
        $tree = self::buildTree($grouped, $grouped->get($options['rootID'], collect()), $options);

        return $tree->values()->all();
    }

    protected static function buildTree($grouped, $items, $options)
    {
        return $items->map(function ($item) use ($grouped, $options) {
            try {
                $children = $grouped->get($item[$options['customID']], collect());

                if ($children->isNotEmpty()) {
                    $item[$options['childrenProperty']] = self::buildTree($grouped, $children, $options);
                }

                return $item;
            } catch (\Throwable $e) {
                // Обработка ошибок, если необходимо
                return null;
            }
        });
    }
}
