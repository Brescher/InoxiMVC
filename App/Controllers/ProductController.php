<?php

namespace App\Controllers;

use App\Config\Configuration;
use App\Core\Responses\Response;
use App\Models\Product;

class ProductController extends AControllerRedirect
{

    public function index()
    {
        $this->redirect("home");
    }

    public function product()
    {
        $products = Product::getAll();
        return $this->html(
            [
                'products' => $products
            ]
        );
    }

    public function updateProduct()
    {
        return $this->html();
    }

    public function upload(){
        if (isset($_FILES['file'])) {
            if ($_FILES["file"]["error"] == UPLOAD_ERR_OK) {
                session_start();
                $fileName = date('Y-m-d-H-i-s_') . ($_FILES['file']['name']);
                move_uploaded_file($_FILES['file']['tmp_name'], Configuration::UPLOAD_DIR . "$fileName");
                $name = $_POST["name"];
                $material = $_POST["material"];
                $desc = $_POST["description"];

                $namelen = strlen($name);
                $materiallen = strlen($material);
                $desclen = strlen($desc);
                if($namelen  > 150 || $namelen < 10 || $materiallen > 200 || $materiallen < 10 || $desclen > 500 || $desclen < 50){
                    $this->redirect("product", "product");
                    exit();
                }
                $newProduct = new Product();
                $newProduct->setName($name);
                $newProduct->setMaterial($material);
                $newProduct->setDescription($desc);
                $newProduct->setImage($fileName);
                $newProduct->save();
                $this->redirect('product', 'product');
            }
        }
    }

    public function deleteProduct()
    {
        $productId = $this->request()->getValue('productid');
        if($productId > 0) {
            session_start();
            $username = "becho";
            if(strcmp($_SESSION['username'], $username) === 0 ){
                $product = Product::getOne($productId);
                $name = $product->getImage();
                unlink(Configuration::UPLOAD_DIR . "$name");
                $product->delete();
            }
            $this->redirect('product', 'product');
        }
    }

    public function update()
    {
        if (isset($_FILES['file'])) {
            $id = $this->request()->getValue('productid');
            $name = $_POST['name'];
            $material = $_POST['material'];
            $desc = $_POST['description'];

            $namelen = strlen($name);
            $materiallen = strlen($material);
            $desclen = strlen($desc);
            if($namelen  > 150 || $namelen < 10 || $materiallen > 200 || $materiallen < 10 || $desclen > 500 || $desclen < 50){
                $this->redirect("product", "product");
                exit();
            }

            $newproduct = new Product();
            $newproduct->setId($id);
            $newproduct->setName($name);
            $newproduct->setMaterial($material);
            $newproduct->setDescription($desc);

            if ($_FILES["file"]["error"] == UPLOAD_ERR_OK) {
                $name = date('Y-m-d-H-i-s_') . $_FILES['file']['name'];
                move_uploaded_file($_FILES['file']['tmp_name'], Configuration::UPLOAD_DIR . "$name");

                $oldProduct = Product::getOne($id);
                $oldName = $oldProduct->getImage();
                unlink(Configuration::UPLOAD_DIR . "$oldName");

                $newproduct->setImage($name);
                $newproduct->save();
            } else {   //ak nie je aktualizovany obrazok, tak sa zoberie stary
                $product = Product::getOne($id);
                $image = $product->getImage();
                $newproduct->setImage($image);
                $newproduct->save();
            }
        }
        $this->redirect("product", "product");
    }
}