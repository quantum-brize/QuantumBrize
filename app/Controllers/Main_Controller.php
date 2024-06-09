<?php

namespace App\Controllers;

class Main_Controller extends BaseController
{
	public function __construct()
	{
		// Load session library
		$this->session = \Config\Services::session();
	}

	public function load_home_page($page, $data): void
	{
		$this->load_headers($data['data_header']);
		echo view($page, $data['data_page']);
		$this->load_footers($data['data_footer']);
	}

	public function load_other_pages($page, $data): void
	{
		$this->load_headers_main($data['data_header']);
		echo view($page, $data['data_page']);
		$this->load_footers($data['data_footer']);
	}

	// This header for home page
	private function load_headers($data): void
	{
		echo view('/' . $data['site'] . '/inc/header_link.php', $data);
		echo view('/' . $data['site'] . '/inc/header.php', $data);
		echo view('/' . $data['site'] . '/inc/sidebar.php', $data);
	}

	// This header or other pages
	private function load_headers_main($data): void
	{
		echo view('/' . $data['site'] . '/inc/header_link.php', $data);
		echo view('/' . $data['site'] . '/inc/header_main.php', $data);
		echo view('/' . $data['site'] . '/inc/sidebar.php', $data);
	}

	private function load_footers($data): void
	{
		echo view('/' . $data['site'] . '/inc/footer.php');
		echo view('/' . $data['site'] . '/inc/footer_link.php', $data);
	}

	public function index(): void
	{
		echo ENVIRONMENT;
	}
	public function prd($data): void
	{
		echo '<pre>';
		print_r($data);
		echo '</pre>';
		die();
	}
	public function pr($data): void
	{
		echo '<pre>';
		print_r($data);
		echo '</pre>';
	}
	private function uid()
	{
		return strtoupper(bin2hex(openssl_random_pseudo_bytes(4)));
	}

	public function generate_uid($purpose)
	{
		return $purpose . $this->uid() . date('Ymd');
	}

	public function generate_otp()
	{
		return rand(1000, 9999);
	}

	public function is_logedin()
	{
		$userID = $this->session->get(SES_USER_USER_ID);
		return $userID;
	}

	public function is_seller_logedin()
	{
		$sellerID = $this->session->get(SES_SELLER_ID);
		return $sellerID;
	}

	function calculateDiscount($basePrice, $discountPercentage)
	{
		// Ensure the base price and discount percentage are numeric
		if (!is_numeric($basePrice) || !is_numeric($discountPercentage)) {
			return "Invalid input. Please provide numeric values.";
		}

		// Calculate the discount amount
		$discountAmount = $basePrice * ($discountPercentage / 100);

		// Return the discount amount
		return $discountAmount;
	}



	public function single_upload($file, $path)
	{
		if ($file->isValid() && !$file->hasMoved()) {
			try {
				$newName = $file->getRandomName();
				$file->move($path, $newName);
				// Log successful upload
				$this->log('File uploaded successfully: ' . $newName);
				return $newName;
			} catch (\Exception $e) {
				// Log upload error
				$this->log('Error uploading file: ' . $e->getMessage());
				return $e->getMessage();
			}
		} else {
			// Log invalid file or already moved file
			$this->log('Invalid file or file already moved');
			return null;
		}
	}
	private function log($message)
	{
		// You can implement your logging mechanism here, such as writing to a file or database
		error_log($message);
	}
}
