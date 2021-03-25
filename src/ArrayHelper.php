<?php
namespace Fast\Api\Permission;

use Illuminate\Support\Collection;

class ArrayHelper
{
    public static function getColumnAsArray(Collection $collection, $column){
        return array_reduce($collection->toArray(), function ($carry, $item) use ($column){
            $carry[] = $item[$column];
            return $carry;
        },[]);
    }

    public static function getColumnArray(Collection $collection, $column){
        return array_reduce($collection->toArray(), function ($carry, $item) use ($column){
            $temp = [];
            foreach ($item as $key=>$value){
                if (in_array($key, $column)){
                    $temp[$key] = $item[$key];
                }
            }
            array_push($carry,$temp);

            return $carry;
        },[]);
    }

    /**
     * 获取菜单目录树
     * @param array $menus
     * @param array $result
     * @param int $pid
     */
    public static function traverseMenu(array $menus, array &$result, $pid = 0)
    {
        foreach ($menus as $child_menu) {
            if ($child_menu['parent_id'] == $pid) {
                $item = ['value' => $child_menu['id'], 'label' => $child_menu['title'], 'children' => []];
                self::traverseMenu($menus, $item['children'], $child_menu['id']);
                $result[] = $item;
            } else {
                continue;
            }
        }
    }

    /**
     * 获取权限目录树
     * @param array $permissions
     * @param array $result
     * @param int $pid
     */
    public static function traversePermission(array $permissions, array &$result, $pid = 0)
    {
        foreach ($permissions as $child_permission) {
            if ($child_permission['parent_id'] == $pid) {
                $item = ['value' => $child_permission['id'], 'label' => $child_permission['name'], 'children' => []];
                self::traversePermission($permissions, $item['children'], $child_permission['id']);
                $result[] = $item;
            } else {
                continue;
            }
        }
    }
}
