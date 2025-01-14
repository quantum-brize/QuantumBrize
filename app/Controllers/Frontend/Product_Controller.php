<?php

namespace App\Controllers\Frontend;

use App\Controllers\Main_Controller;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UsersModel;
use App\Models\OtpModel;

class Product_Controller extends Main_Controller
{
    public function product_list(): void
    {
        $data = PAGE_DATA_FRONTEND;
        $data = [
            'data_page' => [],
            'data_header' => [
                'header_link' => [],
                'title' => 'Product List',
                'header' => [],
                'sidebar' => [],
                'site' => 'frontend'
            ],
            'data_footer' => [
                'footer_link' => ['product_list_js.php'],
                'footer' => [],
                'site' => 'frontend'
            ]
        ];
        $this->load_page('/frontend/product_list', $data);
    }

    public function product_details(): void
    {
        $data = PAGE_DATA_FRONTEND;
        $data = [
            'data_page' => [],
            'data_header' => [
                'header_link' => ['product_details_css.php'],
                'title' => 'Product Details',
                'header' => [],
                'sidebar' => [],
                'site' => 'frontend'
            ],
            'data_footer' => [
                'footer_link' => ['product_details_js.php'],
                'footer' => [],
                'site' => 'frontend'
            ]
        ];
        $this->load_page('/frontend/product_details', $data);
    }

    public function product_category(): void
    {
        $data = PAGE_DATA_FRONTEND;
        $data = [
            'data_page' => [],
            'data_header' => [
                'header_link' => [],
                'title' => 'Category',
                'header' => [],
                'sidebar' => [],
                'site' => 'frontend'
            ],
            'data_footer' => [
                'footer_link' => [],
                'footer' => [],
                'site' => 'frontend'
            ]
        ];
        $this->load_page('/frontend/products_category', $data);
    }

    public function review(): void
    {
        $data = PAGE_DATA_FRONTEND;
        $data = [
            'data_page' => [],
            'data_header' => [
                'header_link' => [],
                'title' => 'Review',
                'header' => [],
                'sidebar' => [],
                'site' => 'frontend'
            ],
            'data_footer' => [
                'footer_link' => [],
                'footer' => [],
                'site' => 'frontend'
            ]
        ];
        $this->load_page('/frontend/review', $data);
    }

    public function cart(): void
    {
        $data = PAGE_DATA_FRONTEND;
        $data = [
            'data_page' => [],
            'data_header' => [
                'header_link' => [],
                'title' => 'Cart',
                'header' => [],
                'sidebar' => [],
                'site' => 'frontend'
            ],
            'data_footer' => [
                'footer_link' => [],
                'footer' => [],
                'site' => 'frontend'
            ]
        ];
        $this->load_page('/frontend/cart', $data);
    }

    public function wishlist(): void
    {
        $data = PAGE_DATA_FRONTEND;
        $data = [
            'data_page' => [],
            'data_header' => [
                'header_link' => [],
                'title' => 'Wishlist',
                'header' => [],
                'sidebar' => [],
                'site' => 'frontend'
            ],
            'data_footer' => [
                'footer_link' => [],
                'footer' => [],
                'site' => 'frontend'
            ]
        ];
        $this->load_page('/frontend/wishlist', $data);
    }

    public function cart_checkout(): void
    {   
        $data = PAGE_DATA_FRONTEND;
        $data = [
            'data_page' => [],
            'data_header' => [
                'header_link' => ['cart_checkout_css.php'],
                'title' => 'Checkout',
                'header' => [],
                'sidebar' => [],
                'site' => 'frontend'
            ],
            'data_footer' => [
                'footer_link' => ['cart_checkout_js.php'],
                'footer' => [],
                'site' => 'frontend'
            ]
        ];
        $this->load_page('/frontend/cart_checkout', $data);
    }


}
