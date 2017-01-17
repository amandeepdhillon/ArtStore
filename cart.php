<!-- Page used to display items in cart-->
<?php
    include 'includes/art-setup.inc.php';
    include 'includes/cart.helper.php';
    
    if(isset($_SESSION['shipping'])){
        $shippingType = $_SESSION['shipping'];
    }
    else if(!isset($_POST['shipping'])) {
        $shippingType = "standard";
    }
    else {
        $shippingType = $_POST['shipping'];
    }
    
    $cart = $_SESSION['cart'];
    $subtotal = 0;
    $cartQuantity = 0;
    
    $paintGate = new PaintingTableGateway($db);
    $frameGate = new TypesFramesTableGateway($db);
    $glassGate = new TypesGlassTableGateway($db);
    $mattGate = new TypesMattTableGateway($db);
    
    include ('includes/head.inc.php');
?>
    <script src="js/cart.js"></script>

    <body>
        <?php include 'includes/header.inc.php'; ?>

        <main class="ui container">
            <h1>Cart</h1>
        <form class="ui form" method="POST" action="update-cart.php">
            <div class="ui divided items">

                <?php 
                if(count($cart) > 0) {
                foreach($cart as $item) : ?>
                <?php 
                    $painting = $paintGate->findById($item->paintingID);
                    $frame = $frameGate->findById($item->frameID);
                    $glass = $glassGate->findById($item->glassID);
                    $matt = $mattGate->findById($item->mattID);
                    $price = calcItemPrice($painting->MSRP, $item->quantity, $frame->Price, $glass->Price, $matt->MattID);
                    $subtotal += $price; 
                    $cartQuantity += $item->quantity;
                ?>
                <div class="item" id=<?php echo $item->paintingID; ?> >
                    <div class="ui tiny image">
                        <img src="/images/art/works/square-small/<?php echo $painting->ImageFileName; ?>.jpg">
                    </div>
                    <div class="content top aligned">
                        <a href="single-painting.php?id=<?php echo $painting->PaintingID ?>" class="header"><?php echo utf8_encode($painting->Title) ?></a>
                        <div class="description">
                            <span data-price=<?php echo $painting->MSRP; ?> class="painting price right floated">$<?php echo number_format($price, 2); ?></span>
                        </div>
                        <div class="extra">

                                <div class="five fields">

                                    <div class="two wide field">
                                        <label>Quantity</label>
                                        <input name="quantity[<?php echo $painting->PaintingID; ?>]" type="number" min="0" value="<?php echo $item->quantity; ?>">
                                    </div>

                                    <div class="four wide field">
                                        <label>Frame</label>
                                        <select name="frame[<?php echo $painting->PaintingID; ?>]" class="ui dropdown">
                                              <option value="">Frame</option>
                                              <?php $frames = $frameGate->findAll();
                                              foreach($frames as $f) { ?>
                                                  <option data-price=<?php echo $f->Price; ?> value=<?php echo $f->FrameID; if($f->FrameID == $frame->FrameID) {echo " selected ";}?> >
                                                      <?php echo $f->Title; ?>
                                                  </option>
                                              <?php }?>
                                          </select>
                                    </div>

                                    <div class="four wide field">
                                        <label>Glass</label>
                                        <select name="glass[<?php echo $painting->PaintingID; ?>]" class="ui dropdown">
                                              <option value="">Glass</option>
                                              <?php $glasses = $glassGate->findAll();
                                              foreach($glasses as $g) { ?>
                                                  <option data-price=<?php echo $g->Price; ?> value=<?php echo $g->GlassID; if($g->GlassID == $glass->GlassID) {echo " selected ";} ?> >
                                                      <?php echo $g->Title; ?>
                                                  </option>
                                              <?php }?>
                                          </select>
                                    </div>

                                    <div class="four wide field">
                                        <label>Matt</label>
                                        <select name="matt[<?php echo $painting->PaintingID; ?>]" class="ui dropdown">
                                              <option value="">Matt</option>
                                              <?php $matts = $mattGate->findAll();
                                              foreach($matts as $m) { ?>
                                                  <option value=<?php echo $m->MattID; if($m->MattID == $matt->MattID) {echo " selected ";} ?> >
                                                      <?php echo $m->Title; ?>
                                                  </option>
                                              <?php }?>
                                          </select>
                                    </div>
                                    <div class="two wide field">
                                        <div class="ui checkbox">
                                            <input type="checkbox" name="delete[<?php echo $painting->PaintingID ?>]">
                                            <label>Delete</label>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>



                <?php endforeach; } else { ?>
                    <h3>Cart Empty</h3>
            <?php } ?>

                <div class="item">
                    <div class="content top aligned">
                        <div class="right floated">
                            <div class="meta">
                                <span>Subtotal</span>
                            </div>
                            <div class="description">
                                <span class="price" id="subtotalPrice">$<?php echo number_format($subtotal, 2); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="item">
                    <div class="content top aligned">
                        <div class="inline fields">
                            <label>Shipping Options</label>
                            <div class="field">
                                <div class="ui radio checkbox">
                                    <input type="radio" name="shipping" value="standard"<?php if ($shippingType == "standard"){echo ' checked="checked"';}  ?>>
                                    <label>Standard</label>
                                </div>
                            </div>
                            <div class="field">
                                <div class="ui radio checkbox">
                                    <input type="radio" name="shipping" value="express"<?php if ($shippingType == "express"){echo ' checked="checked"';}  ?>>
                                    <label>Express</label>
                                </div>
                            </div>
                        </div>
                        </div>
                        <div class="right floated">
                            <div class="meta">
                                <span>Shipping</span>
                            </div>
                            <div class="description">
                                <span class="price" id="shippingPrice">$<?php 
                                $shipping = calcShipping($subtotal, $cartQuantity, $shippingType);
                                echo number_format($shipping, 2) ?></span>
                            </div>
                        </div>
                </div>
                
                <div class="item">
                    <div class="content top aligned">
                        <div class=" right floated">
                            <div class="meta">
                                <span>Total</span>
                            </div>
                            <div class="description">
                                <span class="price" id="totalPrice">$<?php echo number_format($subtotal + $shipping, 2); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" name="shop" value="shop" class="ui yellow button">
                <i class="cart icon"></i> Continue Shopping
            </button>
            <button type="button" class="ui positive button">
                <i class="check icon"></i> Order
            </button>
            <button type="submit" name="clear" value="clear" class="ui negative button">
            <i class="remove icon"></i> Clear
            </button>
            </form>

        </main>

        <?php include("includes/footer.inc.php"); ?>
    </body>
    <script>
        $('.ui.dropdown').dropdown();
    </script>

    </html>