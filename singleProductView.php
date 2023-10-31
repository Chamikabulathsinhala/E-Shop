<?php

require "connection.php";

if (isset($_GET["id"])) {

    $pid = $_GET["id"];

    $product_rs = Database::search("SELECT product.category_id,product.brand_has_model_id,product.colour_id,product.price,product.qty,product.description,product.title,
    product.condition_id,product.status_id,product.user_email,product.datetime_added,product.delivery_fee_colombo,product.delivery_fee_other,model.name AS mname,
    brand.name AS bname FROM `product` INNER JOIN `brand_has_model` ON brand_has_model.id = brand_has_model_id INNER JOIN `brand` ON brand.id = brand_has_model.brand_id 
    INNER JOIN `model` ON model.id = brand_has_model.model_id WHERE product.id ='" . $pid . "'");

    $product_num = $product_rs->num_rows;

    if ($product_num == 1) {

        $product_data = $product_rs->fetch_assoc();

?>

        <!DOCTYPE html>

        <html>

        <head>

            <!-- Meta Tags Start -->
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <!-- Meta Tag End -->

            <title><?php echo $product_data["title"]; ?></title>

            <link rel="stylesheet" href="bootstrap.css" /><!-- Bootstrap CSS File Link -->
            <link rel="stylesheet" href="style.css" /><!-- CSS File Link -->
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css"><!-- Bootstrap Icon Link -->

            <link rel="icon" href="resource/logo.svg">

        </head>

        <body>

            <div class="container-fluid">
                <div class="row">

                    <?php include "header.php"; ?>

                    <div class="col-12 mt-0 bg-white singleProduct">
                        <div class="row">
                            <div class="col-12">
                                <div class="row">

                                    <div class="col-12 col-lg-2 order-2 order-lg-1">
                                        <ul>

                                            <?php

                                            $image_rs = Database::search("SELECT * FROM `images` WHERE `product_id` ='" . $pid . "'");
                                            $image_num = $image_rs->num_rows;
                                            $img = array();

                                            if ($image_num != 0) {

                                                for ($x = 0; $x < $image_num; $x++) {

                                                    $image_data = $image_rs->fetch_assoc();
                                                    $img[$x] = $image_data["code"];

                                            ?>

                                                    <li class="d-flex flex-column justify-content-center align-items-center border-danger border-1 border-secondary mb-1">
                                                        <img src="<?php echo $img["$x"]; ?>" class="img-thumbnail mt-1 mb-1" style="height: 150px; width: auto;" id="productImg<?php echo $x; ?>" onclick="loadMainImg(<?php echo $x; ?>);" />
                                                    </li>

                                                <?php

                                                }
                                            } else {

                                                ?>

                                                <li class="d-flex flex-column justify-content-center align-items-center border-danger border-1 border-secondary mb-1">
                                                    <img src="resource/empty.svg" class="img-thumbnail mt-1 mb-1" />
                                                </li>
                                                <li class="d-flex flex-column justify-content-center align-items-center border-danger border-1 border-secondary mb-1">
                                                    <img src="resource/empty.svg" class="img-thumbnail mt-1 mb-1" />
                                                </li>
                                                <li class="d-flex flex-column justify-content-center align-items-center border-danger border-1 border-secondary mb-1">
                                                    <img src="resource/empty.svg" class="img-thumbnail mt-1 mb-1" />
                                                </li>

                                            <?php

                                            }

                                            ?>

                                        </ul>
                                    </div>

                                    <div class="col-lg-4 order-2 order-lg-1 d-none d-lg-block">
                                        <div class="row">
                                            <div class="col-12 align-items-center border border-1 border-secondary">
                                                <div class="main-img" id="main-img"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-6 order-3">
                                        <div class="row">
                                            <div class="col-12">

                                                <div class="row border-bottom border-dark">
                                                    <nav aria-label="breadcrumb">
                                                        <ol class="breadcrumb">
                                                            <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                                                            <li class="breadcrumb-item active" aria-current="page">Single Product View</li>
                                                        </ol>
                                                    </nav>
                                                </div>

                                                <div class="row border-bottom border-dark">
                                                    <div class="col-12 my-0">
                                                        <span class="fs-4 text-success fw-bold"><?php echo $product_data["title"]; ?></span>
                                                    </div>
                                                </div>

                                                <div class="row border-bottom border-dark">
                                                    <div class="col-12 my-2">
                                                        <span class="badge">
                                                            <i class="bi bi-star-fill text-warning fs-5"></i>
                                                            <i class="bi bi-star-fill text-warning fs-5"></i>
                                                            <i class="bi bi-star-fill text-warning fs-5"></i>
                                                            <i class="bi bi-star-fill text-warning fs-5"></i>
                                                            <i class="bi bi-star-fill text-warning fs-5"></i>

                                                            &nbsp;&nbsp;

                                                            <label class="fs-5 text-dark fw-bold">4.5 Stars | 39 Reviews & Ratings</label>

                                                        </span>
                                                    </div>
                                                </div>

                                                <?php

                                                $price = $product_data["price"];
                                                $adding_price = ($price / 100) * 5;
                                                $new_price = $price + $adding_price;
                                                $difference = $new_price - $price;
                                                $percentage = ($difference / $price) * 100;

                                                ?>

                                                <div class="row border-bottom border-dark">
                                                    <div class="col-12 my-2">
                                                        <span class="fs-4 fw-bold text-dark">Rs.<?php echo $price; ?>.00</span>
                                                        &nbsp;&nbsp; | &nbsp; &nbsp;
                                                        <span class="fs-4 fw-bold text-danger text-decoration-line-through">Rs.<?php echo $new_price ?>.00</span>
                                                        &nbsp;&nbsp; | &nbsp; &nbsp;
                                                        <span class="fs-4 fw-bold text-black-50">Rs.<?php echo $difference; ?>.00 (<?php echo $percentage; ?>%)</span>
                                                    </div>
                                                </div>

                                                <div class="row border-bottom border-dark">
                                                    <div class="col-12 my-2">
                                                        <span class="fs-5 text-primary"><b>Warrenty : </b>6 Months Warrenty</span><br />
                                                        <span class="fs-5 text-primary"><b>Return Policy : </b>1 Months Return Policy</span><br />
                                                        <span class="fs-5 text-primary"><b>In Stock : </b><?php echo $product_data["qty"]; ?> Items Available</span><br />
                                                    </div>
                                                </div>

                                                <div class="row border-bottom border-dark">
                                                    <div class="col-12 my-2">
                                                        <div class="row g-2 g-lg-0 offset-lg-1 gap-lg-5">
                                                            <div class="col-12 col-lg-5 border border-1 border-dark text-center">

                                                                <?php

                                                                $user = Database::search("SELECT * FROM `user` WHERE `email`='" . $product_data["user_email"] . "'");
                                                                $user_data = $user->fetch_assoc();

                                                                ?>

                                                                <span class="fs-5 text-primary"><?php echo $user_data["fname"] . " " . $user_data["lname"]; ?></span>
                                                            </div>
                                                            <div class="col-12 col-lg-5 border border-1 border-dark text-center">
                                                                <span class="fs-5 text-primary"><b>Sold :</b>10 Items</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="row">
                                                            <div class="my-2 offset-lg-2 col-12 col-lg-8 border border-1 border-danger rounded">
                                                                <div class="row">
                                                                    <div class="col-3 col-lg-2 border-end border-2 border-danger">
                                                                        <img src="resource/pricetag.png" />
                                                                    </div>
                                                                    <div class="col-9 col-lg-10">
                                                                        <span class="fs-5 text-danger fw-bold">
                                                                            Stand a chance to get 5% discount by using VISA or MASTER
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="row">
                                                            <div class="col-12 my-2">
                                                                <div class="row g-2">

                                                                    <div class="border border-1 border-secondary rounded overflow-hidden float-left mt-1 position-relative product-qty">
                                                                        <div class="col-12">
                                                                            <span>Quantity : </span>
                                                                            <input type="text" class="border-0 fs-5 fw-bold text-start" style="outline: none;" pattern="[0-9]" value="1" id="qty_input" onkeyup='checkValue(<?php echo $product_data["qty"]; ?>);' />

                                                                            <div class="position-absolute border-0 qty-buttons">
                                                                                <div class="justify-content-center d-flex flex-column align-items-center border border-1 border-secondary qty-inc" onclick='qty_inc(<?php echo $product_data["qty"]; ?>)'>
                                                                                    <i class="bi bi-caret-up-fill text-primary fs-5"></i>
                                                                                </div>
                                                                                <div class="justify-content-center d-flex flex-column align-items-center border border-1 border-secondary qty-dec" onclick='qty_dec(<?php echo $product_data["qty"]; ?>)'>
                                                                                    <i class="bi bi-caret-down-fill text-primary fs-5"></i>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-12 mt-5">
                                                                            <div class="row">
                                                                                <div class="col-4 d-grid">
                                                                                    <button class="btn btn-success" type="submit" id="payhere-payment" onclick="payNow(<?php echo $pid; ?>);">Buy Now</button>
                                                                                </div>
                                                                                <div class="col-4 d-grid">
                                                                                    <button class="btn btn-primary" onclick="addToCart(<?php echo $pid; ?>);">Add To Cart</button>
                                                                                </div>
                                                                                <div class="col-4 d-grid">

                                                                                    <?php

                                                                                    if (isset($_SESSION["u"])) {

                                                                                        $watchlist_rs = Database::search("SELECT * FROM `watchlist` WHERE `product_id` = '" . $pid . "' AND `user_email` = '" . $_SESSION["u"]["email"] . "'");
                                                                                        $watchlist_num = $watchlist_rs->num_rows;

                                                                                        if ($watchlist_num == 1) {

                                                                                    ?>

                                                                                            <button class="btn btn-outline-light border-primary" onclick='addToWatchlist(<?php echo $pid; ?>);'>
                                                                                                <i class="bi bi-heart-fill text-danger fs-4" id='heart<?php echo $pid; ?>'></i>
                                                                                            </button>

                                                                                        <?php

                                                                                        } else {

                                                                                        ?>

                                                                                            <button class="btn btn-outline-light border-primary" onclick='addToWatchlist(<?php echo $pid; ?>);'>
                                                                                                <i class="bi bi-heart-fill text-dark fs-4" id='heart<?php echo $pid; ?>'></i>
                                                                                            </button>

                                                                                        <?php

                                                                                        }
                                                                                    } else {

                                                                                        ?>

                                                                                        <button class="btn btn-outline-light border-primary" onclick="window.location = 'index.php';">
                                                                                            <i class="bi bi-heart-fill text-dark fs-4"></i>
                                                                                        </button>

                                                                                    <?php

                                                                                    }

                                                                                    ?>

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-12 bg-white">
                                <div class="row me-0 mt-4 mb-3 border-bottom border-1 border-dark">
                                    <div class="col-12">
                                        <span class="fs-3 fw-bold">Related Items</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 bg-white">
                                <div class="row g-2">
                                    <div class="offset-3 offset-lg-0 col-6 col-lg-12 ">
                                        <div class="row justify-content-center gap-3">

                                            <?php

                                            $brand_rs = Database::search("SELECT * FROM `brand_has_model` WHERE `id`='" . $product_data["brand_has_model_id"] . "'");
                                            $brand_data = $brand_rs->fetch_assoc();


                                            $p_rs = Database::search("SELECT product.id AS products_id,product.title,product.price,product.qty,product.description,brand.id,brand.name AS bdname, model.name AS 
                                            mlname FROM `product` INNER JOIN `brand_has_model` ON product.brand_has_model_id = brand_has_model.id INNER JOIN `brand` ON brand.id = brand_has_model.brand_id 
                                            INNER JOIN `model` ON model.id = brand_has_model.model_id WHERE brand.id = '" . $brand_data["brand_id"] . "' LIMIT 5");
                                            $p_num = $p_rs->num_rows;

                                            for ($z = 0; $z < $p_num; $z++) {
                                                $p_data = $p_rs->fetch_assoc();

                                            ?>

                                                <div class="card mt-2 mb-2 align-items-center" style="width: 18rem;">

                                                    <?php

                                                    $image_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $p_data["products_id"] . "'");
                                                    $image_data = $image_rs->fetch_assoc();

                                                    ?>

                                                    <img src="<?php echo $image_data["code"]; ?>" class="card-img-top img-thumbnail mt-1" style="height: 150px; width: auto;" />
                                                    <div class="card-body ms-0 m-0 text-center mt-3">
                                                        <h5 class="card-title fs-6 fw-bold"><?php echo $p_data["title"]; ?> <span class="badge bg-info">New</span></h5>
                                                        <span class="card-text text-primary">Rs.<?php echo $p_data["price"]; ?>.00</span><br />

                                                        <?php

                                                        if ($p_data["qty"] > 0) {

                                                        ?>

                                                            <span class="card-text text-warning fw-bold">In Stock</span><br />
                                                            <span class="card-text text-success fw-bold"><?php echo $p_data["qty"]; ?></span><br /><br />
                                                            <a href='<?php echo "singleProductView.php?id=" . $p_data["products_id"]; ?>' class="col-12 btn btn-success">Buy Now</a>
                                                            <button class="col-12 btn btn-danger mt-2" onclick="addToCart(<?php echo $p_data['products_id']; ?>);">Add to Cart</button>

                                                        <?php

                                                        } else {

                                                        ?>

                                                            <span class="card-text text-danger fw-bold">Out of Stock</span><br />
                                                            <span class="card-text text-danger fw-bold">No Items Available</span><br /><br />
                                                            <button class="col-12 btn btn-success disabled">Buy Now</button>
                                                            <button class="col-12 btn btn-danger mt-2 disabled">Add to Cart</button>

                                                            <?php

                                                        }

                                                        if (isset($_SESSION["u"])) {

                                                            $watchlist_rs = Database::search("SELECT * FROM `watchlist` WHERE `product_id` = '" . $p_data["products_id"] . "' AND `user_email` = '" . $_SESSION["u"]["email"] . "'");
                                                            $watchlist_num = $watchlist_rs->num_rows;

                                                            if ($watchlist_num == 1) {

                                                            ?>

                                                                <button class="col-12 btn btn-outline-light mt-2 border border-info" onclick='addToWatchlist(<?php echo $p_data["products_id"]; ?>);'>
                                                                    <i class="bi bi-heart-fill text-danger fs-5" id='heart<?php echo $p_data["products_id"]; ?>'></i>
                                                                </button>

                                                            <?php

                                                            } else {

                                                            ?>

                                                                <button class="col-12 btn btn-outline-light mt-2 border border-info" onclick='addToWatchlist(<?php echo $p_data["products_id"]; ?>);'>
                                                                    <i class="bi bi-heart-fill text-dark fs-5" id='heart<?php echo $p_data["products_id"]; ?>'></i>
                                                                </button>

                                                            <?php

                                                            }
                                                        } else {

                                                            ?>

                                                            <button class="col-12 btn btn-outline-light mt-2 border border-info" onclick="window.location = 'index.php';">
                                                                <i class="bi bi-heart-fill text-dark fs-5"></i>
                                                            </button>

                                                        <?php

                                                        }

                                                        ?>

                                                    </div>
                                                </div>

                                            <?php

                                            }

                                            ?>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6 bg-white">
                                <div class="row me-0 mt-4 mb-3 border-bottom border-1 border-dark border-end">
                                    <div class="col-12">
                                        <span class="fs-3 fw-bold">Product Details</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6 bg-white">
                                <div class="row me-0 mt-4 mb-3 border-bottom border-1 border-dark border-end">
                                    <div class="col-12">
                                        <span class="fs-3 fw-bold">Feedbacks</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6 bg-white">
                                <div class="row">

                                    <div class="col-12 col-lg-6">
                                        <div class="row">
                                            <div class="col-3">
                                                <label class="form-label fs-4 fw-bold">Brand : </label>
                                            </div>
                                            <div class="col-9">
                                                <label class="form-label fs-4"><?php echo $product_data["bname"]; ?></label>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-12 col-lg-6">
                                        <div class="row">
                                            <div class="col-3">
                                                <label class="form-label fs-4 fw-bold">Model : </label>
                                            </div>
                                            <div class="col-9">
                                                <label class="form-label fs-4"><?php echo $product_data["mname"]; ?></label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label fs-4 fw-bold">Product Description : </label>
                                            </div>
                                            <div>
                                                <textarea cols="60" rows="10" class="form-control" readonly><?php echo $product_data["description"]; ?></textarea>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-6">
                                <div class="row border border-1 border-dark rounded me-0 overflow-scroll" style="height: 300px;">

                                    <?php

                                    $feedback_rs = Database::search("SELECT * FROM `feedback` WHERE `product_id`='" . $pid . "'");
                                    $feedback_num = $feedback_rs->num_rows;

                                    if ($feedback_num == 0) {

                                    ?>

                                        <div class="col-12 mt-1 mb-1 mx-1">
                                            <div class="row border border-1 border-dark rounded me-0">
                                                <div class="col-12 text-center">
                                                    <span class="text-center"><i class="bi bi-binoculars" style="font-size: 140px;"></i></span>
                                                </div>
                                                <div class="col-12 mb-3 ms-0 text-center">
                                                    <span class="text-black-50 fs-1">No feedbacks yet..</span>
                                                </div>
                                            </div>
                                        </div>

                                    <?php

                                    } else {

                                        for ($i=0; $i < $feedback_num; $i++) { 

                                        $feedback_data = $feedback_rs->fetch_assoc();

                                        $buyer_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $feedback_data["user_email"] . "'");
                                        $buyer_data = $buyer_rs->fetch_assoc();

                                    ?>

                                        <div class="col-12 mt-1 mb-1 mx-1">
                                            <div class="row border border-1 border-dark rounded me-0">
                                                <div class="col-10 mt-2 mb-2 ms-0 p-2">
                                                    <span class="fw-bold fs-5"><?php echo $buyer_data["fname"] . " " . $buyer_data["lname"]; ?></span>
                                                </div>
                                                <div class="col-2 mt-2 mb-2 me-0 p-2">

                                                    <?php

                                                    if ($feedback_data["type"] == 1) {

                                                    ?>

                                                        <span class="badge bg-success fs-5">Positive</span>

                                                    <?php

                                                    } elseif ($feedback_data["type"] == 2) {

                                                    ?>

                                                        <span class="badge bg-warning text-black fs-5">Neutral</span>

                                                    <?php

                                                    } elseif ($feedback_data["type"] == 3) {

                                                    ?>

                                                        <span class="badge bg-danger fs-5">Negative</span>

                                                    <?php

                                                    }

                                                    ?>

                                                </div>
                                                <div class="col-12">
                                                    <hr />
                                                </div>
                                                <div class="col-12">
                                                    <p class="text-center fw-bold text-black-50"><?php echo $feedback_data["feedback"]; ?></p>
                                                </div>
                                                <div class="offset-6 col-6 text-end">
                                                    <label class="form-label fs-6"><?php echo $feedback_data["date"]; ?></label>
                                                </div>
                                            </div>
                                        </div>

                                    <?php


                                        }

                                    }

                                    ?>

                                </div>
                            </div>

                        </div>
                    </div>

                    <?php include "footer.php"; ?>

                </div>
            </div>

            <script src="bootstrap.bundle.js"></script><!-- Bootstrap.Bundle Js File Link -->
            <script src="script.js"></script><!-- Js File Link -->
            <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>

        </body>

        </html>

<?php

    } else {

        echo ("Sorry for the Inconvenience !!!");
    }
} else {

    echo ("Something Went Wrong !!!");
}


?>