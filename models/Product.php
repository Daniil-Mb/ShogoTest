<?php
class Product {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAllSections() {
        $stmt = $this->db->prepare("SELECT * FROM product_section WHERE visible = 1 ORDER BY position ASC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getAllTypes() {
        $stmt = $this->db->prepare("SELECT * FROM product_type WHERE visible = 1 ORDER BY position ASC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getFilteredProducts($sectionId = null, $typeId = null) {
        $query = "SELECT p.* FROM product p
                  JOIN product_assignment pa ON p.id = pa.product_id
                  WHERE p.visible = 1 AND pa.visible = 1";
        $params = [];
    
        if ($sectionId) {
            $query .= " AND pa.section_id = :section_id";
            $params[':section_id'] = $sectionId;
        }
    
        if ($typeId) {
            $query .= " AND pa.type_id = :type_id";
            $params[':type_id'] = $typeId;
        }
    
        $query .= " ORDER BY p.position ASC";
        $stmt = $this->db->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM product_view WHERE product_id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        try {
            $this->db->beginTransaction();
    
            $stmt = $this->db->prepare("SELECT MAX(position) as max_position FROM product");
            $stmt->execute();
            $max_position = $stmt->fetch(PDO::FETCH_ASSOC)['max_position'];
    
            $new_position = $max_position + 1;
    
            $stmt = $this->db->prepare("INSERT INTO product (position, url, name, articul, price, price_old, notice, content, visible)
                                        VALUES (:position, :url, :name, :articul, :price, :price_old, :notice, :content, :visible)");
            $stmt->bindParam(':position', $new_position);
            $stmt->bindParam(':url', $data['url']);
            $stmt->bindParam(':name', $data['name']);
            $stmt->bindParam(':articul', $data['articul']);
            $stmt->bindParam(':price', $data['price']);
            $stmt->bindParam(':price_old', $data['price_old']);
            $stmt->bindParam(':notice', $data['notice']);
            $stmt->bindParam(':content', $data['content']);
            $stmt->bindParam(':visible', $data['visible']);
            $stmt->execute();
    
            $productId = $this->db->lastInsertId();
    
            $stmt = $this->db->prepare("INSERT INTO product_assignment (product_id, section_id, type_id, visible)
                                        VALUES (:product_id, :section_id, :type_id, :visible)");
            $stmt->bindParam(':product_id', $productId);
            $stmt->bindParam(':section_id', $data['section_id']);
            $stmt->bindParam(':type_id', $data['type_id']);
            $stmt->bindParam(':visible', $data['visible']);
            $stmt->execute();
    
            $this->db->commit();
            return true;
        } catch (Exception $e) {
            $this->db->rollBack();
            return false;
        }
    }   
}
?>
