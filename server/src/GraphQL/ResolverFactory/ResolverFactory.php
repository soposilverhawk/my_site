<?php

namespace App\GraphQL\ResolverFactory;

use App\Core\Database;
use App\GraphQL\Resolvers\CategoryResolver;
use App\GraphQL\Resolvers\OrderResolver;
use App\GraphQL\Resolvers\ProductResolver;
use App\Repositories\CategoryRepository;
use App\Repositories\OrderRepository;
use App\Repositories\ProductRepository;
use App\Services\Category\CategoryService;
use App\Services\Order\OrderService;
use App\Services\Product\ProductService;

class ResolverFactory
{
    private static ?Database $db = null;

    private static function getDatabase(): Database
    {
        if (self::$db === null) {
            self::$db = new Database();
        }
        return self::$db;
    }

    public static function makeCategoryResolver(): CategoryResolver
    {
        $db = self::getDatabase();
        $repo = new CategoryRepository($db);
        $service = new CategoryService($repo);
        return new CategoryResolver($service);
    }

    public static function makeProductResolver(): ProductResolver
    {
        $db = self::getDatabase();
        $repo = new ProductRepository($db);
        $service = new ProductService($repo);
        return new ProductResolver($service);
    }

    public static function makeOrderResolver(): OrderResolver
    {
        $db = self::getDatabase();
        $orderRepo = new OrderRepository($db);
        $productRepo = new ProductRepository($db);
        $productService = new ProductService($productRepo);
        $orderService = new OrderService($orderRepo, $productService);
        return new OrderResolver($orderService, $productService);
    }
}