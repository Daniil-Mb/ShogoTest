<?php
require_once 'models/Product.php';

class ProductController {

    public function index() {
        $productModel = new Product();
    
        $sectionId = isset($_GET['section']) ? $_GET['section'] : null;
        $typeId = isset($_GET['type']) ? $_GET['type'] : null;
    
        $sections = $productModel->getAllSections();
        $types = $productModel->getAllTypes();
        $products = $productModel->getFilteredProducts($sectionId, $typeId);
    
        require 'views/product/index.php';
    }
    
    public function view() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $productModel = new Product();
            $product = $productModel->getById($id);
            require 'views/product/view.php';
        } else {
            header('Location: index.php');
        }
    }

    public function create() {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?controller=user&action=login");
            exit();
        }
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $url = $_POST['url'] ?? null;
            $name = $_POST['name'] ?? null;
            $articul = $_POST['articul'] ?? null;
            $price = $_POST['price'] ?? null;
            $price_old = $_POST['price_old'] ?? null;
            $notice = $_POST['notice'] ?? null;
            $content = $_POST['content'] ?? null;
            $visible = $_POST['visible'] ?? 1; 
            $section_id = $_POST['section_id'] ?? null;
            $type_id = $_POST['type_id'] ?? null;
    
            if ($url && $name && $articul && $price !== null && $price_old !== null) {
                $db = Database::getInstance()->getConnection();
    
                $stmt = $db->prepare("SELECT COUNT(*) FROM product WHERE url = ?");
                $stmt->execute([$url]);
                $count = $stmt->fetchColumn();
    
                if ($count > 0) {
                    echo "Ошибка: URL должен быть уникальным.";
                } else {
                    $stmt = $db->prepare("INSERT INTO product (url, name, articul, price, price_old, notice, content, visible) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                    $stmt->execute([$url, $name, $articul, $price, $price_old, $notice, $content, $visible]);
    
                    if ($stmt) {
                        $product_id = $db->lastInsertId();
                        $stmt = $db->prepare("INSERT INTO product_assignment (product_id, section_id, type_id, visible) VALUES (?, ?, ?, ?)");
                        $stmt->execute([$product_id, $section_id, $type_id, $visible]);
                        header("Location: index.php");
                    } else {
                        echo "Ошибка при добавлении товара.";
                    }
                }
            } else {
                echo "Пожалуйста, заполните все обязательные поля.";
            }
        } else {
            $db = Database::getInstance()->getConnection();
            $sections = $db->query("SELECT * FROM product_section WHERE visible = 1")->fetchAll(PDO::FETCH_ASSOC);
            $types = $db->query("SELECT * FROM product_type WHERE visible = 1")->fetchAll(PDO::FETCH_ASSOC);
    
            require_once('views/product/create.php');
        }
    } 
}
?>
