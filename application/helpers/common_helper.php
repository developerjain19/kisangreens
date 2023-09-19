<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

function setDateTime()
{
	return date('Y-m-d H:i:s');
}

function setDateOnly()
{
	return date('Y-m-d');
}

function dateConvertToView($date, $type)
{
	if ($type == 1) {
		return date('d-M-Y', strtotime($date));
	} else {
		return date('d-M-Y h:i A', strtotime($date));
	}
}

function dateConvertToDb($date)
{
	return date('Y-m-d', strtotime($date));
}

function sessionId($id)
{
	$ci = &get_instance();
	return $ci->session->userdata($id);
}

function setSession($data)
{
	$ci = &get_instance();
	return $ci->session->set_userdata($data);
}

function setAlert($title, $alert_type, $message)
{
	$ci = &get_instance();
	return $ci->session->set_flashdata('alert_errors', ['title' => $title, 'color' => $alert_type, 'message' => $message]);
}

function insertRow($table, $data)
{
	$ci = &get_instance();
	$clean = $ci->security->xss_clean($data);
	return $ci->db->insert($table, $clean);
}

function returnId($table, $data)
{
	$ci = &get_instance();
	$ci->db->insert($table, $data);
	return $ci->db->insert_id();
}

function randomCode($length_of_string)
{
	$str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	return substr(str_shuffle($str_result), 0, $length_of_string);
}

function getRowById($table, $column, $id)
{
	$ci = &get_instance();
	$get = $ci->db->get_where($table, array($column => $id));
	if ($get->num_rows() > 0) {
		return $get->result_array();
	} else {
		return false;
	}
}

function getSingleRowById($table, $where)
{
	$ci = &get_instance();
	$get = $ci->db->select()
		->from($table)
		->where($where)
		->get();
	if ($get->num_rows() > 0) {
		return $get->row_array();
	} else {
		return false;
	}
}

function getAllRow($table)
{
	$ci = &get_instance();
	$get = $ci->db->select()
		->from($table)
		->get();
	if ($get->num_rows() > 0) {
		return $get->result_array();
	} else {
		return false;
	}
}

function updateRowById($table, $column, $id, $data)
{
	$ci = &get_instance();
	$clean = $ci->security->xss_clean($data);
	$query = $ci->db->where($column, $id)
		->update($table, $clean);
	return $ci->db->affected_rows();
}

function deleteRowById($table, $column, $id)
{
	$ci = &get_instance();
	$ci->db->where($column, $id);
	$ci->db->delete($table);
	if ($ci->db->affected_rows() > 0) {
		return true;
	} else {
		return $ci->db->error();
	}
}

function deleteRowMoreId($table, $where)
{
	$ci = &get_instance();
	$ci->db->where($where);
	$ci->db->delete($table);
	if ($ci->db->affected_rows() > 0) {
		return true;
	} else {
		return $ci->db->error();
	}
}

function getAllRowInOrder($table, $column, $type)
{
	$ci = &get_instance();
	$select = $ci->db->order_by($column, $type)->get($table);
	if ($select->num_rows() > 0) {
		return $select->result_array();
	} else {
		return false;
	}
}

function getRowsByMoreIdWithOrder($table, $where, $column, $type)
{
	$ci = &get_instance();
	$select = $ci->db->order_by($column, $type)->get_where($table, $where);
	if ($select->num_rows() > 0) {
		return $select->result_array();
	} else {
		return false;
	}
}
function getRowsByMoreIdWithOrderlimit($table, $where, $column, $type , $limit)
{
	$ci = &get_instance();
	$select = $ci->db->limit($limit)->order_by($column, $type)->get_where($table, $where);
	if ($select->num_rows() > 0) {
		return $select->result_array();
	} else {
		return false;
	}
}

function getDataByIdInOrder($table, $column, $id, $orderColumn, $type)
{
	$ci = &get_instance();
	$select = $ci->db->order_by($orderColumn, $type)->get_where($table, array($column => $id));
	return $select->result_array();
}

function getAllDataWithLimitInOrder($table, $orderColumn, $type, $start, $end)
{
	$ci = &get_instance();
	$select = $ci->db->order_by($orderColumn, $type)->limit($start, $end)->get($table);
	return $select->result_array();
}

function getRowByMoreId($table, $where)
{
	$ci = &get_instance();
	$get = $ci->db->select()
		->from($table)
		->where($where)
		->get();
	if ($get->num_rows() > 0) {
		return $get->result_array();
	} else {
		return false;
	}
}

function getNumRows($table, $where)
{
	$ci = &get_instance();
	$get = $ci->db->select()
		->from($table)
		->where($where)
		->get();
	return $get->num_rows();
}

function getRowByLikeInOrder($table, $where, $like, $name, $orderBy, $orderType)
{
	$ci = &get_instance();
	$get = $ci->db->select()
		->from($table)
		->where($where)
		->like($like, $name, 'both')
		->order_by($orderBy, $orderType)
		->get();
	if ($get->num_rows() > 0) {
		return $get->result_array();
	} else {
		return false;
	}
}

function encryptId($id)
{
	$ci = &get_instance();
	$key = $ci->encrypt->encode($id);
	return $key;
}

function decryptId($key)
{
	$ci = &get_instance();
	$id = $ci->encrypt->decode($key);
	return $id;
}

function lastReplace($search, $replace, $subject)
{
	$pos = strrpos($subject, $search);
	if ($pos !== false) {
		$subject = substr_replace($subject, $replace, $pos, strlen($search));
	}
	return $subject;
}

function getSumInRow($table, $where, $sumColumn)
{
	$ci = &get_instance();
	$get = $ci->db->select_sum($sumColumn)
		->from($table)
		->where($where)
		->get();
	if ($get->num_rows() > 0) {
		$total = $get->row_array();
		return $total[$sumColumn];
	} else {
		return false;
	}
}

function dateDiffInDays($date1, $date2)
{
	$diff = strtotime($date2) - strtotime($date1);
	return abs(round($diff / 86400));
}

function flashData($var, $message)
{
	$ci = &get_instance();
	return $ci->session->set_flashdata($var, $message);
}

function sendOTP($contact_no, $message_content)
{

	// Account details
	// $apiKey = urlencode('b6CLOTHb+qo-crfyl0wtLevFXS2nixyK1tCtJCFTMy');

	// // Message details
	// $numbers = array('91' . $contact_no);
	// $sender = urlencode('PRODED');
	// $message = rawurlencode($message_content);

	// $numbers = implode(',', $numbers);

	// // Prepare data for POST request
	// $data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);

	// // Send the POST request with cURL
	// $ch = curl_init('https://api.textlocal.in/send/');
	// curl_setopt($ch, CURLOPT_POST, true);
	// curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	// $response = curl_exec($ch);
	// curl_close($ch);

	// // Process your response here
	// echo $response;
}

function getUserId($token)
{
	$ci = &get_instance();
	$ip = $ci->input->ip_address();
	$get = $ci->db->select()
		->from('user_registration')
		->where("user_registration.user_id = '" . $token['data']->id . "' AND user_status = '1' AND unique_hash = '" . $token['data']->unique_hash . "'")
		->get();
	if ($get->num_rows() > 0) {
		return $get->row_array();
	} else {
		return false;
	}
}

function orderIdGenerateUser()
{
	$number = "TXN" . date('ydmhis');
	if (checkOrderIdExistUser($number)) {
		return orderIdGenerateUser();
	} else {
		return $number;
	}
}

function checkOrderIdExistUser($number)
{
	$ci = &get_instance();
	$get = $ci->db->select()
		->from('book_product')
		->where("order_id = '$number'")
		->get();
	if ($get->num_rows() > 0) {
		return true;
	} else {
		return false;
	}
}

function isStatusActive($status)
{
	global $bookingStatus;
	return in_array($bookingStatus, $status);
}

function referralCode()
{
	$number = 'SM-' . rand(9999, 99999);
	if (checkReferralCodeExist($number)) {
		return referralCode();
	} else {
		return $number;
	}
}

function checkReferralCodeExist($number)
{
	$ci = &get_instance();
	$get = $ci->db->select()
		->from('students')
		->where("student_id = '$number'")
		->get();
	if ($get->num_rows() > 0) {
		return true;
	} else {
		return false;
	}
}

function multi_array_search($search_for, $search_in)
{
	foreach ($search_in as $element) {
		if (($element === $search_for) || (is_array($element) && multi_array_search($search_for, $element))) {
			return $element;
		}
	}
	return false;
}

function searchForId($column, $id, $array)
{
	if (!empty($array)) {
		foreach ($array as $key => $val) {
			if ($val[$column] === $id) {
				return $array[$key];
			}
		}
	}
	return false;
}

function imageUpload($imageName, $path, $temp_image)
{
	if (!file_exists($path)) {
		mkdir($path, 0777, true);
	}
	$ci = &get_instance();
	$config['file_name'] = uniqid();
	$config['allowed_types'] = 'jpg|png|jpeg';
	$config['upload_path'] = $path;
	$target_path = $path;
	$config['remove_spaces'] = true;
	$config['overwrite'] = false;
	$ci->load->library('upload', $config);
	$ci->upload->initialize($config);
	if ($ci->upload->do_upload($imageName)) {
		$data = array('upload_data' => $ci->upload->data());
		$path = $data['upload_data']['full_path'];
		$picture = $data['upload_data']['file_name'];
		$configi['image_library'] = 'gd2';
		$config['quality'] = '100%';
		$config['create_thumb'] = FALSE;
		$configi['source_image'] = $path;
		$configi['new_image'] = $target_path;
		$configi['maintain_ratio'] = TRUE;
		$configi['width'] = 380;
		$configi['height'] = 260;
		$ci->load->library('image_lib');
		$ci->image_lib->initialize($configi);
		$ci->image_lib->resize();
		if ($temp_image != "") {
			unlink($target_path . '/' . $temp_image);
		}
		return $picture;
	} else {
		return false;
		// return $ci->upload->display_errors();
	}
}

function imageUploadWithRatio($imageName, $path, $width, $height, $temp_image)
{
	if (!file_exists($path)) {
		mkdir($path, 0777, true);
	}
	$ci = &get_instance();
	$config['file_name'] = uniqid();
	$config['allowed_types'] = 'jpg|png|jpeg';
	$config['upload_path'] = $path;
	$target_path = $path;
	$config['remove_spaces'] = true;
	$config['overwrite'] = false;
	$ci->load->library('upload', $config);
	$ci->upload->initialize($config);
	if ($ci->upload->do_upload($imageName)) {
		$data = array('upload_data' => $ci->upload->data());
		$path = $data['upload_data']['full_path'];
		$picture = $data['upload_data']['file_name'];
		$configi['image_library'] = 'gd2';
		$config['quality'] = '100%';
		$config['create_thumb'] = FALSE;
		$configi['source_image'] = $path;
		$configi['new_image'] = $target_path;
		$configi['maintain_ratio'] = TRUE;
		$configi['width'] = $width;
		$configi['height'] = $height;
		$ci->load->library('image_lib');
		$ci->image_lib->initialize($configi);
		$ci->image_lib->resize();
		if ($temp_image != "") {
			unlink($target_path . '/' . $temp_image);
		}
		return $picture;
	} else {
		return false;
	}
}

function fullImage($imageName, $path, $temp_image)
{
	if (!file_exists($path)) {
		mkdir($path, 0777, true);
	}
	$ci = &get_instance();
	$config['file_name'] = uniqid();
	$config['allowed_types'] = 'jpg|png|jpeg';
	$config['upload_path'] = $path;
	$target_path = $path;
	$config['remove_spaces'] = true;
	$config['overwrite'] = false;
	$ci->load->library('upload', $config);
	$ci->upload->initialize($config);
	if ($ci->upload->do_upload($imageName)) {
		$data = array('upload_data' => $ci->upload->data());
		$path = $data['upload_data']['full_path'];
		$picture = $data['upload_data']['file_name'];
		if ($temp_image != "") {
			unlink($target_path . '/' . $temp_image);
		}
		return $picture;
	} else {
		return false;
		// return $ci->upload->display_errors();
	}
}

function documentUpload($imageName, $path, $temp_image)
{
	if (!file_exists($path)) {
		mkdir($path, 0777, true);
	}
	$ci = &get_instance();
	$config['file_name'] = uniqid();
	$config['allowed_types'] = '*';
	$config['upload_path'] = $path;
	$target_path = $path;
	$config['remove_spaces'] = true;
	$config['overwrite'] = false;
	$ci->load->library('upload', $config);
	$ci->upload->initialize($config);
	if ($ci->upload->do_upload($imageName)) {
		$data = array('upload_data' => $ci->upload->data());
		$path = $data['upload_data']['full_path'];
		$picture = $data['upload_data']['file_name'];
		if ($temp_image != "") {
			unlink($target_path . '/' . $temp_image);
		}
		return $picture;
	} else {
		// return false;
		return $ci->upload->display_errors();
	}
}

function compressImage($file, $path, $temp_file_name)
{
	$image_parts = explode(";base64,", $file);
	$image_base64 = base64_decode($image_parts[1]);
	$file_name = uniqid() . '.png';
	$aadhaarB =  $path . $file_name;
	file_put_contents($aadhaarB, $image_base64);
	if ($temp_file_name != "") {
		unlink($path . $temp_file_name);
	}
	return $file_name;
}

function curlResponse($url, $dataArray)
{
	$ch = curl_init();
	$url =  $url;
	$data = http_build_query($dataArray);
	$getUrl = $url . "?" . $data;
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($ch, CURLOPT_URL, $getUrl);
	curl_setopt($ch, CURLOPT_TIMEOUT, 80);
	$response = curl_exec($ch);
	return json_decode($response, true);
}

function sendMessageToWhatsapp($message, $contact_no)
{
}

function multi_array_in_search($column, $id, $array)
{
	if (!empty($array)) {
		$i = 0;
		foreach ($array as $key => $val) {
			$val['total_user'] =  ++$i;
			if ($val[$column] === $id) {
				return $val;
			}
		}
	}
	return false;
}

function setImage($image_nm, $location)
	{
		if ($image_nm != '') {
			if (file_exists(FCPATH . $location . $image_nm)) {
				return base_url() . $location . $image_nm;
			} else {
				return base_url() . 'upload/default.png';
			}
		} else {
			return base_url() . 'upload/default.png';
		}
	}


function mailmsg($to, $subject, $message)
{
    $config['protocol']    = 'smtp';
    $config['smtp_crypto'] = 'ssl';
    $config['smtp_host']    = 'mail.kisangreens.com';
    $config['smtp_port']    = '465';
    $config['smtp_timeout'] = '8';
    $config['smtp_user']    = 'info@kisangreens.com';
    $config['smtp_pass']    = 'Sagar@11';
    $config['charset']    = 'utf-8';
    $config['newline']    = "\n";
    $config['mailtype'] = 'html';
    $config['validation'] = TRUE;     
    
    $ci = &get_instance();
    $ci->email->initialize($config);
    $ci->email->from('info@kisangreens.com', 'kisan greens');
    $ci->email->to($to);
    $ci->email->cc($to);
    $ci->email->bcc($to);
    $ci->email->subject($subject);
    $ci->email->message($message);
    $ci->email->send();
}
