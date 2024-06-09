<script>
    function calculateFinalPrice(originalPrice, discountPercentage) {
        // Calculate the discount amount
        var discountAmount = (originalPrice * discountPercentage) / 100;
        
        // Calculate the final price after applying the discount
        var finalPrice = originalPrice - discountAmount;
        
        // Return the final price
        return finalPrice;
    }
    function updateStock(product_id, type) {
            let stock = parseInt($(`#input-stock-${product_id}`).val())
            stock = type == 'add' ? stock + 1 : stock - 1;

            $.ajax({
                url: "<?= base_url('/api/product/variant/stock/update') ?>",
                type: "GET",
                data: {
                    p_id: product_id,
                    stock: stock
                },
                beforeSend: function () {
                    $(`#btn-stock-add-${product_id}`).attr('disabled', true)
                    $(`#btn-stock-sub-${product_id}`).attr('disabled', true)
                },
                success: function (resp) {
                    $(`#btn-stock-add-${product_id}`).attr('disabled', false)
                    $(`#btn-stock-sub-${product_id}`).attr('disabled', false)
                    if (resp.status) {
                        $(`#input-stock-${product_id}`).val(stock)
                        $('#alert').html(`<div class="alert alert-success alert-dismissible alert-label-icon label-arrow fade show material-shadow" role="alert">
                                                        <i class="ri-checkbox-circle-fill label-icon"></i><strong>${resp.message}</strong>
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                    </div>`)
                    }
                },
                error: function (err) {
                    console.log(err)
                    $(`#btn-stock-add-${product_id}`).attr('disabled', false)
                    $(`#btn-stock-sub-${product_id}`).attr('disabled', false)
                    $('#alert').html(`<div class="alert alert-warning alert-dismissible alert-label-icon label-arrow fade show material-shadow" role="alert">
                                                    <i class="ri-alert-line label-icon"></i><strong>Warning</strong> - Internal Server Error
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>`)
                }
            })

        }
    $(document).ready(function () {

        get_product_data('<?= $_GET['p_id'] ?>');

        var product;

        function get_product_data(p_id) {
            $.ajax({
                url: "<?= base_url('/api/product') ?>",
                type: 'GET',
                data: {
                    p_id: p_id
                },
                beforeSend: function () { },
                success: function (resp) {
                    console.log(resp);
                    if (resp.status) {
                        product = resp.data;
                        let html = `<tr>
                                        <td>id</td>
                                        <td style="text-align: right" class="text-secondary">${product.product_id}</td>
                                    </tr>
                                    <tr>
                                        <td>Category</td>
                                        <td style="text-align: right" class="text-secondary">${product.category}</td>
                                    </tr>
                                    <tr>
                                        <td>Price</td>
                                        <td style="text-align: right" class="text-secondary">${product.base_price} ₹</td>
                                    </tr>
                                    <tr>
                                        <td>Discount</td>
                                        <td style="text-align: right" class="text-secondary">${product.base_discount} %</td>
                                    </tr>
                                    <tr>
                                        <td>Final Price</td>
                                        <td style="text-align: right" class="text-success fs-16 ">${calculateFinalPrice(product.base_price,product.base_discount)} ₹</td>
                                    </tr>
                                    <tr>
                                        <td>Total Stock</td>
                                        <td style="text-align: right" class="text-secondary">${product.product_stock}</td>
                                    </tr>
                                    <tr>
                                        <td>Sold</td>
                                        <td style="text-align: right" class="text-secondary">${product.category}</td>
                                    </tr>`
                        $('#product_details').html(html);
                        load_variants();
                    }
                },
                error: function (err) {
                    console.log(err)
                }

            })
        }

        


        function load_variants() {
            $.ajax({
                url: "<?= base_url('/api/product/variant') ?>",
                type: 'GET',
                data: {
                    p_id: '<?= $_GET['p_id'] ?>'
                },
                beforeSend: function () {
                    $('#table-product-variant-body').html(`<tr >
                        <td colspan="7"  style="text-align:center">
                            <div class="spinner-border" role="status"></div>
                        </td>
                    </tr>`);

                },
                success: function (resp) {
                    if (resp.status) {
                        let html = '';
                        $.each(resp.data, function (vIndex, vItem) {
                            console.log(vItem);
                            html += `<tr>
                                    <td >
                                        ${vItem.product_img.length > 0
                                    ?
                                    `<img src="<?= base_url('public/uploads/variant_images/') ?>${vItem.product_img[0].src}" alt="" class="product-img">`
                                    :
                                    `<img src="<?= base_url('public/uploads/product_images/') ?>${product.product_img[0].src}" alt="" class="product-img">`
                                }
                                    </td>
                                    <td style="text-align:left !important">
                                        size : ${vItem.size}<br>
                                        <div class="mt-1" style="background-color: ${vItem.color}; height: 20px; width: 40px;"></div>
                                    </td>
                                    <td >${vItem.price} ₹</td>
                                    <td >${vItem.discount} %</td>
                                    <td class="text-success fs-16">${calculateFinalPrice(vItem.price , vItem.discount)} ₹</td>
                                    <td >
                                        <div class="input-group stock_number_bx">
                                            <span class="input-group-btn btn-number">
                                                <button 
                                                    type="button" 
                                                    class="quantity-left-minus btn btn-danger btn-number"
                                                    data-type="minus" 
                                                    data-field=""
                                                    id="btn-stock-sub-${vItem.uid}"
                                                    onClick="updateStock('${vItem.uid}','sub')">
                                                    <span>-</span>
                                                </button>
                                            </span>
                                            <input 
                                                type="text" 
                                                name="quantity" 
                                                class="stock_number btn-number" 
                                                value="${vItem.stock}" 
                                                id="input-stock-${vItem.uid}"
                                                readonly>
                                            <span class="input-group-btn btn-number">
                                                <button 
                                                    type="button" 
                                                    class="quantity-right-plus btn btn-success btn-number"
                                                    data-type="plus" 
                                                    data-field=""
                                                    id="btn-stock-add-${vItem.uid}"
                                                    onClick="updateStock('${vItem.uid}','add')">
                                                    <span>+</span>
                                                </button>
                                            </span>
                                        </div>
                                    </td>
                                </tr>`;
                        });
                        $('#table-product-variant-body').html(html);
                        $('#table-product-variant').DataTable();
                    }
                },
                error: function (err) {
                    console.log(err)
                }

            });
        }

        $('#add_stock_btn').on('click', function () {

            qty = $('#stock_qty').val()

            if (qty.length == 0) {
                $('#alert').html(`<div class="alert alert-warning alert-dismissible alert-label-icon label-arrow fade show material-shadow" role="alert">
                                                        <i class="ri-alert-line label-icon"></i><strong>Warning</strong> - Add Stock Amount
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                    </div>`)
            } else {

                let stock = parseInt($('#stock_qty').val())
                $.ajax({
                    url: "<?= base_url('/api/product/stock/update') ?>",
                    type: "GET",
                    data: {
                        p_id: '<?= $_GET['p_id'] ?>',
                        stock: stock
                    },
                    beforeSend: function () {
                        $(`#add_stock_btn`).attr('disabled', true)
                    },
                    success: function (resp) {
                        $(`#add_stock_btn`).attr('disabled', false)
                        if (resp.status) {
                            $('#alert').html(`<div class="alert alert-success alert-dismissible alert-label-icon label-arrow fade show material-shadow" role="alert">
                                                            <i class="ri-checkbox-circle-fill label-icon"></i><strong>${resp.message}</strong>
                                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                        </div>`)
                            $('#product_stock').html(stock)
                            $('#stock_qty').val(``)
                            get_product_data('<?= $_GET['p_id'] ?>');
                        }
                    },
                    error: function (err) {
                        console.log(err)
                        $(`#add_stock_btn`).attr('disabled', false)
                        $('#alert').html(`<div class="alert alert-warning alert-dismissible alert-label-icon label-arrow fade show material-shadow" role="alert">
                                                        <i class="ri-alert-line label-icon"></i><strong>Warning</strong> - Internal Server Error
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                    </div>`)
                    }
                })
            }

        })
    });

    function delete_product(p_id){
        $.ajax({
            url: "<?= base_url('/api/product/delete') ?>",
            type: 'GET',
            data: {
                p_id: p_id
            },
            beforeSend: function () { },
            success: function (resp) {
                console.log(resp);
                if (resp.status) {
                    window.location.href = '<?= base_url('admin/product/list') ?>';

                }
            },
            error: function (err) {
                console.log(err)
            }

        }) 
    }

</script>