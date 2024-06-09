
<script>
    $(document).ready(function () {


        // Initialize the carousel with options
        // $('#myCarousel').carousel({
        //     interval: 500,
        //     touch: true
        // });
        load_banners()
        products('all')
        get_promotion_card()
        latest_arival()
    })

    function products(product_type) {
        $.ajax({
            url: "<?= base_url('/api/product') ?>",
            type: "GET",
            success: function (resp) {

                if (resp.status) {
                    $('#all_products').empty();
                    var margin_top_mobile = 0
                    var margin_top_tab = 0
                    $.each(resp.data, function (index, product) {


                        var view_more = `<a href="<?= base_url('product/list') ?>" class="btn btn-soft-primary btn-hover">View All Products<i class="mdi mdi-arrow-right align-middle ms-1"></i></a>`
                        if (index <= 8) {
                            var original_price = product.base_discount ? (product.base_price - (product.base_price * product.base_discount / 100)).toFixed(2) : product.base_price.toFixed(2);
                            var base_price = product.base_discount ? product.base_discount : "";
                            if (product_type == 'all') {
                                var element = document.getElementById("deal-banner");
                                if (window.innerWidth > 1024) {
                                    if (index <= 2) {
                                        element.style.marginTop = "400px";
                                    } else if (index <= 5) {
                                        element.style.marginTop = "700px";
                                    } else if (index <= 8) {
                                        element.style.marginTop = "1100px";
                                    }
                                } else if (window.innerWidth <= 768) {
                                    margin_top_mobile = margin_top_mobile + 350
                                    element.style.marginTop = margin_top_mobile + "px";
                                }else if(window.innerWidth <= 991.98){
                                    margin_top_tab = margin_top_tab + 200
                                    element.style.marginTop = margin_top_tab + "px";
                                }
                                var add_to_cart_button = `<div class="product-btn px-3">
                                                            <a href="javascript:void(0);" onclick="add_to_cart('${product.product_id}')" class="btn btn-primary btn-sm w-75 add-btn"><i class="mdi mdi-cart me-1"></i> Add to cart</a>
                                                        </div>`
                                var message = ``
                                if (product.product_stock < 1) {
                                    add_to_cart_button = ``
                                    message = `<span style="color:red;">Currently unavailable</span>`

                                }
                                html = `<div class="element-item col-xxl-3 col-xl-4 col-sm-6 seller hot arrival" data-category="hot arrival">
                                            <div class="card overflow-hidden">
                                                <a href="<?= base_url('product/details?id=') ?>${product.product_id}">
                                                    <div class="bg-warning-subtle rounded-top">
                                                        <div class="gallery-product">
                                                            <img src="<?= base_url() ?>public/uploads/product_images/${product.product_img.length > 0 ? product.product_img[0].src : ''}" alt="" style="max-height: 215px; max-width: 100%" class="mx-auto d-block" />
                                                        </div>
                                                        <p class="fs-11 fw-medium badge bg-primary py-2 px-3 product-lable mb-0"> Best Arrival </p>
                                                        <div class="gallery-product-actions">
                                                            
                                                        </div>
                                                        ${add_to_cart_button}
                                                    </div>
                                                </a>
                                                <div class="card-body">
                                                    <div>
                                                        <a href="<?= base_url('product/details?id=') ?>${product.product_id}">
                                                            <h6 class="fs-15 lh-base text-truncate mb-0">
                                                               ${product.name}
                                                            </h6>
                                                        </a>
                                                        <div class="mt-3">
                                                            <span class="float-end">4.9
                                                                <i class="ri-star-half-fill text-warning align-bottom"></i></span>
                                                            <h5 class="mb-0">
                                                            ₹${original_price}
                                                                <span class="text-muted fs-12"><del>₹${product.base_price}</del></span>
                                                            </h5>
                                                        </div>
                                                        ${message}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>`
                                $('#all_products').append(html);
                            } else if (product_type == 'new_arrival') {
                                var currentDate = new Date(); // Current date
                                var oneWeekAgo = new Date();
                                oneWeekAgo.setDate(oneWeekAgo.getDate() - 2);
                                if (new Date(product.created_at) > oneWeekAgo && new Date(product.created_at) <= currentDate) {
                                    var element = document.getElementById("deal-banner");
                                    if (window.innerWidth > 1024) {
                                        if (index <= 2) {
                                            element.style.marginTop = "400px";
                                        } else if (index <= 5) {
                                            element.style.marginTop = "700px";
                                        } else if (index <= 8) {
                                            element.style.marginTop = "1100px";
                                        }
                                    } else if (window.innerWidth <= 768) {
                                        margin_top_mobile = margin_top_mobile + 350
                                        element.style.marginTop = margin_top_mobile + "px";
                                    }else if(window.innerWidth <= 991.98){
                                        margin_top_tab = margin_top_tab + 200
                                        element.style.marginTop = margin_top_tab + "px";
                                    }
                                    var add_to_cart_button = `<div class="product-btn px-3">
                                                                <a href="javascript:void(0);" onclick="add_to_cart('${product.product_id}')" class="btn btn-primary btn-sm w-75 add-btn"><i class="mdi mdi-cart me-1"></i> Add to cart</a>
                                                            </div>`
                                    var message = ``
                                    if (product.product_stock < 1) {
                                        add_to_cart_button = ``
                                        message = `<span style="color:red;">Currently unavailable</span>`

                                    }
                                    html = `<div class="element-item col-xxl-3 col-xl-4 col-sm-6 seller hot arrival" data-category="hot arrival">
                                                <div class="card overflow-hidden">
                                                    <a href="<?= base_url('product/details?id=') ?>${product.product_id}">
                                                        <div class="bg-warning-subtle rounded-top">
                                                            <div class="gallery-product">
                                                                <img src="<?= base_url() ?>public/uploads/product_images/${product.product_img.length > 0 ? product.product_img[0].src : ''}" alt="" style="max-height: 215px; max-width: 100%" class="mx-auto d-block" />
                                                            </div>
                                                            <p class="fs-11 fw-medium badge bg-primary py-2 px-3 product-lable mb-0"> Best Arrival </p>
                                                            <div class="gallery-product-actions">
                                                                
                                                            </div>
                                                            ${add_to_cart_button}
                                                        </div>
                                                    </a>
                                                    <div class="card-body">
                                                        <div>
                                                            <a href="<?= base_url('product/details?id=') ?>${product.product_id}">
                                                                <h6 class="fs-15 lh-base text-truncate mb-0">
                                                                ${product.name}
                                                                </h6>
                                                            </a>
                                                            <div class="mt-3">
                                                                <span class="float-end">4.9
                                                                    <i class="ri-star-half-fill text-warning align-bottom"></i></span>
                                                                <h5 class="mb-0">
                                                                ₹${original_price}
                                                                    <span class="text-muted fs-12"><del>₹${product.base_price}</del></span>
                                                                </h5>
                                                            </div>
                                                            ${message}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>`
                                    $('#all_products').append(html);
                                }
                            }


                        }
                        if (index > 8) {
                            $('#view_more_product').html(view_more);
                        }
                    })
                } else {
                    console.log(resp)
                }

            },
            error: function (err) {
                console.log(err)
            },
        })
    }


    // Function to determine if the image is light or dark
    function isImageLight(imageUrl, threshold = 128) {
        return new Promise((resolve, reject) => {
            let img = new Image();
            img.crossOrigin = 'Anonymous';
            img.src = imageUrl;
            img.onload = function () {
                let canvas = document.createElement('canvas');
                let ctx = canvas.getContext('2d');
                canvas.width = img.width;
                canvas.height = img.height;
                ctx.drawImage(img, 0, 0);
                let imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
                let brightnessSum = 0;
                for (let i = 0; i < imageData.data.length; i += 4) {
                    let r = imageData.data[i];
                    let g = imageData.data[i + 1];
                    let b = imageData.data[i + 2];
                    let brightness = (r + g + b) / 3;
                    brightnessSum += brightness;
                }
                let averageBrightness = brightnessSum / (imageData.data.length / 4);
                resolve(averageBrightness >= threshold);
            };
            img.onerror = function () {
                reject('Error loading image');
            };
        });
    }

    function load_banners() {
        $.ajax({
            url: "<?= base_url('/api/banners') ?>",
            type: "GET",
            beforeSend: function () {
            },
            success: function (resp) {
                if (resp.status) {
                    $.each(resp.data, function (index, banner) {
                        let fontColor = '';
                        isImageLight(`<?= base_url('public/uploads/banner_images/') ?>${banner.img}`)
                            .then(isLight => {
                                if (isLight) {
                                    // console.log('Image is light');
                                    fontColor = 'black';
                                } else {
                                    // console.log('Image is dark');
                                    fontColor = 'light';
                                }
                                console.log(fontColor);

                                isActive = index === 0 ? 'active' : ''
                                // console.log(isActive);
                                var shop_now = ``
                                if (banner.title != "") {
                                    shop_now = ` <a href="${banner.link}" class="btn btn-danger btn-hover"><i class="ph-shopping-cart align-middle me-1"></i> ShopNow</a>`
                                }
                                html = ` <div class="carousel-item ${isActive}">
                                            <a href="${banner.link}" >
                                                <div class="image-container">
                                                    <img src="<?= base_url('public/uploads/banner_images/') ?>${banner.img}" class="d-block w-100 carousel_img">
                                                </div>
                                                <div class="carousel-caption">
                                                    <div class="row justify-content-end">
                                                        <div class="col-lg-12">
                                                            <div class="text-sm-end">
                                                                <h6 class="fs-24 display-4 fw-bold lh-base text-capitalize mb-3 text-${fontColor}">
                                                                    ${banner.title}
                                                                </h6>
                                                                <div class="fs-20 mb-4 text-${fontColor}">
                                                                    ${banner.description}
                                                                </div>
                                                                ${shop_now}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>`


                                $('#banner_img').append(html);
                            })
                            .catch(error => {
                                console.error(error);
                            });
                    })
                } else {
                }

            },
            error: function (err) {
                console.log(err)
            },
            complete: function () {

            }
        })
    }

    function add_to_cart(p_id) {

        $.ajax({
            url: "<?= base_url('/api/user/id') ?>",
            type: "GET",
            success: function (resp) {

                if (resp.status) {
                    // console.log(resp.data)
                    $.ajax({
                        url: "<?= base_url('/api/user/cart/add') ?>",
                        type: "POST",
                        data: {
                            product_id: p_id,
                            user_id: resp.data,
                            variation_id: 'VAR00001',
                            qty: '1',
                        },
                        success: function (resp) {

                            if (resp.status) {
                                Toastify({
                                    text: resp.message.toUpperCase(),
                                    duration: 3000,
                                    position: "center",
                                    stopOnFocus: true,
                                    style: {
                                        background: resp.status ? 'darkgreen' : 'darkred',
                                    },

                                }).showToast();
                            } else {
                                console.log(resp)
                                Toastify({
                                    text: resp.message.toUpperCase(),
                                    duration: 3000,
                                    position: "center",
                                    stopOnFocus: true,
                                    style: {
                                        background: resp.status ? 'darkgreen' : 'darkred',
                                    },

                                }).showToast();
                            }

                        },
                        error: function (err) {
                            console.log(err)
                        },
                    })

                } else {
                    // console.log(resp)

                    var existingData = localStorage.getItem('cartData');
                    var dataArray = existingData ? JSON.parse(existingData) : [];
                    if (!Array.isArray(dataArray)) {
                        dataArray = []; // Initialize as empty array if not already an array
                    }
                    var data = {
                        product_id: p_id,
                        variation_id: 'VAR00001',
                        qty: '1'
                    };
                    dataArray.push(data);

                    var jsonData = JSON.stringify(dataArray);
                    localStorage.setItem('cartData', jsonData);


                    // Retrieve data from local storage
                    var storedData = localStorage.getItem('cartData');
                    var retrievedData = JSON.parse(storedData);
                    // console.log(retrievedData); // This will log 'value1'

                    if (retrievedData != "") {
                        var message = 'Item added to cart'
                        Toastify({
                            text: message.toUpperCase(),
                            duration: 3000,
                            position: "center",
                            stopOnFocus: true,
                            style: {
                                background: 'darkgreen',
                            },

                        }).showToast();
                    } else {
                        var message = 'Item added Faild!'
                        Toastify({
                            text: message.toUpperCase(),
                            duration: 3000,
                            position: "center",
                            stopOnFocus: true,
                            style: {
                                background: 'darkred',
                            },

                        }).showToast();
                    }

                }


            },
            error: function (err) {
                console.log(err)
            },
        })

    }

    function latest_arival() {
        $.ajax({
            url: "<?= base_url('/api/product') ?>",
            type: "GET",
            beforeSend: function () {
            },
            success: function (resp) {
                if (resp.status) {
                    var currentDate = new Date(); // Current date
                    var oneWeekAgo = new Date();
                    oneWeekAgo.setDate(oneWeekAgo.getDate() - 7);
                    // var element = document.getElementById("deal-banner");
                    $.each(resp.data, function (index, product) {
                        // if(window.innerWidth > 1024){
                        //     if(index <= 2){
                        //         element.style.marginTop = "400px";
                        //     }else if(index <= 5){
                        //         element.style.marginTop = "700px";
                        //     }else if(index <= 8){
                        //         element.style.marginTop = "1100px";
                        //     }
                        // }
                        var add_to_cart_button = ` <div class="mt-3">
                                                        <a  onclick="add_to_cart('${product.product_id}')" class="btn btn-primary btn-sm"><i
                                                                class="mdi mdi-cart me-1"></i> Add to cart</a>
                                                    </div>`
                        if (product.product_stock < 1) {
                            add_to_cart_button = `<span style="color:red;">Currently unavailable</span>`

                        }

                        if (new Date(product.created_at) > oneWeekAgo && new Date(product.created_at) <= currentDate) {
                            var original_price = product.base_discount ? (product.base_price - (product.base_price * product.base_discount / 100)).toFixed(2) : product.base_price.toFixed(2);
                            var base_price = product.base_discount ? product.base_discount : "";
                            // console.log('resp=',new Date(product.created_at));
                            html = `<div class="swiper-slide">
                                        <div class="card overflow-hidden">
                                            <a href="<?= base_url('product/details?id=') ?>${product.product_id}">
                                                <div class="bg-dark-subtle rounded-top py-4">
                                                    <div class="gallery-product">
                                                        <img src="<?= base_url() ?>public/uploads/product_images/${product.product_img.length > 0 ? product.product_img[0].src : ''}" alt=""
                                                            style="max-height: 215px; max-width: 100%" class="mx-auto d-block" />
                                                    </div>
                                                </div>
                                            </a>
                                            <div class="card-body">
                                                <div>
                                                    <a href="<?= base_url('product/details?id=') ?>${product.product_id}">
                                                        <h6 class="fs-15 lh-base text-truncate mb-0">
                                                            ${product.name}
                                                        </h6>
                                                    </a>
                                                    <div class="mt-3">
                                                        <span class="float-end">3.2
                                                            <i class="ri-star-half-fill text-warning align-bottom"></i></span>
                                                        <h5 class="mb-0">
                                                            ₹${original_price}
                                                            <span class="text-muted fs-12"><del>₹${product.base_price}</del></span>
                                                        </h5>
                                                    </div>
                                                   ${add_to_cart_button}
                                                </div>
                                            </div>
                                        </div>
                                    </div>`
                            $('#latest_arriva').append(html);
                        }
                    })
                } else {
                }

            },
            error: function (err) {
                console.log(err)
            },
            complete: function () {

            }
        })
    }

    function get_promotion_card() {
        $.ajax({
            url: "<?= base_url('/api/promotion-card/update') ?>",
            type: "GET",
            success: function (resp) {
                if (resp.status) {
                    // console.log(resp)

                    // $('#images1').html(`<img src="<?= base_url('public/uploads/promotion_card_images/') ?>${resp.data.img1}" alt="">`)
                    // $('#imgLink1').val(resp.data.link1)
                    // $('#images2').html(`<img src="<?= base_url('public/uploads/promotion_card_images/') ?>${resp.data.img2}" alt="">`)
                    // $('#imgLink2').val(resp.data.link2)
                    // $('#card_id').val(resp.data.uid)

                    html = `<div class="col-12 col-md-6">
                            <a href="${resp.data.link1}" class="product-banner-1 mt-4 mt-lg-0 rounded overflow-hidden position-relative d-block">
                                <img src="<?= base_url('public/uploads/promotion_card_images/') ?>${resp.data.img1}" class="img-fluid rounded" style="width: 100%; height: 50%; object-fit: cover;  object-position: center;" alt="" />
                                <div class="bg-overlay blue"></div>
                                <div class="product-content p-4">
                                </div>
                            </a>
                        </div>
                        <div class="col-12 col-md-6">
                            <a href="${resp.data.link2}" class="product-banner-1 mt-4 mt-lg-0 rounded overflow-hidden position-relative d-block">
                                <img src="<?= base_url('public/uploads/promotion_card_images/') ?>${resp.data.img2}" class="img-fluid rounded" style="width: 100%; height: 50%; object-fit: cover;  object-position: center;" alt="" />
                                <div class="product-content p-4">
                                </div>
                            </a>
                        </div>`
                    $('#promotion_card').append(html);

                } else {
                    console.log(resp)
                }
            },
            error: function (err) {
                console.log(err)
            },
        })
    }

    function out_of_stock() {
        Toastify({
            text: 'Currently this product is out of stock'.toUpperCase(),
            duration: 3000,
            position: "center",
            stopOnFocus: true,
            style: {
                background: 'gray',
            },

        }).showToast();
    }

</script>