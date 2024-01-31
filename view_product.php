<?php 
 $products = $conn->query("SELECT p.*,b.name as bname FROM `products` p inner join brands b on p.brand_id = b.id where md5(p.id) = '{$_GET['id']}' ");
 if($products->num_rows > 0){
     foreach($products->fetch_assoc() as $k => $v){
         $$k= stripslashes($v);
     }
     $specs_qry = $conn->query("SELECT `meta_field`, `meta_value` FROM `specification_list`  where `product_id` = '{$id}'");
     $specs = array_column($specs_qry->fetch_all(MYSQLI_ASSOC), 'meta_value', 'meta_field');
    $upload_path = base_app.'/uploads/product_'.$id;
    $img = "";
    if(is_dir($upload_path)){
        $fileO = scandir($upload_path);
        if(isset($fileO[2]))
            $img = "uploads/product_".$id."/".$fileO[2];
        // var_dump($fileO);
    }
    $inventory = $conn->query("SELECT * FROM inventory where product_id = ".$id);
    $inv = array();
    while($ir = $inventory->fetch_assoc()){
        $inv[] = $ir;
    }
    $sold = $conn->query("SELECT SUM(ol.quantity) as sold FROM order_list ol inner join orders o on o.id = ol.order_id where ol.product_id='{$id}' and o.`status` != 4 ");
    $sold = $sold->num_rows > 0 ? $sold->fetch_assoc()['sold'] : 0;
 }
?>
<style>
    #display-img{
        width:100%;
        height: 60vh;
        background:#242424;
    }
    #display-img>img{
        height:100%;
        width:100%;
        object-fit:scale-down;
    }
</style>
<section class="py-5">
    <div class="container px-4 px-lg-5 my-5">
        
        <div class="row gx-4 gx-lg-5 align-items-start">
            <div class="col-md-6">
                <div class="card-img-top mb-5 mb-md-0 border border-dark" loading="lazy" id="display-img">
                    <img src="<?php echo validate_image($img) ?>" alt="..." />
                </div>
                <div class="mt-2 row gx-2 gx-lg-3 row-cols-4 row-cols-md-3 row-cols-xl-4 justify-content-start">
                    <?php 
                        foreach($fileO as $k => $img):
                            if(in_array($img,array('.','..')))
                                continue;
                    ?>
                    <div class="col">
                        <a href="javascript:void(0)" class="view-image <?php echo $k == 2 ? "active":'' ?>"><img src="<?php echo validate_image('uploads/product_'.$id.'/'.$img) ?>" loading="lazy"  class="img-thumbnail" alt=""></a>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="col-md-6">
                <!-- <div class="small mb-1">SKU: BST-498</div> -->
                <h1 class="display-5 fw-bolder border-bottom border-primary pb-1"><?php echo $name ?></h1>
                <p class="m-0"><small><b>Brand:</b> <?php echo $bname ?></small></p>
                <div class="fs-5 mb-5">
                &#8369; <span id="price"><?php echo number_format($price) ?></span>
                <br>
                <span><small><b>Available Stock:</b> <span id="avail"><?php echo $inv[0]['quantity'] - ($sold ?? 0) ?></span></small></span>
                </div>
                <form action="" id="add-cart">
                <div class="d-flex">
                    <input type="hidden" name="price" value="<?php echo number_format($price, 2) ?>">
                    <input type="hidden" name="inventory_id" value="<?php echo $inv[0]['id'] ?>">
                    <input class="form-control text-center me-3" id="inputQuantity" type="num" value="1" style="max-width: 3rem" name="quantity" />
                    <button class="btn btn-outline-dark flex-shrink-0" type="submit">
                        <i class="bi-cart-fill me-1"></i>
                        Add to cart
                    </button>
                </div>
                </form>
                <table class="table table-sm table-bordered my-3">
                    <colgroup>
                        <col width="50%">
                        <col width="50%">
                    </colgroup>
                    <thead>
                        <tr class="bg-dark">
                            <th class="text-center">Field Name</th>
                            <th class="text-center">Value</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th colspan="2" class='text-center bg-secondary'>Performance</th>
                        </tr>
                        <tr>
                            <th>Processor</th>
                            <td>
                            <?= $specs['processor'] ?? "" ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Clock Speed</th>
                            <td>
                            <?= $specs['clock_speed'] ?? "" ?>
                            </td>
                        </tr>
                        <tr>
                            <th>GPU</th>
                            <td>
                            <?= $specs['GPU'] ?? "" ?>
                            </td>
                        </tr>
                        <tr>
                            <th>RAM</th>
                            <td>
                            <?= $specs['RAM'] ?? "" ?>
                            </td>
                        </tr>
                        <tr>
                            <th>RAM Slot</th>
                            <td>
                            <?= $specs['RAM_slot'] ?? "" ?>
                            </td>
                        </tr>
                        <tr>
                            <th>SSD/HDD</th>
                            <td>
                            <?= $specs['SSD_OR_HDD'] ?? "" ?>
                            </td>
                        </tr>
                        <tr>
                            <th>OS</th>
                            <td>
                            <?= $specs['OS'] ?? "" ?>
                            </td>
                        </tr>
                        <tr>
                            <th colspan="2" class='text-center bg-secondary'>Display</th>
                        </tr>
                        <tr>
                            <th>Display Size</th>
                            <td>
                            <?= $specs['display_size'] ?? "" ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Display Type</th>
                            <td>
                            <?= $specs['display_type'] ?? "" ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Touch Screen</th>
                            <td>
                            <?= $specs['display_touch'] ?? "" ?>
                            </td>
                        </tr>
                        <tr>
                            <th colspan="2" class='text-center bg-secondary'>Power and Battery</th>
                        </tr>
                        <tr>
                            <th>Power Adapter</th>
                            <td>
                            <?= $specs['power_adapter'] ?? "" ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Battery Capacity</th>
                            <td>
                            <?= $specs['battery_capacity'] ?? "" ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Battery Hour</th>
                            <td>
                            <?= $specs['battery_hour'] ?? "" ?>
                            </td>
                        </tr>
                        <tr>
                            <th colspan="2" class='text-center bg-secondary'>Body</th>
                        </tr>
                        <tr>
                            <th>Dimension</th>
                            <td>
                            <?= $specs['dimension'] ?? "" ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Weight</th>
                            <td>
                            <?= $specs['weight'] ?? "" ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Colors</th>
                            <td>
                            <?= $specs['colors'] ?? "" ?>
                            </td>
                        </tr>
                        <tr>
                            <th colspan="2" class='text-center bg-secondary'>IO and Ports</th>
                        </tr>
                        <tr>
                            <th>IO Ports</th>
                            <td>
                            <?= $specs['IO_ports'] ?? "" ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Fingerprint Sensor</th>
                            <td>
                            <?= $specs['fingerprint_sensor'] ?? "" ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Camera</th>
                            <td>
                            <?= $specs['camera'] ?? "" ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Keyboard</th>
                            <td>
                            <?= $specs['keyboard'] ?? "" ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Touchpad</th>
                            <td>
                            <?= $specs['touchpad'] ?? "" ?>
                            </td>
                        </tr>
                        <tr>
                            <th colspan="2" class='text-center bg-secondary'>Connectivity</th>
                        </tr>
                        <tr>
                            <th>WIFI</th>
                            <td>
                            <?= $specs['WIFI'] ?? "" ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Bluetooth</th>
                            <td>
                            <?= $specs['bluetooth'] ?? "" ?>
                            </td>
                        </tr>
                        <tr>
                            <th colspan="2" class='text-center bg-secondary'>Audio</th>
                        </tr>
                        <tr>
                            <th>Speaker</th>
                            <td>
                            <?= $specs['speaker'] ?? "" ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Mic</th>
                            <td>
                            <?= $specs['mic'] ?? "" ?>
                            </td>
                        </tr>
                        <tr>
                            <th colspan="2" class='text-center bg-secondary'>Others</th>
                        </tr>
                        <tr>
                            <th>Other Info</th>
                            <td>
                            <?= $specs['other'] ?? "" ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<!-- Related items section-->
<section class="py-5 bg-light">
    <div class="container px-4 px-lg-5 mt-5">
        <h2 class="fw-bolder mb-4">Related Products</h2>
        <div class="row gx-4 gx-lg-5 row-cols-1 row-cols-md-3 row-cols-xl-4 justify-content-center">
        <?php 
            $products = $conn->query("SELECT p.*,b.name as bname FROM `products` p inner join brands b on p.brand_id = b.id where p.status = 1 and (p.category_id = '{$category_id}' or p.sub_category_id = '{$sub_category_id}') and p.id !='{$id}' order by rand() limit 4 ");
            while($row = $products->fetch_assoc()):
                $upload_path = base_app.'/uploads/product_'.$row['id'];
                $img = "";
                if(is_dir($upload_path)){
                    $fileO = scandir($upload_path);
                    if(isset($fileO[2]))
                        $img = "uploads/product_".$row['id']."/".$fileO[2];
                    // var_dump($fileO);
                }
                $inventory = $conn->query("SELECT * FROM inventory where product_id = ".$row['id']);
                $_inv = array();
                foreach($row as $k=> $v){
                    $row[$k] = trim(stripslashes($v));
                }
                
        ?>
            <div class="col mb-5">
                <a class="card h-100 product-item text-dark" href=".?p=view_product&id=<?php echo md5($row['id']) ?>">
                    <!-- Product image-->
                    <img class="card-img-top w-100" src="<?php echo validate_image($img) ?>" alt="..." />
                    <!-- Product details-->
                    <div class="card-body p-4">
                        <div class="">
                            <!-- Product name-->
                            <h5 class="fw-bolder"><?php echo $row['name'] ?></h5>
                            <!-- Product price-->
                                <span><b>Price: </b><?php echo number_format($row['price'], 2) ?></span>
                            <p class="m-0"><small>Brand: <?php echo $row['bname'] ?></small></p>
                        </div>
                    </div>
                </a>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>
<script>
    var inv = $.parseJSON('<?php echo json_encode($inv) ?>');
    $(function(){
        $('.view-image').click(function(){
            var _img = $(this).find('img').attr('src');
            $('#display-img>img').attr('src',_img);
            $('.view-image').removeClass("active")
            $(this).addClass("active")
        })
        $('.p-size').click(function(){
            var k = $(this).attr('data-id');
            $('.p-size').removeClass("active")
            $(this).addClass("active")
            $('#price').text(inv[k].price)
            $('[name="price"]').val(inv[k].price)
            $('#avail').text(inv[k].quantity)
            $('[name="inventory_id"]').val(inv[k].id)

        })

        $('#add-cart').submit(function(e){
            e.preventDefault();
            if('<?php echo $_settings->userdata('id') ?>' <= 0){
                uni_modal("","login.php");
                return false;
            }
            start_loader();
            $.ajax({
                url:'classes/Master.php?f=add_to_cart',
                data:$(this).serialize(),
                method:'POST',
                dataType:"json",
                error:err=>{
                    console.log(err)
                    alert_toast("an error occured",'error')
                    end_loader()
                },
                success:function(resp){
                    if(typeof resp == 'object' && resp.status=='success'){
                        alert_toast("Product added to cart.",'success')
                        $('#cart-count').text(resp.cart_count)
                    }else{
                        console.log(resp)
                        alert_toast("an error occured",'error')
                    }
                    end_loader();
                }
            })
        })
    })
</script>