<?php

declare(strict_types=1);

namespace Mcbeany\Spyglass;

use Mcbeany\Spyglass\item\Spyglass;
use pocketmine\item\ItemFactory;
use pocketmine\network\mcpe\convert\ItemTranslator;
use pocketmine\plugin\PluginBase;
use ReflectionClass;
use const pocketmine\RESOURCE_PATH;

class Main extends PluginBase
{

    public function onEnable()
    {
        $runtimeIds = json_decode(file_get_contents(RESOURCE_PATH . '/vanilla/required_item_list.json'), true);
        $itemIds = json_decode(file_get_contents(RESOURCE_PATH . '/vanilla/item_id_map.json'), true);
        $itemIds["minecraft:spyglass"] = Spyglass::SPYGLASS;
        $itemId = $itemIds["minecraft:spyglass"];
        $runtimeId = $runtimeIds["minecraft:spyglass"]["runtime_id"];

        $reflectionClass = new ReflectionClass(ItemTranslator::getInstance());
        $property = $reflectionClass->getProperty("simpleCoreToNetMapping");
        $property->setAccessible(true);
        $value = $property->getValue(ItemTranslator::getInstance());
        $value[$itemId] = $runtimeId;
        $property->setValue(ItemTranslator::getInstance(), $value);

        $property = $reflectionClass->getProperty("simpleNetToCoreMapping");
        $property->setAccessible(true);
        $value = $property->getValue(ItemTranslator::getInstance());
        $value[$runtimeId] = $itemId;
        $property->setValue(ItemTranslator::getInstance(), $value);

        ItemFactory::registerItem(new Spyglass(), true);
        // TODO: Crafting recipe
    }

}
