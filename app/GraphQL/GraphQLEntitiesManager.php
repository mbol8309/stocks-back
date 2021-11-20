<?php

namespace App\GraphQL;

use Exception;
use Illuminate\Support\Facades\Log;

use function PHPUnit\Framework\directoryExists;

const ENTITIES_FOLDER = 'Entities';
const ENTITYNAME = 'Entity';
const CLASSMETHOD = 'getEntity';
const CLASSMETHODTYPE = 'getTypes';
const BASECLASSPATH = 'App\\GraphQL\\';

class GraphQLEntitiesManager
{

    public static function getGlobalTypes()
    {
        $types = [];

        $class_entities = GraphQLEntitiesManager::getEntitiesClass();
        foreach ($class_entities as $classname) {
            if (method_exists($classname, CLASSMETHODTYPE)) {
                try {
                    $entity_type = call_user_func([$classname, CLASSMETHODTYPE]);
                    $types = array_merge($types, $entity_type);
                } catch (Exception $e) {
                    Log::error("Exception executing function: [$classname,{CLASSMETHOD}]");
                }
            }
        }
        return $types;
    }


    public static function getEntitiesClass()
    {
        $CURR_DIR = dirname(__FILE__);
        $dir = $CURR_DIR . '/' . ENTITIES_FOLDER;

        $entities = [];

        if (directoryExists($dir)) {
            $dirs = scandir($dir);
            if (is_array($dirs)) {
                foreach ($dirs as $d) {
                    $curr = $dir . '/' . $d;
                    if (!is_dir($curr) || $d == '.' || $d == '..') continue;
                    $classname = BASECLASSPATH . ENTITIES_FOLDER . '\\' . $d . '\\' . $d . ENTITYNAME;
                    if (class_exists($classname)) {
                        array_push($entities, $classname);
                    }
                }
            }
        }
        return $entities;
    }


    public static function parseSchemas(): array
    {
        $schemas = [];

        $class_entities = GraphQLEntitiesManager::getEntitiesClass();
        foreach ($class_entities as $classname) {
            if (method_exists($classname, CLASSMETHOD)) {
                try {
                    $entity = call_user_func([$classname, CLASSMETHOD]);
                    $schemas = array_merge_recursive($schemas, $entity);
                } catch (Exception $e) {
                    Log::error("Exception executing function: [$classname,{CLASSMETHOD}]");
                }
            }
        }

        return GraphQLEntitiesManager::remove_duplicates($schemas);
    }

    public static function remove_duplicates(&$schema)
    {
        $arrays = [];
        $strings = [];

        foreach ($schema as $key => &$value) {
            if (is_array($value)) {
                $arrays[$key] = $value;
            } else {
                $strings[$key] = $value;
            }
        }

        foreach ($arrays as $key => $value) {
            $arrays[$key] = GraphQLEntitiesManager::remove_duplicates($arrays[$key]);
        }
        return array_merge($arrays, array_unique($strings));
    }
}
