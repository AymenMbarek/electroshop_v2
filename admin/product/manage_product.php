<?php
if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT * from `products` where id = '{$_GET['id']}' ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=stripslashes($v);
        }

        $specs_qry = $conn->query("SELECT `meta_field`, `meta_value` FROM `specification_list` where `product_id` = '{$id}'");
        $specs = array_column($specs_qry->fetch_all(MYSQLI_ASSOC), 'meta_value', 'meta_field');
    }
}
?>
<style>
    .specs-text-field{
        background:transparent;
        border:unset;
        outline:unset;
        height:60px;
        width:100%;
        resize:none;
    }
</style>
<div class="card card-outline card-info">
	<div class="card-header">
		<h3 class="card-title"><?php echo isset($id) ? "Update ": "Create New " ?> Product</h3>
	</div>
	<div class="card-body">
		<form action="" id="product-form">
			<input type="hidden" name ="id" value="<?php echo isset($id) ? $id : '' ?>">
            <div class="form-group">
				<label for="brand_id" class="control-label">Brand</label>
                <select name="brand_id" id="brand_id" class="custom-select select2" required>
                <option value=""></option>
                <?php
                    $qry = $conn->query("SELECT * FROM `brands` order by `name` asc");
                    while($row= $qry->fetch_assoc()):
                ?>
                <option value="<?php echo $row['id'] ?>" <?php echo isset($brand_id) && $brand_id == $row['id'] ? 'selected' : '' ?>><?php echo $row['name'] ?></option>
                <?php endwhile; ?>
                </select>
			</div>
            <div class="form-group">
				<label for="category_id" class="control-label">Category</label>
                <select name="category_id" id="category_id" class="custom-select select2" required>
                <option value=""></option>
                <?php
                    $qry = $conn->query("SELECT * FROM `categories` order by category asc");
                    while($row= $qry->fetch_assoc()):
                ?>
                <option value="<?php echo $row['id'] ?>" <?php echo isset($category_id) && $category_id == $row['id'] ? 'selected' : '' ?>><?php echo $row['category'] ?></option>
                <?php endwhile; ?>
                </select>
			</div>
            <div class="form-group">
				<label for="sub_category_id" class="control-label">Sub Category</label>
                <select name="sub_category_id" id="sub_category_id" class="custom-select">
                <option value="" selected="" disabled="">Select Category First</option>
                <?php
                    $qry = $conn->query("SELECT * FROM `sub_categories` order by sub_category asc");
                    $sub_categories = array();
                    while($row= $qry->fetch_assoc()):
                    $sub_categories[$row['parent_id']][] = $row;
                    endwhile; 
                ?>
                </select>
			</div>
			<div class="form-group">
				<label for="name" class="control-label">Product Name/Model</label>
                <input type="text" name="name" id="name" class="form-control rounded-0" required value="<?php echo isset($name) ?$name : '' ?>" />
			</div>
			<div class="form-group">
				<label for="price" class="control-label">Product Price</label>
                <input type="number" step="any" name="price" id="price" class="form-control rounded-0" required value="<?php echo isset($price) ?$price : '' ?>" />
			</div>
            <div class="form-group">
				<label for="specs" class="control-label">Specifications</label>
                <table class="table table-sm table-bordered">
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
                                <textarea name="specs['processor']" id="processor" cols="30" rows="10" class="specs-text-field" required="required"><?= $specs['processor'] ?? "" ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <th>Clock Speed</th>
                            <td>
                                <textarea name="specs['clock_speed']" id="clock_speed" cols="30" rows="10" class="specs-text-field" required="required"><?= $specs['clock_speed'] ?? "" ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <th>GPU</th>
                            <td>
                                <textarea name="specs['GPU']" id="GPU" cols="30" rows="10" class="specs-text-field" required="required"><?= $specs['GPU'] ?? "" ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <th>RAM</th>
                            <td>
                                <textarea name="specs['RAM']" id="RAM" cols="30" rows="10" class="specs-text-field" required="required"><?= $specs['RAM'] ?? "" ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <th>RAM Slot</th>
                            <td>
                                <textarea name="specs['RAM_slot']" id="RAM_slot" cols="30" rows="10" class="specs-text-field" required="required"><?= $specs['RAM_slot'] ?? "" ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <th>SSD/HDD</th>
                            <td>
                                <textarea name="specs['SSD_OR_HDD']" id="RAM" cols="30" rows="10" class="specs-text-field" required="required"><?= $specs['SSD_OR_HDD'] ?? "" ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <th>OS</th>
                            <td>
                                <textarea name="specs['OS']" id="OS" cols="30" rows="10" class="specs-text-field" required="required"><?= $specs['OS'] ?? "" ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <th colspan="2" class='text-center bg-secondary'>Display</th>
                        </tr>
                        <tr>
                            <th>Display Size</th>
                            <td>
                                <textarea name="specs['display_size']" id="display_size" cols="30" rows="10" class="specs-text-field" required="required"><?= $specs['display_size'] ?? "" ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <th>Display Type</th>
                            <td>
                                <textarea name="specs['display_type']" id="display_type" cols="30" rows="10" class="specs-text-field" required="required"><?= $specs['display_type'] ?? "" ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <th>Touch Screen</th>
                            <td>
                                <textarea name="specs['display_touch']" id="display_touch" cols="30" rows="10" class="specs-text-field" required="required"><?= $specs['display_touch'] ?? "" ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <th colspan="2" class='text-center bg-secondary'>Power and Battery</th>
                        </tr>
                        <tr>
                            <th>Power Adapter</th>
                            <td>
                                <textarea name="specs['power_adapter']" id="power_adapter" cols="30" rows="10" class="specs-text-field" required="required"><?= $specs['power_adapter'] ?? "" ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <th>Battery Capacity</th>
                            <td>
                                <textarea name="specs['battery_capacity']" id="battery_capacity" cols="30" rows="10" class="specs-text-field" required="required"><?= $specs['battery_capacity'] ?? "" ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <th>Battery Hour</th>
                            <td>
                                <textarea name="specs['battery_hour']" id="battery_hour" cols="30" rows="10" class="specs-text-field" required="required"><?= $specs['battery_hour'] ?? "" ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <th colspan="2" class='text-center bg-secondary'>Body</th>
                        </tr>
                        <tr>
                            <th>Dimension</th>
                            <td>
                                <textarea name="specs['dimension']" id="dimension" cols="30" rows="10" class="specs-text-field" required="required"><?= $specs['dimension'] ?? "" ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <th>Weight</th>
                            <td>
                                <textarea name="specs['weight']" id="weight" cols="30" rows="10" class="specs-text-field" required="required"><?= $specs['weight'] ?? "" ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <th>Colors</th>
                            <td>
                                <textarea name="specs['colors']" id="colors" cols="30" rows="10" class="specs-text-field" required="required"><?= $specs['colors'] ?? "" ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <th colspan="2" class='text-center bg-secondary'>IO and Ports</th>
                        </tr>
                        <tr>
                            <th>IO Ports</th>
                            <td>
                                <textarea name="specs['IO_ports']" id="IO_ports" cols="30" rows="10" class="specs-text-field" required="required"><?= $specs['IO_ports'] ?? "" ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <th>Fingerprint Sensor</th>
                            <td>
                                <textarea name="specs['fingerprint_sensor']" id="fingerprint_sensor" cols="30" rows="10" class="specs-text-field" required="required"><?= $specs['fingerprint_sensor'] ?? "" ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <th>Camera</th>
                            <td>
                                <textarea name="specs['camera']" id="camera" cols="30" rows="10" class="specs-text-field" required="required"><?= $specs['camera'] ?? "" ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <th>Keyboard</th>
                            <td>
                                <textarea name="specs['keyboard']" id="keyboard" cols="30" rows="10" class="specs-text-field" required="required"><?= $specs['keyboard'] ?? "" ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <th>Touchpad</th>
                            <td>
                                <textarea name="specs['touchpad']" id="touchpad" cols="30" rows="10" class="specs-text-field" required="required"><?= $specs['touchpad'] ?? "" ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <th colspan="2" class='text-center bg-secondary'>Connectivity</th>
                        </tr>
                        <tr>
                            <th>WIFI</th>
                            <td>
                                <textarea name="specs['WIFI']" id="WIFI" cols="30" rows="10" class="specs-text-field" required="required"><?= $specs['WIFI'] ?? "" ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <th>Bluetooth</th>
                            <td>
                                <textarea name="specs['bluetooth']" id="bluetooth" cols="30" rows="10" class="specs-text-field" required="required"><?= $specs['bluetooth'] ?? "" ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <th colspan="2" class='text-center bg-secondary'>Audio</th>
                        </tr>
                        <tr>
                            <th>Speaker</th>
                            <td>
                                <textarea name="specs['speaker']" id="speaker" cols="30" rows="10" class="specs-text-field" required="required"><?= $specs['speaker'] ?? "" ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <th>Mic</th>
                            <td>
                                <textarea name="specs['mic']" id="mic" cols="30" rows="10" class="specs-text-field" required="required"><?= $specs['mic'] ?? "" ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <th colspan="2" class='text-center bg-secondary'>Others</th>
                        </tr>
                        <tr>
                            <th>Other Info</th>
                            <td>
                                <textarea name="specs['other']" id="other" cols="30" rows="10" class="specs-text-field" required="required"><?= $specs['other'] ?? "" ?></textarea>
                            </td>
                        </tr>
                    </tbody>
                </table>
			</div>
            <div class="form-group">
				<label for="status" class="control-label">Status</label>
                <select name="status" id="status" class="custom-select selevt">
                <option value="1" <?php echo isset($status) && $status == 1 ? 'selected' : '' ?>>Active</option>
                <option value="0" <?php echo isset($status) && $status == 0 ? 'selected' : '' ?>>Inactive</option>
                </select>
			</div>
            <div class="form-group">
				<label for="" class="control-label">Images</label>
				<div class="custom-file">
	              <input type="file" class="custom-file-input rounded-circle" id="customFile" name="img[]" multiple accept=".png,.jpg,.jpeg" onchange="displayImg(this,$(this))">
	              <label class="custom-file-label" for="customFile">Choose file</label>
	            </div>
			</div>
            <?php 
            if(isset($id)):
            $upload_path = "uploads/product_".$id;
            if(is_dir(base_app.$upload_path)): 
            ?>
            <?php 
                $file= scandir(base_app.$upload_path);
                foreach($file as $img):
                    if(in_array($img,array('.','..')))
                        continue;
            ?>
                <div class="d-flex w-100 align-items-center img-item">
                    <span><img src="<?php echo base_url.$upload_path.'/'.$img ?>" width="150px" height="100px" style="object-fit:cover;" class="img-thumbnail" alt=""></span>
                    <span class="ml-4"><button class="btn btn-sm btn-default text-danger rem_img" type="button" data-path="<?php echo base_app.$upload_path.'/'.$img ?>"><i class="fa fa-trash"></i></button></span>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
            <?php endif; ?>
			
		</form>
	</div>
	<div class="card-footer">
		<button class="btn btn-flat btn-primary" form="product-form">Save</button>
		<a class="btn btn-flat btn-default" href="?page=product">Cancel</a>
	</div>
</div>
<script>
    function displayImg(input,_this) {
        console.log(input.files)
        var fnames = []
        Object.keys(input.files).map(k=>{
            fnames.push(input.files[k].name)
        })
        _this.siblings('.custom-file-label').html(JSON.stringify(fnames))
	    
	}
    function delete_img($path){
        start_loader()
        
        $.ajax({
            url: _base_url_+'classes/Master.php?f=delete_img',
            data:{path:$path},
            method:'POST',
            dataType:"json",
            error:err=>{
                console.log(err)
                alert_toast("An error occured while deleting an Image","error");
                end_loader()
            },
            success:function(resp){
                $('.modal').modal('hide')
                if(typeof resp =='object' && resp.status == 'success'){
                    $('[data-path="'+$path+'"]').closest('.img-item').hide('slow',function(){
                        $('[data-path="'+$path+'"]').closest('.img-item').remove()
                    })
                    alert_toast("Image Successfully Deleted","success");
                }else{
                    console.log(resp)
                    alert_toast("An error occured while deleting an Image","error");
                }
                end_loader()
            }
        })
    }
    var sub_categories = $.parseJSON('<?php echo json_encode($sub_categories) ?>');
	$(document).ready(function(){
        $('.rem_img').click(function(){
            _conf("Are sure to delete this image permanently?",'delete_img',["'"+$(this).attr('data-path')+"'"])
        })
       
        $('#category_id').change(function(){
            var cid = $(this).val()
            var opt = "<option></option>";
            Object.keys(sub_categories).map(k=>{
                if(k == cid){
                    Object.keys(sub_categories[k]).map(i=>{
                        if('<?php echo isset($sub_category_id) ? $sub_category_id : 0 ?>' == sub_categories[k][i].id){
                            opt += "<option value='"+sub_categories[k][i].id+"' selected>"+sub_categories[k][i].sub_category+"</option>";
                        }else{
                            opt += "<option value='"+sub_categories[k][i].id+"'>"+sub_categories[k][i].sub_category+"</option>";
                        }
                    })
                }
            })
            $('#sub_category_id').html(opt)
            $('#sub_category_id').select2({placeholder:"Please Select here",width:"relative"})
        })
        $('.select2').select2({placeholder:"Please Select here",width:"relative"})
        if(parseInt("<?php echo isset($category_id) ? $category_id : 0 ?>") > 0){
            console.log('test')
            start_loader()
            setTimeout(() => {
                $('#category_id').trigger("change");
                end_loader()
            }, 750);
        }
		$('#product-form').submit(function(e){
			e.preventDefault();
            var _this = $(this)
			 $('.err-msg').remove();
			start_loader();
			$.ajax({
				url:_base_url_+"classes/Master.php?f=save_product",
				data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
				error:err=>{
					console.log(err)
					alert_toast("An error occured",'error');
					end_loader();
				},
				success:function(resp){
					if(typeof resp =='object' && resp.status == 'success'){
						location.href = "./?page=product";
					}else if(resp.status == 'failed' && !!resp.msg){
                        var el = $('<div>')
                            el.addClass("alert alert-danger err-msg").text(resp.msg)
                            _this.prepend(el)
                            el.show('slow')
                            $("html, body").animate({ scrollTop: _this.closest('.card').offset().top }, "fast");
                            if(!!resp.id)
                            $('[name="id"]').val(resp.id)
                            end_loader()
                    }else{
						alert_toast("An error occured",'error');
						end_loader();
                        console.log(resp)
					}
				}
			})
		})

        $('.summernote').summernote({
		        height: 200,
		        toolbar: [
		            [ 'style', [ 'style' ] ],
		            [ 'font', [ 'bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear'] ],
		            // [ 'fontname', [ 'fontname' ] ],
		            [ 'fontsize', [ 'fontsize' ] ],
		            [ 'color', [ 'color' ] ],
		            [ 'para', [ 'ol', 'ul', 'paragraph' ] ],
		            [ 'table', [ 'table' ] ],
		            [ 'view', [ 'undo', 'redo', 'codeview', 'help' ] ]
		        ]
		    })
	})
</script>