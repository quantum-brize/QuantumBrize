<!-- Modal Js -->
<script src="assets/js/pages/modal.init.js"></script>
<script>
    // Call the function to fetch and display categories
    get_parent_categories();
    function get_parent_categories() {
        $.ajax({
            url: '<?= base_url('/api/categories') ?>',
            type: "GET",
            beforeSend: function () {
                $('#accordion').html(`<center><div class="spinner-border text-primary" role="status"></div></center>`)
            },
            success: function (resp) {

                let html = ''
                if (resp.status) {
                    if (resp.data.length > 0) {
                        $.each(resp.data, (index, category) => {
                            html += `<div class="accordion-item" id="${category.uid}-category-id">
                                        <h2 class="accordion-header" id="${category.uid}-category-id-heading">
                                            <input 
                                                type="text" 
                                                class="form-control fs-15" 
                                                disabled 
                                                value="${category.name}" 
                                                id="${category.uid}-category-input"
                                            >
                                            <button 
                                                class="btn btn-success" 
                                                id="${category.uid}-save-category-btn" 
                                                onclick="save_category('${category.uid}','${category.uid}-category-input','${category.uid}-save-category-btn')" 
                                                hidden>
                                                <i class="ri-save-line fs-15"></i>
                                            </button>
                                            <button 
                                                class="btn btn-info" 
                                                id="${category.uid}-update-category-btn" 
                                                onclick="update_category('${category.uid}-category-input','${category.uid}-save-category-btn')">
                                                <i class="ri-edit-line fs-15"></i>
                                            </button>
                                            <button 
                                                class="btn btn-danger" 
                                                id="${category.uid}-delete-category-btn"
                                                onclick="delete_category('${category.uid}','${category.uid}-category-id')">
                                                <i class="ri-delete-bin-line fs-15"></i>
                                            </button>
                                            <button 
                                                class="accordion-button collapsed fs-15 fw-500" 
                                                type="button" 
                                                data-bs-toggle="collapse" 
                                                data-bs-target="#${category.uid}-collapse" 
                                                aria-expanded="false" 
                                                aria-controls="${category.uid}-collapse-accordion-body-id" 
                                                onclick="getSubCategory('${category.uid}','${category.uid}-collapse-accordion-body-id')">
                                            </button>
                                        </h2>
                                        <div 
                                            id="${category.uid}-collapse" 
                                            class="accordion-collapse collapse" 
                                            aria-labelledby="${category.uid}-category-id-heading"
                                            data-bs-parent="#${category.uid}-category-id">
                                            <div class="collapse-accordion-body" id="${category.uid}-collapse-accordion-body-id">

                                                

                                            </div>
                                        </div>
                                    </div>`
                        })
                        
                    }
                    
                }
                html += `<div class="accordion-item" id="new-category-bx">
                            <h2 class="accordion-header">
                                <input type="text" class="form-control fs-15" id="new-category-input">
                                <button class="btn btn-success" id="new-category-btn" onclick="add_category('null','new-category-input','new-category-btn','new-category-bx')">
                                    <i class="ri-add-fill fs-15"></i>
                                </button>
                            </h2>
                        </div>`
                $('#accordion').html(html)


            },
            error: function (err) {
                console.log(err);
            }
        });
    }

    function getSubCategory(category_id, accordion_body_id) {

        $.ajax({
            url: '<?= base_url('/api/categories') ?>',
            data: {
                parent_id: category_id
            },
            type: "GET",
            beforeSend: function () {
                $(`#${accordion_body_id}`).html(`<center><div class="spinner-border text-primary" role="status"></div></center>`)
            },
            success: function (resp) {
                console.log(resp)
                html = ''

                if (resp.status) {
                    if (resp.data.length > 0) {
                        $.each(resp.data, (index, category) => {
                            html += `<div class="accordion-item" id="${category.uid}-category-id"  >
                                        <h2 class="accordion-header" id="${category.uid}-category-id-heading">
                                            <input 
                                                type="text" 
                                                class="form-control fs-15" 
                                                disabled 
                                                value="${category.name}" 
                                                id="${category.uid}-category-input"
                                            >
                                            <button 
                                                class="btn btn-success" 
                                                id="${category.uid}-save-category-btn" 
                                                onclick="save_category('${category.uid}','${category.uid}-category-input','${category.uid}-save-category-btn')" 
                                                hidden>
                                                <i class="ri-save-line fs-15"></i>
                                            </button>
                                            <button 
                                                class="btn btn-info" 
                                                id="${category.uid}-update-category-btn" 
                                                onclick="update_category('${category.uid}-category-input','${category.uid}-save-category-btn')">
                                                <i class="ri-edit-line fs-15"></i>
                                            </button>
                                            <button 
                                                class="btn btn-danger" 
                                                id="${category.uid}-delete-category-btn"
                                                onclick="delete_category('${category.uid}','${category.uid}-category-id')">
                                                <i class="ri-delete-bin-line fs-15"></i>
                                            </button>
                                            <button 
                                                class="accordion-button collapsed fs-15 fw-500" 
                                                type="button" 
                                                data-bs-toggle="collapse" 
                                                data-bs-target="#${category.uid}-collapse" 
                                                aria-expanded="false" 
                                                aria-controls="${category.uid}-collapse-accordion-body-id" 
                                                onclick="getSubCategory('${category.uid}','${category.uid}-collapse-accordion-body-id')">
                                            </button>
                                        </h2>
                                        <div 
                                            id="${category.uid}-collapse" 
                                            class="accordion-collapse collapse" 
                                            aria-labelledby="${category.uid}-category-id-heading"
                                            data-bs-parent="#${category.uid}-category-id">
                                            <div class="collapse-accordion-body" id="${category.uid}-collapse-accordion-body-id">

                                                

                                            </div>
                                        </div>
                                    </div>`
                        })
                    }

                }

                html += `<div class="accordion-item" id="${category_id}-new-category-bx"  >
                            <h2 class="accordion-header">
                                <input type="text" class="form-control fs-15" id="${category_id}-new-category-input">
                                <button class="btn btn-success" id="${category_id}-new-category-btn" onclick="add_category('${category_id}','${category_id}-new-category-input','${category_id}-new-category-btn','${category_id}-new-category-bx')">
                                    <i class="ri-add-fill fs-15"></i>
                                </button>
                            </h2>
                        </div>`
                $(`#${accordion_body_id}`).html(html)
            },
            error: function (err) {
                console.log(err);

            }

        })


    }


    function delete_category_action() {
        let category_id = $('#delete_cat_id').val()
        let bx = $('#delete_cat_bx').val()



        $.ajax({
            url: '<?= base_url('/api/category/delete') ?>',
            type: 'POST',
            data: {
                category_id: category_id
            },
            beforeSend: function () {
                $(`#delete_action_btn`).attr('disabled', true)
                $(`#delete_action_btn`).html(`<center><div class="spinner-border text-light" style='height: 20px; width: 20px;' role="status"></div></center>`)
            },
            success: function (resp) {
                if (resp.status) {
                    $(`#${bx}`).hide()
                }
                $('#delete_modal').hide();
                $(`#delete_action_btn`).attr('disabled', false)
                $(`#delete_action_btn`).html('DELETE')
            },
            error: function (err) {
                console.log(err);
                $(`#delete_action_btn`).attr('disabled', false)
                $(`#delete_action_btn`).html('DELETE')
            }

        })

    }

    function delete_category(category_id, category_bx) {
        console.log(category_bx)
        $('#delete_modal').show();
        $('#delete_cat_id').val(category_id)
        $('#delete_cat_bx').val(category_bx)
    }

    function hide_delete_modal() {
        $('#delete_modal').hide();
        $('#delete_cat_id').val('')
        $('#delete_cat_bx').val('')
    }



    function add_category(parent_id, input_id, btn_id, bx) {

        let category_name = $(`#${input_id}`).val()

        $.ajax({
            url: "<?= base_url('/api/category/add') ?>",
            type: 'POST',
            data: {
                parent_id: parent_id,
                category_name: category_name
            },
            beforeSend: function () {
                $(`#${btn_id}`).attr('disabled', true)
                $(`#${btn_id}`).html(`<center><div class="spinner-border text-light" style='height: 20px; width: 20px;' role="status"></div></center>`)
            },
            success: function (resp) {
                console.log(resp)
                if (resp.status) {
                    let category = resp.data
                    $(`#${bx}`).before(`<div class="accordion-item" id="${category.uid}-category-id"  >
                                        <h2 class="accordion-header" id="${category.uid}-category-id-heading">
                                            <input 
                                                type="text" 
                                                class="form-control fs-15" 
                                                disabled 
                                                value="${category.name}" 
                                                id="${category.uid}-category-input"
                                            >
                                            <button 
                                                class="btn btn-success" 
                                                id="${category.uid}-save-category-btn" 
                                                onclick="save_category('null','${$("#" + category.uid + "-category-input").val()}','${category.uid}-save-category-btn')" 
                                                hidden>
                                                <i class="ri-save-line fs-15"></i>
                                            </button>
                                            <button 
                                                class="btn btn-info" 
                                                id="${category.uid}-update-category-btn" 
                                                onclick="update_category('${category.uid}-category-input','${category.uid}-save-category-btn')">
                                                <i class="ri-edit-line fs-15"></i>
                                            </button>
                                            <button 
                                                class="btn btn-danger" 
                                                id="${category.uid}-delete-category-btn"
                                                onclick="delete_category('${category.uid}-category-input','${category.uid}-category-id')">
                                                <i class="ri-delete-bin-line fs-15"></i>
                                            </button>
                                            <button 
                                                class="accordion-button collapsed fs-15 fw-500" 
                                                type="button" 
                                                data-bs-toggle="collapse" 
                                                data-bs-target="#${category.uid}-collapse" 
                                                aria-expanded="false" 
                                                aria-controls="${category.uid}-collapse-accordion-body-id" 
                                                onclick="getSubCategory('${category.uid}','${category.uid}-collapse-accordion-body-id')">
                                            </button>
                                        </h2>
                                        <div 
                                            id="${category.uid}-collapse" 
                                            class="accordion-collapse collapse" 
                                            aria-labelledby="${category.uid}-category-id-heading"
                                            data-bs-parent="#${category.uid}-category-id">
                                            <div class="collapse-accordion-body" id="${category.uid}-collapse-accordion-body-id">

                                            </div>
                                        </div>
                                    </div>`);
                    $(`#${input_id}`).val('')
                }
                $(`#${btn_id}`).html(`<i class="ri-add-fill fs-15"></i>`)
                $(`#${btn_id}`).attr('disabled', false)

            },
            error: function (err) {
                console.log(err);
                $(`#${btn_id}`).html(`<i class="ri-add-fill fs-15"></i>`)
                $(`#${btn_id}`).attr('disabled', false)
            }
        })


    }



    function update_category(input_id, save_btn_id) {
        $('#' + input_id).attr('disabled', false);
        $('#' + input_id).focus();
        $('#' + save_btn_id).attr('hidden', false);
    }



    function save_category(category_id, input_id, save_btn_id) {
        $.ajax({
            url: '<?=base_url('/api/category/update')?>',
            type: 'POST',
            data: {
                category_id: category_id,
                name: $(`#${input_id}`).val()
            },
            beforeSend: function () {
                $('#' + save_btn_id).html(`<center><div class="spinner-border text-light" style='height: 20px; width: 20px;' role="status"></div></center>`);
                $('#' + save_btn_id).attr('disabled', true);
            },
            success: function (resp) {
                $('#' + save_btn_id).html(`<i class="ri-save-line fs-15"></i>`);
                $('#' + input_id).attr('disabled', true);
                $('#' + save_btn_id).attr('hidden', true);
                $('#' + save_btn_id).attr('disabled', false);

            },
            error: function (err) {
                console.log(err);
                $('#' + save_btn_id).html(`<i class="ri-save-line fs-15"></i>`);
                $('#' + input_id).attr('disabled', true);
                $('#' + save_btn_id).attr('hidden', true);
                $('#' + save_btn_id).attr('disabled', false);
            }

        })

    }
</script>