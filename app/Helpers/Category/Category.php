<?php

namespace App\Helpers\Category;

use App\Helpers\Container;

class Category
{

    public static string $tpl;

    public static function getMenu(string $tpl, string $cacheKey = '')
    {
        self::$tpl = $tpl;
        if ($cacheKey) {
            $menuHtml = cache($cacheKey, '');
            if ($menuHtml) {
                return $menuHtml;
            }
        }

        $categoriesData = self::getCategories();
        $categoriesTree = self::getTree($categoriesData);
        $menuHtml = self::getHtml($categoriesTree);

        if ($cacheKey) {
            cache([$cacheKey => $menuHtml], now()->addDay());
        }
        return $menuHtml;
    }

    public static function getTree($data): array {
        $categoriesTree = [];
        foreach ($data as $id => &$node) {
            if (!$node['parent_id']) {
                $categoriesTree[$id] = &$node;
            } else {
                $data[$node['parent_id']]['children'][] = &$node;
            }
        }
        return $categoriesTree;
    }

    public static function getHtml(array $tree, $tab = ''): string
    {
        $str = '';
        foreach ($tree as $id => $item) {
            $str .= self::item2Tpl($item, $tab, $id);
        }

        return $str;
    }

    public static function item2Tpl($item, $tab, $id): string
    {
        ob_start();
        echo view(self::$tpl, ['item' => $item, 'tab' => $tab, 'id' => $id]);
        return ob_get_clean();
    }

    public static function getCategories()
    {
        $categoriesData = Container::get('categoriesData');
        if (!$categoriesData) {
            $categoriesData = \App\Models\Category::all()->keyBy('id')->toArray();
            Container::set('categoriesData', $categoriesData);
        }
        return $categoriesData;
    }

}
