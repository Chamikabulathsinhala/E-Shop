<?php

require "connection.php";

?>

<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Update Product | eShop</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />

    <link rel="icon" href="resource/logo.svg" />
</head>

<body>

    <div class="container-fluid">
        <div class="row gy-3">
            <?php include "header.php";

            if (isset($_SESSION["u"])) {
                if (isset($_SESSION["p"])) {

            ?>

                    <hr />

                    <div class="col-12">
                        <div class="row">

                            <div class="col-12 text-center">
                                <h2 class="h2 text-primary fw-bold">Update My Products</h2>
                            </div>

                            <div class="col-12">
                                <div class="row">

                                    <div class="col-12 col-lg-4 border-end border-dark">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label fw-bold" style="font-size: 20px;">Select Product Category</label>
                                            </div>
                                            <div class="col-6 col-lg-4 offset-3 offset-lg-4">
                                                <select class=" form-select text-center" disabled>
                                                    <?php

                                                    $product = $_SESSION["p"];

                                                    $category_rs = Database::search("SELECT * FROM `category` WHERE `id` = '" . $product["category_id"] . "'");
                                                    $category_data = $category_rs->fetch_assoc();

                                                    ?>
                                                    <option><?php echo $category_data["name"]; ?></option>

                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-4 border-end border-dark">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label fw-bold" style="font-size: 20px;">Select Product Brand</label>
                                            </div>
                                            <div class="col-6 col-lg-4 offset-3 offset-lg-4">
                                                <select class=" form-select text-center" disabled>
                                                    <?php

                                                    $brand_rs = Database::search("SELECT brand_has_model.id,`brand`.`id` AS `bid`,`brand`.`name` FROM `brand_has_model` 
                                                    INNER JOIN `brand` ON `brand`.`id` = `brand_has_model`.`brand_id` WHERE `brand_has_model`.`id`='" . $product["brand_has_model_id"] . "'");
                                                    $brand_data = $brand_rs->fetch_assoc();

                                                    ?>
                                                    <option><?php echo $brand_data["name"]; ?></option>

                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-4">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label fw-bold" style="font-size: 20px;">Select Product Model</label>
                                            </div>
                                            <div class="col-6 col-lg-4 offset-3 offset-lg-4">
                                                <select class=" form-select text-center" disabled>
                                                    <?php

                                                    $model_rs = Database::search("SELECT brand_has_model.id,`model`.`id` AS `mid`,`model`.`name` FROM `brand_has_model` 
                                                    INNER JOIN `model` ON `model`.`id` = `brand_has_model`.`model_id` WHERE `brand_has_model`.`id`='" . $product["brand_has_model_id"] . "'");
                                                    $model_data = $model_rs->fetch_assoc();

                                                    ?>
                                                    <option><?php echo $model_data["name"]; ?></option>

                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <hr class="border-dark" style="border-width: 3px;" />
                                    </div>

                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label fw-bold" style="font-size: 20px;">
                                                    Add a Title to your Product
                                                </label>
                                            </div>
                                            <div class="offset-0 offset-lg-2 col-12 col-lg-8">

                                                <?php

                                                $title_rs = Database::search("SELECT `title` FROM `product` WHERE `id` = '" . $product["id"] . "'");
                                                $title_data = $title_rs->fetch_assoc();

                                                ?>

                                                <input type="text" class="form-control" value="<?php echo $title_data["title"]; ?>" id="t" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <hr class="border-dark" style="border-width: 3px;" />
                                    </div>

                                    <div class="col-12">
                                        <div class="row">

                                            <div class="col-12 col-lg-4 border-end border-dark">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label class="form-label fw-bold" style="font-size: 20px;">Select Product Condition</label>
                                                    </div>

                                                    <div class="col-12">
                                                        <?php

                                                        $condition_rs = Database::search("SELECT * FROM `condition` WHERE `id`='" . $product["condition_id"] . "';");
                                                        $condition_data = $condition_rs->fetch_assoc();
                                                        $condition = $condition_data["name"];

                                                        if ($condition == "Brand New") {
                                                        ?>
                                                            <div class="form-check form-check-inline offset-1 col-5">
                                                                <input class="form-check-input" type="radio" name="c" id="b" checked disabled>
                                                                <label class="form-check-label" for="b">
                                                                    Brand New
                                                                </label>
                                                            </div>
                                                            <div class="form-check form-check-inline col-5">
                                                                <input class="form-check-input" type="radio" name="c" id="u" disabled>
                                                                <label class="form-check-label" for="u">
                                                                    Used
                                                                </label>
                                                            </div>
                                                        <?php

                                                        } else {

                                                        ?>

                                                            <div class="form-check form-check-inline offset-1 col-5">
                                                                <input class="form-check-input" type="radio" name="c" id="b" disabled>
                                                                <label class="form-check-label" for="b">
                                                                    Brand New
                                                                </label>
                                                            </div>
                                                            <div class="form-check form-check-inline col-5">
                                                                <input class="form-check-input" type="radio" name="c" id="u" checked disabled>
                                                                <label class="form-check-label" for="u">
                                                                    Used
                                                                </label>
                                                            </div>

                                                        <?php

                                                        }

                                                        ?>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-12 col-lg-4 border-end border-dark">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label class="form-label fw-bold" style="font-size: 20px;">Select Product Colour</label>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="row col-6 col-lg-4 offset-3 offset-lg-4">

                                                            <select class=" form-select text-center" disabled>
                                                                <?php

                                                                $clr_rs = Database::search("SELECT * FROM `colour` WHERE `id` = '" . $product["colour_id"] . "'");
                                                                $clr_data = $clr_rs->fetch_assoc();

                                                                ?>
                                                                <option><?php echo $clr_data["name"]; ?></option>

                                                            </select>

                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="input-group mt-2 mb-2">
                                                            <input type="text" class="form-control" placeholder="Add New Colour" disabled />
                                                            <button class="btn btn-outline-primary" type="button" id="button-addon2" disabled>+ Add</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12 col-lg-4">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label class="form-label fw-bold" style="font-size: 20px;">Add Product Quantity</label>
                                                    </div>
                                                    <div class="col-12">

                                                        <?php

                                                        $qty_rs = Database::search("SELECT `qty` FROM `product` WHERE `id` = '" . $product["id"] . "'");
                                                        $qty_data = $qty_rs->fetch_assoc();

                                                        ?>

                                                        <input type="number" class="form-control" value="<?php echo $qty_data["qty"]; ?>" min="0" id="q" />
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <hr class="border-dark" style="border-width: 3px;" />
                                    </div>

                                    <div class="col-12">
                                        <div class="row">

                                            <div class="col-6 border-end border-dark">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label class="form-label fw-bold" style="font-size: 20px;">Cost Per Item</label>
                                                    </div>
                                                    <div class="offset-0 offset-lg-2 col-12 col-lg-8">
                                                        <div class="input-group mb-2 mt-2">
                                                            <span class="input-group-text">Rs.</span>

                                                            <?php

                                                            $cost_rs = Database::search("SELECT `price` FROM `product` WHERE `id` = '" . $product["id"] . "'");
                                                            $cost_data = $cost_rs->fetch_assoc();

                                                            ?>

                                                            <input type="text" class="form-control" value="<?php echo $cost_data["price"]; ?>" disabled />
                                                            <span class="input-group-text">.00</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label class="form-label fw-bold" style="font-size: 20px;">Approved Payment Methods</label>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="row">
                                                            <div class="offset-0 offset-lg-2 col-2 pm pm1"></div>
                                                            <div class="col-2 pm pm2"></div>
                                                            <div class="col-2 pm pm3"></div>
                                                            <div class="col-2 pm pm4"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <hr class="border-dark" style="border-width: 3px;" />
                                    </div>

                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label fw-bold" style="font-size: 20px;">Delivery Cost</label>
                                            </div>
                                            <div class="col-12 col-lg-6 border-end border-dark">
                                                <div class="row">
                                                    <div class="col-12 offset-lg-1 col-lg-3">
                                                        <label class="form-label">Delivery cost within Colombo</label>
                                                    </div>
                                                    <div class="col-12 col-lg-8">
                                                        <div class="input-group mb-2 mt-2">
                                                            <span class="input-group-text">Rs.</span>

                                                            <?php

                                                            $dwc_rs = Database::search("SELECT `delivery_fee_colombo` FROM `product` WHERE `id` = '" . $product["id"] . "'");
                                                            $dwc_data = $dwc_rs->fetch_assoc();

                                                            ?>

                                                            <input type="text" class="form-control" value="<?php echo $dwc_data["delivery_fee_colombo"]; ?>" id="dwc" />
                                                            <span class="input-group-text">.00</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12 col-lg-6">
                                                <div class="row">
                                                    <div class="col-12 offset-lg-1 col-lg-3">
                                                        <label class="form-label">Delivery cost out of Colombo</label>
                                                    </div>
                                                    <div class="col-12 col-lg-8">
                                                        <div class="input-group mb-2 mt-2">
                                                            <span class="input-group-text">Rs.</span>

                                                            <?php

                                                            $doc_rs = Database::search("SELECT `delivery_fee_other` FROM `product` WHERE `id` = '" . $product["id"] . "'");
                                                            $doc_data = $doc_rs->fetch_assoc();

                                                            ?>

                                                            <input type="text" class="form-control" value="<?php echo $doc_data["delivery_fee_other"]; ?>" id="doc" />
                                                            <span class="input-group-text">.00</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <hr class="border-dark" style="border-width: 3px;" />
                                    </div>

                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label fw-bold" style="font-size: 20px;">Product Description</label>
                                            </div>
                                            <div class="col-12">

                                                <?php

                                                $desc_rs = Database::search("SELECT `description` FROM `product` WHERE `id` = '" . $product["id"] . "'");
                                                $desc_data = $desc_rs->fetch_assoc();

                                                ?>

                                                <textarea class="form-control" cols="30" rows="15" id="d"><?php echo $desc_data["description"]; ?></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <hr class="border-dark" style="border-width: 3px;" />
                                    </div>

                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label fw-bold" style="font-size: 20px;">Add Product Images</label>
                                            </div>
                                            <div class="offset-lg-3 col-12 col-lg-8">

                                                <?php

                                                $img = array();
                                                $img[0] = "resource/addproductimg.svg";
                                                $img[1] = "resource/addproductimg.svg";
                                                $img[2] = "resource/addproductimg.svg";

                                                $image_rs = Database::search("SELECT * FROM `images` WHERE `product_id` = '" . $product["id"] . "'");
                                                $image_num = $image_rs->num_rows;

                                                for ($x = 0; $x < $image_num; $x++) {
                                                    $image_data = $image_rs->fetch_assoc();
                                                    $img[$x] = $image_data["code"];
                                                }

                                                ?>

                                                <div class="row gap-3">
                                                    <div class="col-3 border border-primary rounded">
                                                        <img src="<?php echo $img[0]; ?>" class="img-fluid" style="height: 270px;" id="i0" />
                                                    </div>
                                                    <div class="col-3 border border-primary rounded">
                                                        <img src="<?php echo $img[1]; ?>" class="img-fluid" style="height: 270px;" id="i1" />
                                                    </div>
                                                    <div class="col-3 border border-primary rounded">
                                                        <img src="<?php echo $img[2]; ?>" class="img-fluid" style="height: 270px;" id="i2" />
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="offset-lg-3 col-12 col-lg-2 d-grid mt-3">
                                                <input type="file" class="d-none" id="imageuploader" multiple />
                                                <label for="imageuploader" class="col-12 btn btn-primary" onclick="changeProductImage();">Upload Images</label>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <hr class="border-dark" style="border-width: 3px;" />
                                    </div>

                                    <div class="offset-lg-4 col-12 col-lg-4 d-grid mt-3 mb-3">
                                        <button class="btn btn-success" onclick="updateProduct();">Update Product</button>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>

            <?php

                } else {
                    header("Location:myProduct.php");
                }
            } else {
                header("Location:home.php");
            }

            ?>

            <?php include "footer.php"; ?>
        </div>
    </div>

    <script src="script.js"></script>
    <script src="bootstrap.bundle.js"></script>
</body>

</html>