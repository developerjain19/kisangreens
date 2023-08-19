<?php

defined('BASEPATH') or exit('No direct script access allowed');

class AdminProduct extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (sessionId('admin_id') == "") {
			redirect("admin");
		}
		date_default_timezone_set("Asia/Kolkata");
	}

	//   category

	public function categoryAll()
	{
		$get['category_all'] = $this->CommonModel->getRowByIdInOrder('category', "is_delete = '1'", 'category_name', 'ASC');
		$get['title'] = 'All Category';
		$this->load->view('admin/product/category_all', $get);
	}

	public function categoryAdd()
	{
		extract($this->input->post());
		$id = $this->input->get('id');
		$dID = $this->input->get('dID');
		$decrypt_id = decryptId($this->input->get('id'));
		$get = $this->CommonModel->getSingleRowById('category', "category_id = '$decrypt_id'");
		$data['category_name'] = set_value('category_name') == false ? @$get['category_name'] : set_value('category_name');
		$data['image'] = set_value('image') == false ? @$get['image'] : set_value('image');
		if (isset($id)) {
			$data['title'] = 'Edit Category';
		} else {
			$data['title'] = 'Add Category';
		}

		if (isset($dID)) {
			$update = $this->CommonModel->updateRowById('category', 'category_id', decryptId($dID), array('is_delete' => '0'));
			redirect('categoryAll');
			exit;
		}

		if (count($_POST) > 0) {
			$this->form_validation->set_rules('category_name', 'category name', 'required');
			if ($this->form_validation->run()) {
				$post['category_name'] = trim($category_name);

				if (!empty($_FILES['image']['name'])) {
					$picture = imageUploadWithRatio('image', CATEGORY_IMAGE, 600, 400, $data['image']);
					$post['image'] = $picture;
				}
				if (isset($id)) {
					$update = $this->CommonModel->updateRowById('category', 'category_id', $decrypt_id, $post);
					flashData('errors', 'Category Update Successfully');
				} else {
					$insert = $this->CommonModel->insertRow('category', $post);
					flashData('errors', 'Category Add Successfully');
				}
				redirect('categoryAll');
			}
		}
		$this->load->view('admin/product/category_add', $data);
	}

	//   sub category

	public function subCategoryAll()
	{
		$data['sub_category'] = $this->CommonModel->getRowByIdInOrder('sub_category', "is_delete = '1'", 'sub_category_name', 'ASC');
		$data['title'] = "All Sub Category";
		$this->load->view('admin/product/sub_category_all', $data);
	}

	public function subCategoryAdd()
	{
		$dID = $this->input->get('dID');
		$id = $this->input->get('id');
		extract($this->input->post());
		$decrypt_id = decryptId($this->input->get('id'));

		$get = $this->CommonModel->getSingleRowById('tbl_sub_category', "sub_category_id = '$decrypt_id'");
		$data['sub_category_name'] = set_value('sub_category_name') == false ? @$get['sub_category_name'] : set_value('sub_category_name');
		$data['category_id'] = set_value('category_id') == false ? @$get['category_id'] : set_value('category_id');
		$data['sub_category_image'] = set_value('category_image2') == false ? @$get['sub_category_image'] : set_value('category_image2');
		if (isset($id)) {
			$data['title'] = 'Edit Sub Category';
		} else {
			$data['title'] = 'Add Sub Category';
		}

		if (isset($dID)) {
			$update = $this->CommonModel->updateRowById('sub_category', 'sub_category_id', decryptId($dID), array('is_delete' => '0'));
			redirect('subCategoryAll');
			exit;
		}

		if (count($_POST) > 0) {
			$this->form_validation->set_rules('sub_category_name', 'sub category name', 'trim|required');
			$this->form_validation->set_rules('category_id', 'category', 'required');
			if ($this->form_validation->run()) {

				$post['sub_category_name'] = $sub_category_name;
				$post['category_id'] = $category_id;

				if (!empty($_FILES['sub_category_image']['name'])) {
					$picture = imageUploadWithRatio('sub_category_image', CATEGORY_IMAGE, 600, 400, $data['sub_category_image']);
					$post['sub_category_image'] = $picture;
				}

				if (isset($id)) {
					$update = $this->CommonModel->updateRowById('tbl_sub_category', 'sub_category_id', $decrypt_id, $post);
					flashData('errors', 'Sub Category Update Successfully');
				} else {
					$insert = $this->CommonModel->insertRow('tbl_sub_category', $post);
					flashData('errors', 'Sub Category Add Successfully');
				}
				redirect('subCategoryAll');
			}
		}
		$this->load->view('admin/product/sub_category_add', $data);
	}

	//  Product

	public function productAll()
	{
		$subCategoryId = $this->input->get('sCateId');

		$select = "product.*, category.category_name, sub_category.sub_category_name";
		$join = [
			['category', 'category.category_id = product.category_id', 'LEFT'],
			['sub_category', 'sub_category.sub_category_id = product.sub_category_id', 'LEFT'],
		];
		if (isset($subCategoryId)) {
			$get['all_product'] = $this->CommonModel->getRowWithMultiJoin($select, 'product',  "product.is_delete = '1' AND product.sub_category_id = '" . decryptId($subCategoryId) . "'", $join, 'product_name', 'ASC', 1);
		} else {
			$get['all_product'] = $this->CommonModel->getRowWithMultiJoin($select, 'product', "product.is_delete = '1'", $join, 'product_name', 'ASC', 1);
		}
		$get['title'] = 'All Product';
		$this->load->view('admin/product/product_all', $get);
	}

	function getSubCategory()
	{
		$category_id = $this->input->post('category_id');
		$data['type'] = 1;
		$data['all_data'] = $this->CommonModel->getRowByIdInOrder('tbl_sub_category', "category_id = '$category_id' AND is_delete = '1'", 'sub_category_name', 'ASC');
		$this->load->view('admin/product/sub_category_list', $data);
	}

	function getProductSubCategory()
	{
		$category_id = $this->input->post('category_id');
		$data['all_data'] = $this->CommonModel->getRowByIdInOrder('tbl_sub_category', "category_id = '$category_id' AND is_delete = '1'", 'sub_category_name', 'ASC');
		$data['type'] = 2;
		$this->load->view('admin/product/sub_category_list', $data);
	}

	public function productAdd()
	{
		$id = $this->input->get('id');
		$decrypt_id = decryptId($id);

		if (isset($id)) {
			$data['title'] = 'Edit Product';
			$getProduct = $this->CommonModel->getSingleRowById('product', "product_id = '$decrypt_id'");
		} else {
			$data['title'] = 'Add Product';
			$getProduct = false;
		}

		$data['product_name'] = set_value('product_name') == false ? @$getProduct['product_name'] : set_value('product_name');
		$data['category_id'] = set_value('category_id') == false ? @$getProduct['category_id'] : set_value('category_id');
		$data['sub_category_id'] = set_value('sub_category_id') == false ? @$getProduct['sub_category_id'] : set_value('sub_category_id');
		$data['product_type'] = set_value('product_type') == false ? @$getProduct['product_type'] : set_value('product_type');
		$data['description'] = set_value('description') == false ? @$getProduct['description'] : set_value('description');
		$data['market_price'] = set_value('market_price') == false ? @$getProduct['market_price'] : set_value('market_price');
		$data['sale_price'] = set_value('sale_price') == false ? @$getProduct['sale_price'] : set_value('sale_price');
		$data['quantity'] = set_value('quantity') == false ? @$getProduct['quantity'] : set_value('quantity');
		$data['quantity_type'] = set_value('quantity_type') == false ? @$getProduct['quantity_type'] : set_value('quantity_type');
		$data['image_all'] = $this->CommonModel->getRowById('product_image', "product_id", $decrypt_id);


		if (count($_POST) > 0) {
			extract($this->input->post());
			$post['product_name'] = $product_name;
			$post['category_id'] = $category_id;
			$post['sub_category_id'] = $sub_category_id;
			$post['description'] = $description;
			$post['product_type'] = $product_type;
			$post['market_price'] = $market_price;
			$post['sale_price'] = $sale_price;
			$post['quantity'] = $quantity;
			$post['quantity_type'] = $quantity_type;

			if (isset($id)) {
				$filesCount = count($_FILES['image']['name']);
				if ($filesCount > 0) {
					for ($i = 0; $i < $filesCount; $i++) {
						$extension = pathinfo($_FILES["image"]["name"][$i], PATHINFO_EXTENSION);
						$newFilename = round(microtime(true) * 1000);
						$_FILES['files']['name'] = $newFilename . '.' . $extension;
						$_FILES['files']['type'] = $_FILES['image']['type'][$i];
						$_FILES['files']['tmp_name'] = $_FILES['image']['tmp_name'][$i];
						$_FILES['files']['error'] = $_FILES['image']['error'][$i];
						$_FILES['files']['size'] = $_FILES['image']['size'][$i];

						$picture = imageUploadWithRatio('files', PRODUCT_IMAGE, 600, 400, "");
						if ($picture) {
							$post2['image_path'] = $picture;
							$post2['product_id'] = $decrypt_id;
							$insert = $this->CommonModel->insertRow('product_image', $post2);
						}
					}
				}
				$update = $this->CommonModel->updateRowById('product', 'product_id', $decrypt_id, $post);
				flashData('errors', 'Produce update successfully');
			} else {
				$p_id = $this->CommonModel->insertRowReturnIdWithClean('product', $post);
				if ($p_id > 0) {
					$filesCount = count($_FILES['image']['name']);
					if ($filesCount > 0) {
						for ($i = 0; $i < $filesCount; $i++) {
							$extension = pathinfo($_FILES["image"]["name"][$i], PATHINFO_EXTENSION);
							$newFilename = round(microtime(true) * 1000);
							$_FILES['files']['name'] = $newFilename . '.' . $extension;
							$_FILES['files']['type'] = $_FILES['image']['type'][$i];
							$_FILES['files']['tmp_name'] = $_FILES['image']['tmp_name'][$i];
							$_FILES['files']['error'] = $_FILES['image']['error'][$i];
							$_FILES['files']['size'] = $_FILES['image']['size'][$i];

							$picture = imageUploadWithRatio('files', PRODUCT_IMAGE, 600, 400, "");
							if ($picture) {
								$post2['image_path'] = $picture;
								$post2['product_id'] = $p_id;
								$insert = $this->CommonModel->insertRow('product_image', $post2);
							}
						}
					}

					flashData('errors', 'Produce add successfully');
				} else {
					flashData('errors', 'Product not add');
				}
			}
			redirect('productAll');
		}
		$this->load->view('admin/product/product_add', $data);
	}

	public function productImageD($id, $img)
	{
		$delete = $this->CommonModel->deleteRowById('product_image', "product_image_id = '" . decryptId($id) . "'");
		unlink(PRODUCT_IMAGE . $img);
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function productDetails()
	{
		$id = $this->input->get('id');
		$decrypt_id = decryptId($id);
		$getProduct = $this->CommonModel->getSingleRowById('product', "product_id = '$decrypt_id'");
		$data['product_name'] = set_value('product_name') == false ? @$getProduct['product_name'] : set_value('product_name');
		$data['company_id'] = set_value('company_id') == false ? @$getProduct['company_id'] : set_value('company_id');
		$data['category_id'] = set_value('category_id') == false ? @$getProduct['category_id'] : set_value('category_id');
		$data['sub_category_id'] = set_value('sub_category_id') == false ? @$getProduct['sub_category_id'] : set_value('sub_category_id');
		$data['product_type'] = set_value('product_type') == false ? @$getProduct['product_type'] : set_value('product_type');
		$data['description'] = set_value('description') == false ? @$getProduct['description'] : set_value('description');
		$data['product_type'] = set_value('product_type') == false ? @$getProduct['product_type'] : set_value('product_type');
		$data['market_price'] = set_value('market_price') == false ? @$getProduct['market_price'] : set_value('market_price');
		$data['sale_price'] = set_value('sale_price') == false ? @$getProduct['sale_price'] : set_value('sale_price');
		$data['quantity'] = set_value('quantity') == false ? @$getProduct['quantity'] : set_value('quantity');
		$data['quantity_type'] = set_value('quantity_type') == false ? @$getProduct['quantity_type'] : set_value('quantity_type');
		$data['image_all'] = $this->CommonModel->getRowById('product_image', "product_id", $decrypt_id);
		$data['title'] = 'Product Details';
		$this->load->view('admin/product/view_product_details', $data);
	}
}
