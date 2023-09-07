<?php

defined('BASEPATH') or exit('No direct script access allowed');

class AdminHome extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (sessionId('admin_id') == "") {
			redirect("admin");
		}
		date_default_timezone_set("Asia/Kolkata");
	}

	public function dashboard()
	{
		$getRows['active_user'] = $this->CommonModel->getNumRows("user_registration", "user_status = '1'");
		$getRows['inactive_user'] = $this->CommonModel->getNumRows("user_registration", "user_status = '0'");
		$getRows['product_category'] = $this->CommonModel->getNumRows("category", "is_delete = '1'");
		$getRows['product_sub_category'] = $this->CommonModel->getNumRows("sub_category", "is_delete = '1'");
		$getRows['total_product'] = $this->CommonModel->getNumRows("product", "is_delete = '1'");
		$getRows['recent_orders'] = $this->CommonModel->getNumRows("book_product", "booking_status = '0' AND (payment_mode = '1' OR payment_mode = '2' AND transaction_status = '1')");
		$getRows['accepted_orders'] = $this->CommonModel->getNumRows("book_product", "booking_status = '1' AND (payment_mode = '1' OR payment_mode = '2' AND transaction_status = '1')");
		$getRows['dispatch_orders'] = $this->CommonModel->getNumRows("book_product", "booking_status = '3' AND (payment_mode = '1' OR payment_mode = '2' AND transaction_status = '1')");
		$getRows['completed_orders'] = $this->CommonModel->getNumRows("book_product", "booking_status = '4' AND (payment_mode = '1' OR payment_mode = '2' AND transaction_status = '1')");
		$getRows['canceled_orders'] = $this->CommonModel->getNumRows("book_product", "booking_status = '2' AND (payment_mode = '1' OR payment_mode = '2' AND transaction_status = '1')");
		$getRows['title'] = "Home";
		$this->load->view('admin/index', $getRows);
	}

	public function banner()
	{
		extract($this->input->get());
		$id = $this->input->get('bID');
		$BdID = $this->input->get('BdID');
		$sId = decryptId($id);
		$get = $this->CommonModel->getSingleRowById('banner', "banner_id = '$sId'");
		$data['image_path'] = set_value('image_path') == false ? @$get['image_path'] : set_value('image_path');
		$data['all_banner'] = $this->CommonModel->getAllRowsInOrder('banner', 'create_date', 'DESC');

		if (decryptId($BdID) != '') {
			$delete = $this->CommonModel->deleteRowById('banner', array('banner_id' => decryptId($BdID)));
			unlink('upload/banner/' . $img);
			redirect('banner');
			exit;
		}

		if (isset($id)) {
			$data['title'] = 'Banner Edit';
		} else {
			$data['title'] = 'Banner add';
		}
		if (count($_POST) > 0) {

			if (!empty($_FILES['image_path']['name'])) {
				$p = fullImage('image_path', BANNER_IMAGE, $data['image_path']);
				$post['image_path'] = $p;
			}

			if (isset($id)) {
				$post['update_date'] = setDateTime();
				$update = $this->CommonModel->updateRowById('banner', 'banner_id', $sId, $post);
				flashData('errors', 'Banner Update Successfully');
			} else {
				$post['create_date'] = setDateTime();
				$insert = $this->CommonModel->insertRow('banner', $post);
				flashData('errors', 'Banner Add successfully.');
			}
			redirect('banner');
		}
		$this->load->view('admin/banner', $data);
	}

	public function promoCode()
	{
		$id = $this->input->get('promo');
		$dID = $this->input->get('dID');
		$sId = decryptId($id);
		$getPlans = getRowById('promocode', 'promocode_id', $sId);
		$data['promocode'] = set_value('promocode') == false ? @$getPlans[0]['promocode'] : set_value('promocode');
		$data['expiry_date'] = set_value('expiry_date') == false ? @$getPlans[0]['expiry_date'] : set_value('expiry_date');
		$data['minimum_order'] = set_value('minimum_order') == false ? @$getPlans[0]['minimum_order'] : set_value('minimum_order');
		$data['amount'] = set_value('amount') == false ? @$getPlans[0]['amount'] : set_value('amount');

		if (decryptId($dID) != '') {
			$delete = $this->CommonModel->deleteRowById('promocode', array('promocode_id' => decryptId($dID)));
		}

		if (isset($id)) {
			$data['title'] = 'Promo code Edit';
		} else {
			$data['title'] = 'Promo code add';
		}
		if (count($_POST) > 0) {
			extract($this->input->post());
			$post['promocode'] = strtoupper($promocode);
			$post['amount'] = $amount;
			$post['minimum_order'] = $minimum_order;
			$post['expiry_date'] = date('Y-m-d', strtotime($expiry_date));
			if (isset($id)) {
				$post['update_date'] = setDateTime();
				$update = updateRowById('promocode', 'promocode_id', $sId, $post);
				if ($update) {
					flashData('errors', 'Promo code Update Successfully');
				} else {
					flashData('errors', 'Promo code Not Update. please try again');
				}
			} else {
				$post['create_date'] = setDateTime();
				$insert = insertRow('promocode', $post);
				if ($insert) {
					flashData('errors', 'Promo code Add Successfully');
				} else {
					flashData('errors', 'Promo code Not Add');
				}
			}
			redirect('promoCode');
		} else {
			$data['title'] = 'Promo Code';
			$this->load->view('admin/user_promo_code', $data);
		}
	}

	public function setDeliveryCharges()
	{
		extract($this->input->post());
		$get = $this->CommonModel->getSingleRowById('delivery_charge', "delivery_charge_id = '1'");
		$data['min_amount'] = set_value('min_amount') == false ? @$get['min_amount'] : set_value('min_amount');
		$data['amount'] = set_value('amount') == false ? @$get['amount'] : set_value('amount');

		$data['title'] = 'Delivery Charge';
		if (count($_POST) > 0) {
			$this->form_validation->set_rules('min_amount', 'minimum amount', 'trim|required');
			$this->form_validation->set_rules('amount', 'amount', 'trim|required');
			if ($this->form_validation->run()) {
				$getC = $this->CommonModel->getAllRows('delivery_charge');
				$post['min_amount'] = $min_amount;
				$post['amount'] = $amount;
				if ($getC > 0) {
					$updateRow = updateRowById('delivery_charge', 'delivery_charge_id', '1', $post);
					if ($updateRow) {
						flashData('errors', 'Delivery Charges Update Successfully');
					} else {
						flashData('errors', 'Delivery Charges Not Add.');
					}
				} else {
					$insert = $this->CommonModel->insertRow('delivery_charge', $post);
					if ($insert) {
						flashData('errors', 'Delivery Charges Add Successfully');
					} else {
						flashData('errors', 'Delivery Charges Not Add.');
					}
				}
				redirect('setDeliveryCharges');
			}
		}
		$this->load->view('admin/delivery_charges', $data);
	}

	public function activeUser()
	{
		$data['title'] = "All Active Users";
		$data['all_data'] = $this->CommonModel->getRowByIdInOrder('user_registration', "verify_status = '1' AND user_status = '1'", 'create_date', 'desc');
		$data['is_register'] = 0;
		$this->load->view('admin/users/user_all', $data);
	}

	public function inactiveUser()
	{
		$data['title'] = "All Inactive Users";
		$data['all_data'] = $this->CommonModel->getRowByIdInOrder('user_registration', "verify_status = '1' AND user_status = '0'", 'create_date', 'desc');
		$data['is_register'] = 0;
		$this->load->view('admin/users/user_all', $data);
	}

	public function userStatus($user_id, $status)
	{
		if ($status == 1) {
			$post = array('user_status' => '0');
			$msg = 'User inactive successfully';
		} else {
			$post = array('user_status' => '1');
			$msg = 'User active successfully';
		}
		$update = $this->CommonModel->updateRowById('user_registration', 'user_id', decryptId($user_id), $post);
		if ($update) {
			flashData('errors', $msg);
		} else {
			flashData('errors', 'Something went wrong. Please try again');
		}
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function userDetails($id)
	{
		$data['title'] = "User Details";
		$data['all_data'] = $this->CommonModel->getSingleRowById('user_registration', "user_id = '" . decryptId($id) . "'");
		$this->load->view('admin/users/user_details', $data);
	}

	// Order 

	public function recentOrders()
	{
		$data['title'] = 'Recent Orders';
		$data['allOrders'] = $this->CommonModel->getRowByIdInOrder('book_product', "booking_status = '0' AND (payment_mode = '1' OR payment_mode = '2' AND transaction_status = '1')", 'create_date', 'DESC');
		$this->load->view('admin/orders', $data);
	}

	public function acceptOrder()
	{
		$estimated_time = $this->input->post('estimated_time');
		$estimated_date = $this->input->post('estimated_date');
		$id = $this->input->post('id');
		if ($estimated_time != '' and $id != '') {
			$update = $this->CommonModel->updateRowById('book_product', 'product_book_id', decryptId($id), array('booking_status' => '1', 'estimated_time' => $estimated_date . ' ' . date('h:i A', strtotime($estimated_time))));
			flashData('errors', 'Order accept successfully');
		} else {
			flashData('errors', 'Something went wrong.');
		}
		redirect('recentOrders');
	}

	public function cancelOrder()
	{
		$cancel_msg = $this->input->post('cancel_msg');
		$id = $this->input->post('id');
		if ($cancel_msg != '' and $id != '') {
			$update = $this->CommonModel->updateRowById('book_product', 'product_book_id', decryptId($id), array('booking_status' => '2', 'cancel_message' => $cancel_msg));
			flashData('errors', 'Order Cancel successfully');
		} else {
			flashData('errors', 'Something went wrong.');
		}
		redirect('recentOrders');
	}

	public function acceptedOrders()
	{
		$data['allOrders'] = $this->CommonModel->getRowByIdInOrder('book_product', "booking_status = '1' AND (payment_mode = '1' OR payment_mode = '2' AND transaction_status = '1')", 'create_date', 'DESC');
		$data['title'] = 'All Accepted Orders';
		$this->load->view('admin/orders', $data);
	}

	public function dispatchOrder($id, $type)
	{
		if ($type == '3') {
			$post['booking_status'] = '3';
			$message = "Order Dispatch successfully";
		} else {
			$post['booking_status'] = '4';
			$post['order_complete_date'] = setDateTime();
			$message = "Order Complete successfully";
		}
		$update = $this->CommonModel->updateRowById('book_product', 'product_book_id', decryptId($id), $post);
		flashData('errors', $message);
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function dispatchOrders()
	{
		$data['allOrders'] = $this->CommonModel->getRowByIdInOrder('book_product', "booking_status = '3' AND (payment_mode = '1' OR payment_mode = '2' AND transaction_status = '1')", 'create_date', 'DESC');
		$data['title'] = 'All Dispatch Orders';
		$this->load->view('admin/orders', $data);
	}

	public function completedOrders()
	{
		$data['allOrders'] = $this->CommonModel->getRowByIdInOrder('book_product', "booking_status = '4' AND (payment_mode = '1' OR payment_mode = '2' AND transaction_status = '1')", 'create_date', 'DESC');
		$data['title'] = 'All Completed Orders';
		$this->load->view('admin/orders', $data);
	}

	public function cancelOrders()
	{
		$data['allOrders'] = $this->CommonModel->getRowByIdInOrder('book_product', "booking_status = '2' AND (payment_mode = '1' OR payment_mode = '2')", 'create_date', 'DESC');
		$data['title'] = 'All Cancel Orders';
		$this->load->view('admin/orders', $data);
	}

	public function allOrders()
	{
		$date = $this->input->get('date');
		if ($date != "") {
			$data['allOrders'] = $this->CommonModel->getRowByIdInOrder('book_product', "booking_date = '" . date('Y-m-d', strtotime($date)) . "'", 'create_date', 'DESC');
		} else {
			$data['allOrders'] = false;
		}
		$data['title'] = 'All Orders';
		$this->load->view('admin/all_orders', $data);
	}
}
