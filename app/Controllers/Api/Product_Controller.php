<?php

namespace App\Controllers\Api;

use App\Models\ProductModel;
use App\Models\ProductItemModel;
use App\Models\ProductConfigModel;
use App\Models\ProductMetaDetalisModel;
use App\Models\CommonModel;
use App\Models\VendorModel;
use App\Models\ProductImagesModel;
use App\Models\VariationModel;
use App\Models\VariationOptionModel;
use App\Models\VariantImagesModel;
use App\Models\DiscountsModel;
use App\Models\OrdersModel;
use App\Models\OrderItemsModel;

class Product_Controller extends Api_Controller
{

    public function index(): void
    {
        echo 'PRODUCT';
    }

    private function add_product($data)
    {
        $resp = [
            'status' => false,
            'message' => 'Product not added',
            'data' => null
        ];
        $VendorModel = new VendorModel();
        $vendorRow = $VendorModel->where('user_id', $data['user_id'])->first();
        $vendor_id = !empty($vendorRow['uid']) ? $vendorRow['uid'] : '';
        $uploadedFiles = $this->request->getFiles();



        if (empty($data['title'])) {
            $resp['message'] = 'Your Product Has No Name';
        } else if (empty($data['details'])) {
            $resp['message'] = 'Please add Some Details About Your Product';
        } else if (empty($data['price'])) {
            $resp['message'] = 'Set The Price Of Your Product';
        } else if (empty($data['categoryId'])) {
            $resp['message'] = 'Set The Category Of Your Product';
        } else if (empty($vendor_id)) {
            $resp['message'] = 'Vendor Not Found';
        } else if (empty($uploadedFiles['images'])) {
            $resp['message'] = 'Please Add One Product Image';
        } else {


            $product_data = [
                'uid' => $this->generate_uid(UID_PRODUCT),
                'vendor_id' => $vendor_id,
                'category_id' => $data['categoryId'],
                'name' => $data['title'],
                'description' => $data['details'],
            ];
            $product_item_data = [
                'uid' => $this->generate_uid(UID_PRODUCT_ITEM),
                'product_id' => $product_data['uid'],
                'price' => $data['price'],
                'discount' => $data['discount'],
                'product_tags' => $data['productTags'],
                'publish_date' => $data['publishDate'],
                'status' => $data['status'],
                'visibility' => $data['visibility'],
                'manufacturer_brand' => $data['manufacturerBrand'],
                'manufacturer_name' => $data['manufacturerName']
            ];
            $product_meta_data = [
                'uid' => $this->generate_uid(UID_PRODUCT_META),
                'product_id' => $product_data['uid'],
                'meta_title' => $data['metaTitle'],
                'meta_description' => $data['metaDescription'],
                'meta_keywords' => $data['metaKeywords'],
            ];

            $ProductImagesModel = new ProductImagesModel();
            foreach ($uploadedFiles['images'] as $file) {
                $file_src = $this->single_upload($file, PATH_PRODUCT_IMG);
                $product_image_data = [
                    'uid' => $this->generate_uid(UID_PRODUCT_IMG),
                    'product_id' => $product_data['uid'],
                    'type' => 'path',
                    'src' => $file_src
                ];
                $ProductImagesModel->insert($product_image_data);
            }

            $ProductModel = new ProductModel();
            $ProductItemModel = new ProductItemModel();
            $ProductMetaDetalisModel = new ProductMetaDetalisModel();


            // Transaction Start
            $ProductModel->transStart();
            try {
                $ProductModel->insert($product_data);
                $ProductItemModel->insert($product_item_data);
                $ProductMetaDetalisModel->insert($product_meta_data);
                // Commit the transaction if all queries are successful
                $ProductModel->transCommit();
            } catch (\Exception $e) {
                // Rollback the transaction if an error occurs
                $ProductModel->transRollback();
                $resp['message'] = $e->getMessage();
            }

            $resp['status'] = true;
            $resp['message'] = 'Product added';
            $resp['data'] = ['product_id' => $product_data['uid']];
        }
        return $resp;
    }

    private function update_product($data)
    {
        $resp = [
            'status' => false,
            'message' => 'Product not Updated',
        ];
        if (empty($data['title'])) {
            $resp['message'] = 'Your Product Has No Name';
        } else if (empty($data['details'])) {
            $resp['message'] = 'Please add Some Details About Your Product';
        } else if (empty($data['price'])) {
            $resp['message'] = 'Set The Price Of Your Product';
        } else if (empty($data['categoryId'])) {
            $resp['message'] = 'Set The Category Of Your Product';
        } else {
            $product_data = [
                'category_id' => $data['categoryId'],
                'name' => $data['title'],
                'description' => $data['details'],
            ];
            $product_item_data = [
                'price' => $data['price'],
                'discount' => $data['discount'],
                'product_tags' => $data['productTags'],
                'publish_date' => $data['publishDate'],
                'status' => $data['status'],
                'visibility' => $data['visibility'],
                'manufacturer_brand' => $data['manufacturerBrand'],
                'manufacturer_name' => $data['manufacturerName']
            ];

            $product_meta_data = [
                'meta_title' => $data['metaTitle'],
                'meta_description' => $data['metaDescription'],
                'meta_keywords' => $data['metaKeywords'],
            ];

            $ProductModel = new ProductModel();
            $ProductItemModel = new ProductItemModel();
            $ProductMetaDetalisModel = new ProductMetaDetalisModel();
            $ProductImagesModel = new ProductImagesModel();

            $uploadedFiles = $this->request->getFiles();
            if (isset($uploadedFiles['images'])) {
                foreach ($uploadedFiles['images'] as $file) {
                    $file_src = $this->single_upload($file, PATH_PRODUCT_IMG);
                    $product_image_data = [
                        'uid' => $this->generate_uid(UID_PRODUCT_IMG),
                        'product_id' => $data['product_id'],
                        'type' => 'path',
                        'src' => $file_src
                    ];
                    $ProductImagesModel->insert($product_image_data);
                }
            }


            // Transaction Start
            $ProductModel->transStart();
            //$this->pr($product_data);
            //$this->pr($product_item_data);
            //$this->prd($product_meta_data);

            try {
                $ProductModel->set($product_data)
                    ->where('uid', $data['product_id'])
                    ->update();
                $ProductItemModel->set($product_item_data)
                    ->where('product_id', $data['product_id'])
                    ->update();
                $ProductMetaDetalisModel->set($product_meta_data)
                    ->where('product_id', $data['product_id'])
                    ->update();

                // Commit the transaction if all queries are successful
                $ProductModel->transCommit();
                $resp = [
                    'status' => true,
                    'message' => 'Product Updated',
                ];

            } catch (\Exception $e) {
                // Rollback the transaction if an error occurs
                $ProductModel->transRollback();
                $resp['message'] = $e->getMessage();
            }

        }

        return $resp;

    }


    private function add_new_variant($data)
    {
        $resp = [
            'status' => false,
            'message' => 'Product not added',
            'data' => null
        ];

        $colorVarOptData = [
            'uid' => $this->generate_uid(UID_VAR_OPT),
            'variation_id' => $data['colorId'],
            'value' => $data['colorVal']
        ];
        $var1 = [
            'uid' => $this->generate_uid(UID_PRO_CONFIG),
            'product_id' => $data['productId'],
            'variation_option_id' => $colorVarOptData['uid'],
            'price' => $data['price'],
            'discount' => $data['discount'],
            'sku' => $data['stock'],
        ];
        $var2 = [
            'uid' => $var1['uid'],
            'product_id' => $data['productId'],
            'variation_option_id' => $data['sizeId'],
            'price' => $data['price'],
            'discount' => $data['discount'],
            'sku' => $data['stock'],
        ];

        $uploadedFiles = $this->request->getFiles();
        $VariantImagesModel = new VariantImagesModel();
        foreach ($uploadedFiles['images'] as $file) {
            $file_src = $this->single_upload($file, PATH_VARIANT_IMG);
            $product_image_data = [
                'uid' => $this->generate_uid(UID_VAR_IMG),
                'config_id' => $var1['uid'],
                'type' => 'path',
                'src' => $file_src
            ];
            $VariantImagesModel->insert($product_image_data);
        }

        $VariationOptionModel = new VariationOptionModel();
        $ProductConfigModel = new ProductConfigModel();
        try {
            $VariationOptionModel->insert($colorVarOptData);
            $ProductConfigModel->insert($var1);
            $ProductConfigModel->insert($var2);
            $resp = [
                'status' => true,
                'message' => 'Product added',
                'data' => ['variant_id' => $var1['uid']]
            ];

        } catch (\Exception $e) {
            $resp['message'] = $e;
        }

        return $resp;
    }

    public function products($data)
    {
        $resp = [
            'status' => false,
            'message' => 'Product not Found',
            'data' => null
        ];

        $CommonModel = new CommonModel();

        $sql = "SELECT
            product.uid AS product_id,
            product.name AS name,
            product.description AS description,
            product.created_at AS created_at,
            categories.name AS category,
            categories.uid AS category_id,
            product_item.uid AS product_item_id,
            product_item.price AS base_price,
            product_item.sku AS product_stock,
            product_item.discount AS base_discount,
            product_item.product_tags AS tags,
            product_item.publish_date AS publish_date,
            product_item.status AS status,
            product_item.visibility AS visibility,
            product_item.manufacturer_brand AS manufacturer_brand,
            product_item.manufacturer_name AS manufacturer_name,
            product_meta_detalis.uid AS meta_id,
            product_meta_detalis.meta_title,
            product_meta_detalis.meta_description,
            product_meta_detalis.meta_keywords,
            users.user_name AS vendor,
            vendor.uid AS vendor_id
        FROM
            product
        JOIN
            product_item ON product.uid = product_item.product_id
        JOIN
            product_meta_detalis ON product.uid = product_meta_detalis.product_id
        JOIN 
            categories ON product.category_id = categories.uid
        JOIN
            vendor ON product.vendor_id = vendor.uid
        JOIN
            users ON vendor.user_id = users.uid";

        if (!empty($data['p_id'])) {
            $p_id = $data['p_id'];
            $sql .= " WHERE
                product.uid = '{$p_id}';";

        } else if (!empty($data['c_id'])) {
            $c_id = $data['c_id'];
            $sql .= " WHERE
                product.category_id = '{$c_id}';";

        } else if (!empty($data['v_id'])) {
            $v_id = $data['v_id'];
            $sql .= " WHERE
                vendor.user_id = '{$v_id}';";
        } else {
            $sql .= ";";
        }


        //$this->prd()

        $products = $CommonModel->customQuery($sql);

        if (count($products) > 0) {
            $ProductImagesModel = new ProductImagesModel();
            foreach ($products as $key => $product) {
                $products[$key]->product_img = $ProductImagesModel->where('product_id', $product->product_id)->findAll();
            }

            $resp["status"] = true;
            $resp["data"] = !empty($data['p_id']) ? $products[0] : $products;
            $resp["message"] = 'Products Found';
        }
        // $this->prd($resp);
        return $resp;
    }

    private function variation($p_id)
    {
        $resp = [
            'status' => false,
            'message' => 'Product not Found',
            'data' => null
        ];

        $CommonModel = new CommonModel();
        $sql = "SELECT
                    product_config.uid,
                    product_config.sku AS stock,
                    product_config.price,
                    product_config.discount,
                    variation.name,
                    variation_option.value
                FROM
                    product_config
                JOIN
                    variation_option ON product_config.variation_option_id = variation_option.uid
                JOIN
                    variation ON variation_option.variation_id = variation.uid
                WHERE 
                    product_config.product_id = '{$p_id}'";

        $variants = $CommonModel->customQuery($sql);
        if (count($variants) > 0) {
            $VariantImagesModel = new VariantImagesModel();
            foreach ($variants as $key => $variant) {
                $variants[$key]->product_img = $VariantImagesModel->where('config_id', $variant->uid)->findAll();
            }

            $mergedArray = [];

            foreach ($variants as $key => $variant) {
                $uid = $variant->uid;
                $color = $variant->name === 'color' ? $variant->value : null;
                $size = $variant->name === 'size' ? $variant->value : null;

                if (!isset($mergedArray[$uid])) {
                    // If the UID doesn't exist in mergedArray, initialize it
                    $mergedArray[$uid] = $variant;
                    // Initialize empty arrays for product_img
                    $mergedArray[$uid]->product_img = [];
                } else {
                    // If UID exists, merge the product_img array
                    $mergedArray[$uid]->product_img = array_merge($mergedArray[$uid]->product_img, $variant->product_img);
                }

                // Set color and size directly in the object
                if ($color !== null) {
                    $mergedArray[$uid]->color = $color;
                    unset($mergedArray[$uid]->name);
                    unset($mergedArray[$uid]->value);
                }

                if ($size !== null) {
                    $mergedArray[$uid]->size = $size;
                    unset($mergedArray[$uid]->name);
                    unset($mergedArray[$uid]->value);
                }
            }
            $mergedArray = array_values($mergedArray);
            //$this->prd($mergedArray);


            $resp["status"] = true;
            $resp["data"] = $mergedArray;
            $resp["message"] = 'Products Found';
        }
        return $resp;
    }

    private function variation_options()
    {
        $resp = [
            'status' => false,
            'message' => 'varaints not found',
            'data' => null
        ];
        $VariationModel = new VariationModel();
        $VariationOptionModel = new VariationOptionModel();

        try {
            $variations = $VariationModel->findAll();

            foreach ($variations as $key => $val) {
                $variations[$key]['options'] = $VariationOptionModel->where('variation_id', $val['uid'])->findAll();
            }

            $resp = [
                'status' => true,
                'message' => 'varaints found',
                'data' => $variations
            ];

        } catch (\Exception $e) {
            // Rollback the transaction if an error occurs
            $VariationModel->transRollback();
            throw $e;
        }


        return $resp;
    }

    private function user_id()
    {
        $resp = [
            'status' => false,
            'message' => 'User id not found',
            'data' => null
        ];
        $user_id = $this->is_logedin();
        if (!empty($user_id)) {
            $resp['status'] = true;
            $resp['message'] = 'User id found';
            $resp['data'] = $user_id;
        }

        // $this->prd($resp);

        return $resp;
    }

    private function product_stock_update($data)
    {
        $resp = [
            'status' => false,
            'message' => 'Stock Not Updated',
            'data' => null
        ];


        try {
            $ProductItemModel = new ProductItemModel();

            $isUpdated = $ProductItemModel->set(['sku' => $data['stock']])
                ->where('product_id', $data['p_id'])
                ->update();
            if ($isUpdated == '1') {
                $resp = [
                    'status' => true,
                    'message' => 'Stock Updated',
                    'data' => ['updatedStock' => $data['stock']]
                ];
            }
        } catch (\Exception $e) {
            $resp['message'] = $e;
        }
        return $resp;

    }

    private function product_config_stock_update($data)
    {

        $resp = [
            'status' => false,
            'message' => 'Stock Not Updated',
            'data' => null
        ];


        try {
            $ProductConfigModel = new ProductConfigModel();

            $isUpdated = $ProductConfigModel->set(['sku' => $data['stock']])
                ->where('uid', $data['p_id'])
                ->update();
            if ($isUpdated == '1') {
                $resp = [
                    'status' => true,
                    'message' => 'Stock Updated',
                    'data' => ['updatedStock' => $data['stock']]
                ];
            }
        } catch (\Exception $e) {
            $resp['message'] = $e;
        }
        return $resp;

    }


    private function discounts_all()
    {
        $resp = [
            'status' => false,
            'message' => 'no discounts found',
            'data' => []
        ];
        try {
            $DiscountsModel = new DiscountsModel();
            $discounts = $DiscountsModel->findAll();
            if (count($discounts) > 0) {
                $resp = [
                    'status' => true,
                    'message' => 'discounts found',
                    'data' => $discounts
                ];
            }
        } catch (\Exception $e) {
            $resp['message'] = $e;
        }
        return $resp;
    }

    private function discounts_add($data)
    {
        $resp = [
            'status' => false,
            'message' => 'Discount Dot Added',
            'data' => []
        ];

        try {
            $DiscountsModel = new DiscountsModel();
            $insert_data = [
                'uid' => $this->generate_uid(UID_DISCOUNTS),
                'name' => $data['title'],
                'minimum_purchase' => $data['minPurchase'],
                'discount_percentage' => $data['discount'],
                'status' => 'active'
            ];
            $isAdded = $DiscountsModel->insert($insert_data);
            if (!empty($isAdded)) {
                $resp = [
                    'status' => true,
                    'message' => 'Discounts Added',
                    'data' => ['discount_id' => $insert_data['uid']]
                ];
            }

        } catch (\Exception $e) {
            $resp['message'] = $e;
        }


        return $resp;
    }

    private function discounts_delete($data)
    {
        $resp = [
            'status' => false,
            'message' => 'Discount Not deleted',
            'data' => []
        ];

        try {
            $DiscountsModel = new DiscountsModel();
            $uid = $data['d_id'];

            $deleted = $DiscountsModel->where('uid', $uid)->delete();
            if ($deleted) {
                $resp['status'] = true;
                $resp['message'] = 'Discount deleted successfully';
            } else {
                $resp['message'] = 'No record found with the given UID';
            }

        } catch (\Exception $e) {
            $resp['message'] = $e->getMessage();
        }


        return $resp;
    }

    private function total_product()
    {
        $resp = [
            'status' => false,
            'message' => 'no product found',
            'data' => 0
        ];
        try {
            $ProductModel = new ProductModel();
            $totalProduct = $ProductModel->countAll();
            if (!empty($totalProduct)) {
                $resp = [
                    'status' => true,
                    'message' => 'Total product found',
                    'data' => $totalProduct
                ];
            }
        } catch (\Exception $e) {
            $resp['message'] = $e;
        }
        return $resp;
    }

    private function best_selling()
    {
        $resp = [
            'status' => false,
            'message' => 'Orders not found',
            'data' => []
        ];

        try {

            $OrderItemsModel = new OrderItemsModel();
            $product = $OrderItemsModel
                ->distinct()
                ->select('product_id')
                ->findAll();
            $all_product_qty = array();
            if (count($product) > 0) {
                $i = 0;
                foreach ($product as $index => $item) {
                    $i++;
                    $quantity = $OrderItemsModel
                        ->select('product_id, qty, order_id, uid')
                        ->where('product_id', $item)
                        ->findAll();
                    $total_qty = 0;
                    foreach ($quantity as $index => $qty) {
                        $total_qty = $total_qty + $qty['qty'];
                    }
                    $all_product_qty[$i]['total_qty'] = $total_qty;
                    $all_product_qty[$i]['product_id'] = $item['product_id'];

                }
                $totalQty = array();
                foreach ($all_product_qty as $key => $row) {
                    $totalQty[$key] = $row['total_qty'];
                }
                array_multisort($totalQty, SORT_DESC, $all_product_qty);


                foreach ($all_product_qty as $index => $product_qty) {
                    $product_data = $this->products(['p_id' => $product_qty['product_id']]);
                    $all_product_qty[$index]['product_data'] = $product_data['status'] == true ? $product_data['data'] : null;
                }

                $all_product_qty = json_decode(json_encode($all_product_qty), true);
                // $this->prd($all_product_qty);
            }


            if (count($all_product_qty) > 0) {
                $resp = [
                    'status' => true,
                    'message' => 'Orders found',
                    'data' => $all_product_qty
                ];
            }

        } catch (\Exception $e) {
            // Handle Any Error
            $resp['message'] = $e->getMessage();
        }



        return $resp;
    }

    private function product_img_delete($data)
    {
        $resp = [
            'status' => false,
            'message' => 'Discount Not deleted',
            'data' => []
        ];

        try {
            $ProductImagesModel = new ProductImagesModel();
            $img_id = $data['img_id'];

            $deleted = $ProductImagesModel->where('uid', $img_id)->delete();
            if ($deleted) {
                $resp['status'] = true;
                $resp['message'] = 'Product Image deleted successfully';
            } else {
                $resp['message'] = 'No record found with the given UID';
            }

        } catch (\Exception $e) {
            $resp['message'] = $e->getMessage();
        }


        return $resp;
    }




    private function delete_product($data)
    {
        $response = [
            'status' => false,
            'message' => 'Product deletion failed'
        ];

        try {
            // Extract product ID from data
            $product_id = $data['p_id'];

            // Instantiate ProductModel
            $ProductModel = new ProductModel();
            $ProductItemModel = new ProductItemModel();
            // Delete product using the product ID
            $deleted = $ProductModel->where('uid', $product_id)->delete();
            $deleted = $ProductItemModel->where('product_id', $product_id)->delete();
            // Check if deletion was successful
            if ($deleted) {
                $response['status'] = true;
                $response['message'] = 'Product successfully deleted';
            }
        } catch (\Exception $e) {
            // Handle any errors
            $response['message'] = $e->getMessage();
        }

        return $response;
    }

    private function best_selling_item()
    {
        $resp = [
            'status' => false,
            'message' => 'Orders not found',
            'data' => []
        ];

        $seller_id = $this->is_seller_logedin();

        try {
            
            $OrderItemsModel = new OrderItemsModel();
            $CommonModel = new CommonModel();
            $sql = "SELECT DISTINCT
                order_items.product_id
            FROM
                order_items
            JOIN
                product ON product.uid = order_items.product_id";

                if (!empty($seller_id)) {
                    $sql .= " WHERE 
                            product.vendor_id = '{$seller_id}'";
                }

            $product = json_decode(json_encode($CommonModel->customQuery($sql)), true);
            // $this->prd($product);
            $all_product_qty = array();
            if (count($product) > 0) {
                $i=0;
                foreach ($product as $index => $item) {
                    $i++;
                    $quantity = $OrderItemsModel
                            ->select('product_id, qty, order_id, uid')
                            ->where('product_id', $item)
                            ->findAll();
                    $total_qty = 0;
                    foreach ($quantity as $index => $qty) {
                        $total_qty = $total_qty + $qty['qty'];
                    }
                    $all_product_qty[$i]['total_qty'] = $total_qty;
                    $all_product_qty[$i]['product_id'] = $item['product_id'];
                    
                }
                $totalQty = array();
                foreach ($all_product_qty as $key => $row) {
                    $totalQty[$key] = $row['total_qty'];
                }
                array_multisort($totalQty, SORT_DESC, $all_product_qty);

                
                foreach($all_product_qty as $index => $product_qty){
                    $product_data = $this->products(['p_id'=> $product_qty['product_id']]);
                    $all_product_qty[$index]['product_data'] =  $product_data['status']  == true ? $product_data['data'] : null;
                }

                $all_product_qty = json_decode(json_encode($all_product_qty), true);
                // $this->prd($all_product_qty);
            }


            if (count($all_product_qty) > 0) {
                $resp = [
                    'status' => true,
                    'message' => 'Orders found',
                    'data' => $all_product_qty
                ];
            }

        } catch (\Exception $e) {
            // Handle Any Error
            $resp['message'] = $e->getMessage();
        }



        return $resp;
    }

    public function search_products($data)
    {
        $resp = [
            'status' => false,
            'message' => 'Product not Found',
            'data' => null
        ];

        $CommonModel = new CommonModel();

        $sql = "SELECT
            product.uid AS product_id,
            product.name AS name,
            product.description AS description,
            product.created_at AS created_at,
            categories.name AS category,
            categories.uid AS category_id,
            product_item.uid AS product_item_id,
            product_item.price AS base_price,
            product_item.sku AS product_stock,
            product_item.discount AS base_discount,
            product_item.product_tags AS tags,
            product_item.publish_date AS publish_date,
            product_item.status AS status,
            product_item.visibility AS visibility,
            product_item.manufacturer_brand AS manufacturer_brand,
            product_item.manufacturer_name AS manufacturer_name,
            product_meta_detalis.uid AS meta_id,
            product_meta_detalis.meta_title,
            product_meta_detalis.meta_description,
            product_meta_detalis.meta_keywords,
            users.user_name AS vendor,
            vendor.uid AS vendor_id
        FROM
            product
        JOIN
            product_item ON product.uid = product_item.product_id
        JOIN
            product_meta_detalis ON product.uid = product_meta_detalis.product_id
        JOIN 
            categories ON product.category_id = categories.uid
        JOIN
            vendor ON product.vendor_id = vendor.uid
        JOIN
            users ON vendor.user_id = users.uid";

        if (!empty($data['alph'])) {
            $alph = $data['alph'];
            $sql .= " WHERE
                product.name LIKE '%{$alph}%';";

        } else {
            $sql .= ";";
        }


        //$this->prd()

        $products = $CommonModel->customQuery($sql);

        if (count($products) > 0) {
            $ProductImagesModel = new ProductImagesModel();
            foreach ($products as $key => $product) {
                $products[$key]->product_img = $ProductImagesModel->where('product_id', $product->product_id)->findAll();
            }

            $resp["status"] = true;
            $resp["data"] = !empty($data['p_id']) ? $products[0] : $products;
            $resp["message"] = 'Products Found';
        }
        // $this->prd($resp);
        return $resp;
    }












    public function GET_delete_product()
    {
        $data = $this->request->getGet();

        $resp = $this->delete_product($data);
        return $this->response->setJSON($resp);
    }



    public function GET_discounts_delete()
    {
        $data = $this->request->getGet();

        $resp = $this->discounts_delete($data);
        return $this->response->setJSON($resp);
    }

    public function GET_product_img_delete()
    {
        $data = $this->request->getGet();

        $resp = $this->product_img_delete($data);
        return $this->response->setJSON($resp);
    }

    public function GET_product_config_stock_update()
    {
        $data = $this->request->getGet();

        $resp = $this->product_config_stock_update($data);
        return $this->response->setJSON($resp);
    }

    public function GET_product_stock_update()
    {
        $data = $this->request->getGet();

        $resp = $this->product_stock_update($data);
        return $this->response->setJSON($resp);
    }


    public function GET_user_id()
    {
        $resp = $this->user_id();
        return $this->response->setJSON($resp);
    }

    public function GET_product()
    {
        $data = $this->request->getGet();

        $resp = $this->products($data);
        return $this->response->setJSON($resp);
    }

    public function GET_search_products()
    {
        $data = $this->request->getGet();

        $resp = $this->search_products($data);
        return $this->response->setJSON($resp);
    }

    public function POST_add_product()
    {
        $data = $this->request->getPost();
        $resp = $this->add_product($data);
        return $this->response->setJSON($resp);

    }
    public function GET_variation_options()
    {
        $resp = $this->variation_options();
        return $this->response->setJSON($resp);

    }

    public function POST_update_product()
    {
        $data = $this->request->getPost();
        $resp = $this->update_product($data);
        return $this->response->setJSON($resp);
    }


    public function POST_add_new_variant()
    {
        $data = $this->request->getPost();
        $resp = $this->add_new_variant($data);
        return $this->response->setJSON($resp);
    }

    public function GET_variation()
    {
        $p_id = $this->request->getGet('p_id');
        $resp = $this->variation($p_id);
        return $this->response->setJSON($resp);
    }


    public function GET_discounts_all()
    {
        $resp = $this->discounts_all();
        return $this->response->setJSON($resp);
    }

    public function POST_discounts_add()
    {

        $data = $this->request->getPost();
        $resp = $this->discounts_add($data);
        return $this->response->setJSON($resp);

    }

    public function GET_total_product()
    {
        $resp = $this->total_product();
        return $this->response->setJSON($resp);
    }

    public function GET_best_selling()
    {
        $resp = $this->best_selling();
        return $this->response->setJSON($resp);
    }

    public function GET_best_selling_item()
    {
        $resp = $this->best_selling_item();
        return $this->response->setJSON($resp);
    }


}