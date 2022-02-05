<?php
session_set_cookie_params(0);
session_start();
?>
<div class="row">
    <div class="col">
        <form method="post" enctype="multipart/form-data" action="?c=product&a=update&productid=<?php echo $productID = $_GET['productid']; ?>" onsubmit=" return validate(this)">
            <div>
                <?php
                $productID = $_GET['productid'];
                $product = \App\Models\Product::getOne($productID);
                ?>
                <input type="text" name="name" id="name" class="textfield" placeholder="Názov produktu..." value="<?php  echo $product->getName()?>" required><br>
                <input type="text" name="material" id="material" class="textfield" placeholder="Materiál..." value="<?php  echo $product->getMaterial()?>" required><br>
                <textarea name="description" id="description" class="textfield" placeholder="Popis..." multiple required><?php  echo $product->getDescription()?></textarea>
                <div class="mb-3">
                    <input name="file" class="form-control" id="formFile" type="file" placeholder="Obrázok...">
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary"">Odoslať</button>
                </div>
            </div>
        </form>
        <p id="error_para" ></p>
    </div>
</div>