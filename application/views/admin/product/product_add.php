<?php $this->load->view('admin/template/header', $title); ?>
<?php $id = $this->input->get('id'); ?>
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h2 class="mb-sm-0 "><?= $title ?></h2>
                    </div>
                </div>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 mb-3">
                                        <div class="row">
                                            <label for="example-text-input" class="col-md-3 col-form-label">Product Name</label>
                                            <div class="col-md-9">
                                                <input class="form-control" type="text" name="product_name" required value="<?= $product_name ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <div class="row">
                                            <label class="col-sm-3 control-label">Category</label>
                                            <div class="col-sm-9">
                                                <select class="form-control select2" name="category_id" required onchange="getCategory(this.value)">
                                                    <option value="">Select Category</option>
                                                    <?php
                                                    $c = getRowsByMoreIdWithOrder('tbl_category', "is_delete = '1'", "category_name", 'ASC');
                                                    foreach ($c as $cate) {
                                                    ?>
                                                        <option value="<?= $cate['category_id'] ?>" <?php if ($category_id == $cate['category_id']) {
                                                                                                        echo 'selected';
                                                                                                    } ?>><?= ucwords($cate['category_name']) ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <div class="row">
                                            <label class="col-sm-3 control-label">Sub Category</label>
                                            <div class="col-sm-9">
                                                <select class="form-control select2" name="sub_category_id" data-placeholder="Select sub category" id="sub_category">
                                                    <?php
                                                    $subCate = getRowsByMoreIdWithOrder('tbl_sub_category', "category_id = '$category_id' AND is_delete = '1'", 'sub_category_name', 'ASC');
                                                    foreach ($subCate as $c) {
                                                    ?>
                                                        <option value="<?= $c['sub_category_id'] ?>" <?= $c['sub_category_id'] == $sub_category_id ? 'selected' : '' ?>><?= $c['sub_category_name'] ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 mb-3">
                                        <div class="row">
                                            <label for="example-text-input" class="col-md-4 col-form-label">Product Type</label>
                                            <div class="col-md-8">
                                                <select class="select2 form-control" name="product_type">
                                                    <option value="Red" <?= $selectType = '1' ? 'selected' : '' ?>>Normal</option>
                                                    <option value="Red" <?= $selectType == '2' ? 'selected' : '' ?>>Featured</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 mb-3">
                                        <div class="row">
                                            <label for="example-text-input" class="col-md-4 col-form-label">Market Price</label>
                                            <div class="col-md-8">
                                                <input class="form-control" type="number" name="market_price" required value="<?= $market_price ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 mb-3">
                                        <div class="row">
                                            <label for="example-text-input" class="col-md-4 col-form-label">Sale Price</label>
                                            <div class="col-md-8">
                                                <input class="form-control" type="number" name="sale_price" required value="<?= $sale_price ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 mb-3">
                                        <div class="row">
                                            <label for="example-text-input" class="col-md-4 col-form-label">Quantity</label>
                                            <div class="col-md-8">
                                                <input class="form-control" type="number" name="quantity" required value="<?= $quantity ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 mb-3">
                                        <div class="row">
                                            <label for="example-text-input" class="col-md-5 col-form-label">Quantity Type</label>
                                            <div class="col-md-7">
                                                <select name="quantity_type" class="form-select">
                                                    <option value="">Select Type</option>
                                                    <option value="gm" <?= $quantity_type == 'gm' ? 'selected' : '' ?>>gm</option>
                                                    <option value="kg" <?= $quantity_type == 'kg' ? 'selected' : '' ?>>kg</option>
                                                    <option value="pieces" <?= $quantity_type == 'pieces' ? 'selected' : '' ?>>pieces</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 mb-3">
                                        <div class="row">
                                            <label for="example-text-input" class="col-md-1 col-form-label">Description</label>
                                            <div class="col-md-11">
                                                <textarea name="description" style="width: 100%;" id="editor" rows="10"><?= $description ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 mb-3">
                                        <label style="color: gray">Note:- Image Size 600X400</label>
                                        <div class="row">
                                            <label for="example-text-input" class="col-md-3 col-form-label">Product Image</label>
                                            <div class="col-md-9">
                                                <input type="file" class="form-control image" multiple <?= isset($id) ? '' : 'required' ?> name="image[]">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 mb-3">
                                        <div class="gallery"></div>
                                    </div>
                                    <div class="col-lg-12 mt-2">
                                        <div class="row">
                                            <?php
                                            if (isset($id)) {
                                                $numImage = getNumRows('product_image', "product_id = '" . decryptId($id) . "'");
                                                if ($image_all) {

                                                    foreach ($image_all as $img) {
                                                        $imgId = encryptId($img['product_image_id']);
                                                        $imgData = $img['image_path'];
                                            ?>
                                                        <div class="col-lg-3 mb-2">
                                                            <div style="width: 100%; border: 1px solid #aeaeae; border-radius: 5px">
                                                                <img src="<?= base_url("upload/product/") . $imgData ?>" style="width: 100%;height: 180px; margin-top: 10px">
                                                                <div style="margin-top: 10px; text-align: center">
                                                                    <?php
                                                                    if ($numImage != 1) {
                                                                    ?>
                                                                        <a class="btn btn-danger" style="margin-right: 5px" onclick="return confirm('Are you sure to delete this image?')" href="<?= base_url("productImageD/$imgId/$imgData") ?>">
                                                                            <i class="fa fa-trash"></i> Delete
                                                                        </a>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                            <?php
                                                    }
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" id="save" class="btn btn-primary w-md">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>



<?php $this->load->view('admin/template/footer'); ?>
<script>
    $(document).ready(function() {
        initSample();
    });

    function getCategory(val) {
        $.ajax({
            type: "POST",
            url: "<?= base_url("getSubCategory") ?>",
            data: 'category_id=' + val,
            beforeSend: function() {
                $(".loader").show();
            },
            success: function(data) {
                $("#sub_category").html(data);
                $(".loader").hide();
            }
        });
    }

    var imagesPreview = function(input, placeToInsertImagePreview) {
        if (input.files) {
            var filesAmount = input.files.length;
            // if (filesAmount <= 5) {
            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();
                reader.onload = function(event) {
                    $($.parseHTML('<img style="width:200px; height:150px; margin-left:15px">')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
                }
                reader.readAsDataURL(input.files[i]);
            }
        }
    };

    $('.image').on('change', function() {
        $('.gallery').html('');
        imagesPreview(this, 'div.gallery');
    });
</script>