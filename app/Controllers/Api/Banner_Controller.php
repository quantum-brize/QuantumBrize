<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\BannersModel;
use App\Models\PromotionCardModel;

class Banner_Controller extends Api_Controller
{
    private function add_banner($data)
    {
        $resp = [
            'status' => false,
            'message' => 'Product not added',
            'data' => null
        ];

        $uploadedFiles = $this->request->getFiles();
        if (empty ($uploadedFiles['images'])) {
            $resp['message'] = 'Your Banner Has No Image';
        } else if (empty ($data['bannerLink'])) {
            $resp['message'] = 'Please Add A Link';
        }else {


            $banner_data = [
                'uid' => $this->generate_uid(UID_BANNER),
                'title' => $data['bannerTitle'],
                'description' => $data['bannerDescription'],
                'link' => $data['bannerLink'],
            ];
            
            
            foreach ($uploadedFiles['images'] as $file) {
                $file_src = $this->single_upload($file, PATH_BANNER_IMG);
                $banner_data['img'] = $file_src;
            }
            $BannerModel = new BannersModel();


            // Transaction Start
            $BannerModel->transStart();
            try {
                $BannerModel->insert($banner_data);
                // Commit the transaction if all queries are successful
                $BannerModel->transCommit();
            } catch (\Exception $e) {
                // Rollback the transaction if an error occurs
                $BannerModel->transRollback();
                $resp['message'] = $e->getMessage();
            }

            $resp['status'] = true;
            $resp['message'] = 'Banner added';
            $resp['data'] = ['banner_id' => $banner_data['uid']];
        }
        return $resp;
    }

    private function banners()
    {

        $resp = [
            "status" => false,
            "message" => "Data Not Found",
            "data" => ""
        ];
        
        $BannerModel = new BannersModel();
        $BanneData = $BannerModel
        ->get()
        ->getResultArray();
        $BanneData = !empty($BanneData) ? $BanneData : null;

        $resp = [
            "status" => true,
            "message" => "Data fetched",
            "data" => $BanneData,
        ];
        return $resp; 
    }

    private function delete_banner($data)
    {

        $resp = [
            "status" => false,
            "message" => "Data delete failed",
            "data" => ""
        ];
        $BannerModel = new BannersModel();
        $delete_data = $BannerModel->where('uid', $data['banner_id'])->delete();
        if($delete_data){
            $resp = [
                "status" => true,
                "message" => "Data deleted",
                "data" => "",
            ];
        }
        return $resp;

    }

    private function update_banner($data)
    {
        // $this->prd($data['banner_id']);
        $resp = [
            "status" => false,
            "message" => "Banner Not Found!",
            "data" => $data
        ];
        $BannerModel = new BannersModel();
        try {

            // Selecting the cart with the specified User
            $banner = $BannerModel->where('uid', $data['banner_id'])->first();

            if ($banner) {
                // Cart exists
                $resp['status'] = true;
                $resp['message'] = 'Banner Found';
                $resp['data'] = $banner;
            }
        } catch (\Exception $e) {
            $resp['message'] = $e->getMessage();
        }
        return $resp;

    }

    private function banner_update($data)
    {
        $resp = [
            'status' => false,
            'message' => 'Banner not updated',
            'data' => null
        ];
        
        if (empty ($data['bannerLink'])) {
            $resp['message'] = 'Please Add A Link';
        }else {


            $banner_data = [
                'title' => $data['bannerTitle'],
                'description' => $data['bannerDescription'],
                'link' => $data['bannerLink'],
            ];
            
            $uploadedFiles = $this->request->getFiles();
            if(isset($uploadedFiles['images'])){
                foreach ($uploadedFiles['images'] as $file) {
                    $file_src = $this->single_upload($file, PATH_BANNER_IMG);
                    $banner_data['img'] = $file_src;
                }
            }
            
            $BannerModel = new BannersModel();


            // Transaction Start
            $BannerModel->transStart();
            try {
                $BannerModel
                        ->where('uid', $data['banner_id'])
                        ->set($banner_data)
                        ->update();
                $BannerModel->transCommit();
            } catch (\Exception $e) {
                // Rollback the transaction if an error occurs
                $BannerModel->transRollback();
                $resp['message'] = $e->getMessage();
            }

            $resp['status'] = true;
            $resp['message'] = 'Banner Updated';
            $resp['data'] = "";
        }
        return $resp;
    }

    private function update_promotion_card($data)
    {
        // $this->prd($data['banner_id']);
        $resp = [
            "status" => false,
            "message" => "Banner Not Found!",
            "data" => $data
        ];
        $PromotionCardModel = new PromotionCardModel();
        try {

            // Selecting the cart with the specified User
            $card = $PromotionCardModel->first();

            if ($card) {
                // Cart exists
                $resp['status'] = true;
                $resp['message'] = 'Promotion Card Found';
                $resp['data'] = $card;
            }
        } catch (\Exception $e) {
            $resp['message'] = $e->getMessage();
        }
        return $resp;

    }

    private function promotion_card_update($data)
    {
        $resp = [
            'status' => false,
            'message' => 'Banner not updated',
            'data' => null
        ];
        
        
        if (empty ($data['link1'])) {
            $resp['message'] = 'Your Card 1 Has Link';
        } else if (empty ($data['link2'])) {
            $resp['message'] = 'Your Card 2 Has Link';
        } else {


            $card_data = [
                'link1' => $data['link1'],
                'link2' => $data['link2'],
            ];
            
            $uploadedFiles = $this->request->getFiles();
            if(isset($uploadedFiles['images1'])){
                foreach ($uploadedFiles['images1'] as $file) {
                    $file_src = $this->single_upload($file, PATH_PROMOTION_CARD_IMG);
                    $card_data['img1'] = $file_src;
                }
            }
            if(isset($uploadedFiles['images2'])){
                foreach ($uploadedFiles['images2'] as $file) {
                    $file_src = $this->single_upload($file, PATH_PROMOTION_CARD_IMG);
                    $card_data['img2'] = $file_src;
                }
            }

            // $this->prd($card_data);
            
            $PromotionCardModel = new PromotionCardModel();


            // Transaction Start
            $PromotionCardModel->transStart();
            try {
                $PromotionCardModel
                        ->where('uid', $data['card_id'])
                        ->set($card_data)
                        ->update();
                $PromotionCardModel->transCommit();
            } catch (\Exception $e) {
                // Rollback the transaction if an error occurs
                $PromotionCardModel->transRollback();
                $resp['message'] = $e->getMessage();
            }

            $resp['status'] = true;
            $resp['message'] = 'Card Updated';
            $resp['data'] = "";
        }
        return $resp;
    }

    public function POST_add_banner()
    {
        $data = $this->request->getPost();
        $resp = $this->add_banner($data);
        return $this->response->setJSON($resp);

    }

    public function GET_banners()
    {
        $data = $this->request->getPost();
        $resp = $this->banners($data);
        return $this->response->setJSON($resp);

    }

    public function GET_delete_banner()
    {
        $data = $this->request->getGet();
        $resp = $this->delete_banner($data);
        return $this->response->setJSON($resp);

    }

    public function GET_update_banner()
    {
        $data = $this->request->getGet();
        $resp = $this->update_banner($data);
        return $this->response->setJSON($resp);

    }

    public function POST_banner_update()
    {
        $data = $this->request->getPost();
        $resp = $this->banner_update($data);
        return $this->response->setJSON($resp);

    }

    public function POST_update_promotion_card()
    {
        $data = $this->request->getGet();
        $resp = $this->update_promotion_card($data);
        return $this->response->setJSON($resp);

    }

    public function POST_promotion_card_update()
    {
        $data = $this->request->getPost();
        $resp = $this->promotion_card_update($data);
        return $this->response->setJSON($resp);

    }
}
