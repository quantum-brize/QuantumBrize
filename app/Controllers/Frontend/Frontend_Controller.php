<?php

namespace App\Controllers\Frontend;

use App\Controllers\Main_Controller;
use App\Models\UsersModel;
use App\Models\OtpModel;

class Frontend_Controller extends Main_Controller
{


    public function __construct()
    {
        // Load session library
        $this->session = \Config\Services::session();
    }

    public function index(): void
    {
        $data = PAGE_DATA_FRONTEND;
            $data = [
                'data_page' => [],
                'data_header' => [
                    'header_link' => ['home_css.php'],
                    'title' => 'Home',
                    'header' => [],
                    'sidebar' => [],
                    'site' => 'frontend'
                ],
                'data_footer' => [
                    'footer_link' => ['home_js.php'],
                    'footer' => [],
                    'site' => 'frontend'
                ]
            ];
        $this->load_home_page('/frontend/home',  $data);
    }

    public function about_us(): void
    {
        $data = PAGE_DATA_FRONTEND;
        $data = [
            'data_page' => [],
            'data_header' => [
                'header_link' => [],
                'title' => 'About Us',
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
        $this->load_page('/frontend/about_us', $data);
    }

    public function blog_details(): void
    {
        $data = PAGE_DATA_FRONTEND;
        $data = [
            'data_page' => [],
            'data_header' => [
                'header_link' => [],
                'title' => 'Blog Details',
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
        $this->load_other_pages('/frontend/blog_details', $data);
    }

    public function blogs(): void
    {
        $data = PAGE_DATA_FRONTEND;
        $data = [
            'data_page' => [],
            'data_header' => [
                'header_link' => [],
                'title' => 'Blogs',
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
        $this->load_other_pages('/frontend/blogs', $data);
    }

    public function projects(): void
    {
        $data = PAGE_DATA_FRONTEND;
        $data = [
            'data_page' => [],
            'data_header' => [
                'header_link' => [],
                'title' => 'Projects',
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
        $this->load_other_pages('/frontend/projects', $data);
    }

    public function project_details(): void
    {
        $data = PAGE_DATA_FRONTEND;
        $data = [
            'data_page' => [],
            'data_header' => [
                'header_link' => [],
                'title' => 'Project Details',
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
        $this->load_other_pages('/frontend/project_details', $data);
    }

    public function service(): void
    {
        $data = PAGE_DATA_FRONTEND;
        $data = [
            'data_page' => [],
            'data_header' => [
                'header_link' => [],
                'title' => 'Service',
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
        $this->load_other_pages('/frontend/service', $data);
    }

    public function service_details(): void
    {
        $data = PAGE_DATA_FRONTEND;
        $data = [
            'data_page' => [],
            'data_header' => [
                'header_link' => [],
                'title' => 'Service Details',
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
        $this->load_other_pages('/frontend/service_details', $data);
    }

















    public function terms_conditions(): void
    {
        $data = PAGE_DATA_FRONTEND;
        $data = [
            'data_page' => [],
            'data_header' => [
                'header_link' => [],
                'title' => 'Terms of Conditions',
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
        $this->load_page('/frontend/terms_conditions', $data);
    }

    public function privacy_policy(): void
    {
        $data = PAGE_DATA_FRONTEND;
        $data = [
            'data_page' => [],
            'data_header' => [
                'header_link' => [],
                'title' => 'Privacy Policy',
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
        $this->load_page('/frontend/privacy_policy', $data);
    }

    public function faq(): void
    {
        $data = PAGE_DATA_FRONTEND;
        $data = [
            'data_page' => [],
            'data_header' => [
                'header_link' => [],
                'title' => 'FAQ',
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
        $this->load_other_pages('/frontend/faq', $data);
    }

    public function contact_us(): void
    {
        $data = PAGE_DATA_FRONTEND;
            $data = [
                'data_page' => [],
                'data_header' => [
                    'header_link' => [],
                    'title' => 'Contact Us',
                    'header' => [],
                    'sidebar' => [],
                    'site' => 'frontend'
                ],
                'data_footer' => [
                    'footer_link' => ['contact_us_js.php'],
                    'footer' => [],
                    'site' => 'frontend'
                ]
            ];
        $this->load_other_pages('/frontend/contact_us', $data);
    }

    public function team(): void
    {
        $data = PAGE_DATA_FRONTEND;
            $data = [
                'data_page' => [],
                'data_header' => [
                    'header_link' => [],
                    'title' => 'Team',
                    'header' => [],
                    'sidebar' => [],
                    'site' => 'frontend'
                ],
                'data_footer' => [
                    'footer_link' => ['contact_us_js.php'],
                    'footer' => [],
                    'site' => 'frontend'
                ]
            ];
        $this->load_other_pages('/frontend/team', $data);
    }

    /**USERS */
    public function account()
    {
        $user_id = $this->is_logedin();
        if(!empty($user_id)){
            $data = PAGE_DATA_FRONTEND;
            $data = [
                'data_page' => [],
                'data_header' => [
                    'header_link' => [],
                    'title' => 'Account',
                    'header' => [],
                    'sidebar' => [],
                    'site' => 'frontend'
                ],
                'data_footer' => [
                    'footer_link' => ['account_js.php'],
                    'footer' => [],
                    'site' => 'frontend'
                ]
            ];
            $this->load_page('/frontend/account', $data);
        }else{
            return redirect()->to('login');
        }
        
    }

    public function address(): void
    {
        $data = PAGE_DATA_FRONTEND;
        $data = [
            'data_page' => [],
            'data_header' => [
                'header_link' => [],
                'title' => 'Address',
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
        $this->load_page('/frontend/address', $data);
    }



    public function logout()
    {
        $session = \Config\Services::session();

        $session->remove(SES_USER_USER_ID);
        $session->remove(SES_USER_TYPE);
        return redirect()->to('login');
    }

    public function load_login()
    {
        echo view('frontend/login');
    }
    public function load_signup()
    {
        echo view('frontend/signup');
    }

    public function load_otp()
    {
        echo view('frontend/otp');
    }

    public function handle_signup()
    {
        $response = [
            "status" => false,
            "message" => "",
            "user_id" => ""
        ];

        $UsersModel = new UsersModel();
        $emailCondition = ['email' => $this->request->getPost('email'),'type' => 'user'];
        $numberCondition = ['number' => $this->request->getPost('number'), 'type' => 'user'];

        $recordEmail = $UsersModel->where($emailCondition)->first();
        $recordNumber = $UsersModel->where($numberCondition)->first();

        if ($recordEmail) {
            $response['message'] = 'Email All Ready Exists Try Diffrent';
        } else if ($recordNumber) {
            $response['message'] = 'Number All Ready Exists Try Diffrent';
        } else {
            $userData = [
                "uid" => $this->generate_uid(UID_USER),
                "user_name" => $this->request->getPost('user_name'),
                "email" => $this->request->getPost('email'),
                "number" => $this->request->getPost('number'),
                "password" => md5($this->request->getPost('password')),
                "status" => STATUS_PENDING,
                "type" => TYPE_USER
            ];
            $UsersModel->insert($userData);
            $OtpModel = new OtpModel();


            //$otp = $this->generate_otp();
            $otp = 1234;
            $otpData = [
                "uid" => $this->generate_uid(UID_OTP),
                "user_id" => $userData['uid'],
                "otp" => $otp
            ];
            $OtpModel->insert($otpData);

            $response['status'] = true;
            $response['message'] = 'OTP send to Your Email';
            $response['user_id'] = $userData['uid'];
        }
        echo json_encode($response);

    }

    public function handle_login()
    {
        $response = [
            "status" => false,
            "message" => "User Not Found",
            "user_id" => ""
        ];
        $email_number = $this->request->getPost('email_number');
        $password = $this->request->getPost('password');
        $UsersModel = new UsersModel();

        $UsersData = $UsersModel
            ->where('password', md5($password))
            ->where('type', 'user')
            ->where('status', 'active')
            ->groupStart()
            ->where('email', $email_number)
            ->orWhere('number', $email_number)
            ->groupEnd()
            ->get()
            ->getResultArray();
        $UsersData = !empty($UsersData[0]) ? $UsersData[0] : null;
        if (!empty($UsersData)) {
            // session_start();
            // $_SESSION['user_id'] = $UsersData['uid'];
            // $_SESSION['user_type'] = $UsersData['type'];

            // $session = \Config\Services::session();
            // $session->set(SES_USER_USER_ID, $UsersData['uid']);
            // $session->set(SES_USER_TYPE, $UsersData['type']);

            $this->session->set(SES_USER_USER_ID, $UsersData['uid']);
            $this->session->set(SES_USER_TYPE, $UsersData['type']);
            // $this->pr($this->session->get());
            $response = [
                "status" => true,
                "message" => "User Found",
                "user_id" => $UsersData['uid']
            ];
        }


        echo json_encode($response);
    }

    public function verify_otp()
    {
        $response = [
            "status" => false,
            "message" => "OTP NOT MATCHED",
            "user_id" => ""
        ];
        $OtpModel = new OtpModel();
        $OtpModel->where('user_id', $this->request->getPost('user_id'));
        $latestOtp = $OtpModel->orderBy('created_at', 'DESC')->first();
        if ($latestOtp['otp'] == $this->request->getPost('otp')) {
            $usersModel = new UsersModel();
            $usersModel->setUserActive($latestOtp['user_id'], ['status' => 'active']);
            $response = [
                "status" => true,
                "message" => "OTP MATCHED",
                "user_id" => $this->request->getPost('user_id')
            ];
        }
        echo json_encode($response);

    }

    public function signup_success()
    {
        echo view('frontend/signup_success');
    }

    public function load_forgot_password()
    {
        echo view('frontend/forgot_password');
    }

    public function send_otp()
    {
        $response = [
            "status" => false,
            "message" => "Invalid Email",
            "user_id" => ""
        ];
        $email = $this->request->getPost('email');
        $UsersModel = new UsersModel();
        $recordEmail = $UsersModel->where(['email' => $email])->get()->getResultArray();
        if (!empty($recordEmail)) {
            $OtpModel = new OtpModel();
            //$otp = $this->generate_otp();
            $otp = 1234;
            $otpData = [
                "uid" => $this->generate_uid(UID_OTP),
                "user_id" => $recordEmail[0]['uid'],
                "otp" => $otp
            ];
            $OtpModel->insert($otpData);
            $response = [
                "status" => true,
                "message" => "OTP Sent To Your email",
                "user_id" => $recordEmail[0]['uid']
            ];
        }

        echo json_encode($response);
    }

    public function change_password()
    {
        echo view('frontend/change_password');
    }
    public function handle_change_password(){
        $response = [
            "status" => false,
            "message" => "password not changed",
        ];
        $user_id  = $this->request->getPost('user_id');
        $password = md5($this->request->getPost('password'));

        $UsersModel = new UsersModel();
        $change = $UsersModel->set('password', $password)          
                            ->where('uid', $user_id) 
                            ->update();
        $response['status']  = $change == '1';
        $response['message'] = $response['status'] ? "Password Changed Seccessfully" : "Password Not Changed";

        echo json_encode($response);

    }
}
