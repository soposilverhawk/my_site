<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Core\Database;
use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
use App\Repositories\AttributeRepository;
use App\Services\AttributeImporter;
use App\Services\Product\ProductImporter;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();
$database = new Database();
$pdo = $database->connect();
$jsonData = json_decode(file_get_contents(__DIR__ . '/../data/products.json'), true);
$categoryRepo = new CategoryRepository($database);
$productRepo = new ProductRepository($database);
$attributeRepo = new AttributeRepository($pdo);
$attributeImporter = new AttributeImporter($attributeRepo);
$productImporter = new ProductImporter($categoryRepo, $productRepo);
$productImporter->import($jsonData);


echo "Database populated successfully!";