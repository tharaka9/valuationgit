<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

    <title>Cart - Rumantra - By ERav Technology</title>

    <?php include "include/headerscript1.php"; ?>
</head>

<body>
    <div class="page-wrapper">
        <?php include "include/menu1.php"; ?>
        <!-- End of Header -->


        <!-- Start of Main -->
        <main class="main cart">
            <!-- Start of Breadcrumb -->
            <nav class="breadcrumb-nav">
                <div class="container">
                    <ul class="breadcrumb shop-breadcrumb bb-no">
                        <li class="active"><a href="<?php echo base_url().'Cart'?>">Shopping Cart</a></li>
                        <li><a href="<?php echo base_url().'Cart/Checkout'?>">Checkout</a></li>
                        <li><a href="order.html">Order Complete</a></li>
                    </ul>
                </div>
            </nav>
            <!-- End of Breadcrumb -->

 <!-- Start of PageContent -->
 <div class="page-content">
                <div class="container">
                    <div class="row gutter-lg mb-10">
                        <div class="col-lg-8 pr-lg-4 mb-6">
                            <table class="shop-table cart-table">
                                <thead>
                                    <tr>
                                        <th class="product-name"><span>Product</span></th>
                                        <th></th>
                                        <th class="product-price"><span>Price</span></th>
                                        <th class="product-quantity text-center"><span>Quantity</span></th>
                                        <th class="product-subtotal"><span>Subtotal</span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($this->cart->contents() as $rowshopcart){ ?>
                                    <tr>
                                        <td class="product-thumbnail">
                                            <div class="p-relative">
                                                <a href="#">
                                                    <figure>
                                                        <img src="<?php echo base_url().$rowshopcart['options']['listimagepath'] ?>" alt="product"
                                                            width="300" height="338">
                                                    </figure>
                                                </a>
                                                <button type="submit" class="btn btn-close cartremove" id="<?php echo $rowshopcart['rowid'] ?>"><i
                                                        class="fas fa-times"></i></button>
                                            </div>
                                        </td>
                                        <td class="product-name">
                                            <a href="#">
                                                <?php echo $rowshopcart['name'] ?>
                                            </a>
                                        </td>
                                        <td class="product-price"><span class="amount">Rs <?php echo $rowshopcart['price'] ?></span></td>
                                        <td class="product-quantity text-center">
                                            <span class="amount"><?php echo $rowshopcart['qty'] ?></span>
                                        </td>
                                        <td class="product-subtotal">
                                            <span class="amount">Rs <?php echo number_format($rowshopcart['qty']*$rowshopcart['price']); ?></span>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>

                            <div class="cart-action mb-6">
                                <a href="<?php echo base_url(); ?>" class="btn btn-dark btn-rounded btn-icon-left btn-shopping mr-auto"><i class="w-icon-long-arrow-left"></i>Continue Shopping</a>
                                <!-- <button type="submit" class="btn btn-rounded btn-default btn-clear" name="clear_cart" value="Clear Cart">Clear Cart</button> 
                                <button type="submit" class="btn btn-rounded btn-update disabled" name="update_cart" value="Update Cart">Update Cart</button> -->
                            </div>

                            <!-- <form class="coupon">
                                <h5 class="title coupon-title font-weight-bold text-uppercase">Coupon Discount</h5>
                                <input type="text" class="form-control mb-4" placeholder="Enter coupon code here..." required />
                                <button class="btn btn-dark btn-outline btn-rounded">Apply Coupon</button>
                            </form> -->
                        </div>
                        <div class="col-lg-4 sticky-sidebar-wrapper">
                            <div class="sticky-sidebar">
                                <div class="cart-summary mb-4">
                                    <h3 class="cart-title text-uppercase">Cart Totals</h3>
                                    <div class="cart-subtotal d-flex align-items-center justify-content-between">
                                        <label class="ls-25">Subtotal</label>
                                        <span>Rs <?php echo $this->cart->format_number($this->cart->total()) ?></span>
                                    </div>
                                    <hr class="divider">
                                    <div class="cart-subtotal d-flex align-items-center justify-content-between">
                                        <label class="ls-25">Shipping</label>
                                        <span>Rs 0.00</span>
                                    </div>

                                    <hr class="divider mb-6">
                                    <div class="order-total d-flex justify-content-between align-items-center">
                                        <label>Total</label>
                                        <span class="ls-50">Rs <?php echo $this->cart->format_number($this->cart->total()) ?></span>
                                    </div>
                                    <a href="<?php echo base_url().'Cart/Checkout' ?>"
                                        class="btn btn-block btn-dark btn-icon-right btn-rounded  btn-checkout">
                                        Proceed to checkout<i class="w-icon-long-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of PageContent -->
        </main>
        <!-- End of Main -->

        <?php include "include/footercontent.php"; ?>
    </div>
    <!-- End of Page Wrapper -->

    <?php include "include/footerscript.php"; ?>

    <script>
        $(document).ready(function(){
			$('.cartremove').click(function(e){
                e.preventDefault();

                var rowID = $(this).attr("id");
                
                $.ajax({
                    url: "<?php echo base_url('Cart/Removeminicart');?>",
                    method: "POST",
                    data: {
                        rowID: rowID
                    },
                    success: function(data) { 
                        location.reload();
                    }
                });
            });
		});
    </script>
</body>

</html>