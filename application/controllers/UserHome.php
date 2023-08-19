<?php
class UserHome extends CI_Controller
{
    public function index()
    {
        $data['banner'] = $this->CommonModel->getAllRowsInOrder('banner', 'banner_id', 'desc');
        $data['product'] = $this->CommonModel->getRowByOrderWithLimit('product', array('status' => '1'), 'product_id', 'DESC', '10');
        $data['productdesc'] = $this->CommonModel->getRowByOrderWithLimit('product', array('status' => '1'), 'product_id', 'DESC', '20');
        $data['cate'] = $this->CommonModel->getAllRowsInOrderWithLimit('category', '25', 'category_id', 'ASC');
        $data['title'] = 'Kisan Greens | Farm Fresh Product in Bhopal, Madhya Pradesh';
        $this->load->view('home', $data);
    }
    public function product()
    {
        $cateid = $this->input->get('category');
        $data['cateid'] = decryptId($cateid);
        $data['search'] = $this->input->get('searchbox');
        $subcate  = $this->input->get('subcate');
        $data['subcateid'] = decryptId($subcate);
        $data['sidecategory'] = $this->CommonModel->getAllRowsInOrder('category', 'category_id', 'ASC');
        $data['subcategory'] = $this->CommonModel->getAllRowsInOrder('sub_category', 'category_id', 'desc');
        $data['title'] = ' Our product | Kisan Greens | Farm Fresh Product in Bhopal, Madhya Pradesh';
        $this->load->view('product', $data);
    }
    public function filterData()
    {
        $price = ((isset($_POST['price'])) ? $_POST['price'] : '');
        $search = ((isset($_POST['search'])) ? $_POST['search'] : '');
        $category = ((isset($_POST['category'])) ? $_POST['category'] : '');
        $subcategory = ((isset($_POST['subcategory'])) ? $_POST['subcategory'] : '');
        $query = "SELECT * FROM `tbl_product` WHERE `status` = '1'";
        if (($search != '')  || ($category != '') || ($subcategory != '') || ($price != '')) {
            if ($search != '') {
                $query .= " AND `product_name` LIKE '%" . trim($search) . "%'  OR `sale_price` LIKE '%" . trim($search) . "%' OR `description` LIKE '%" . trim($search) . "%'  ";
            }
            if ($category != '') {
                $cate = implode("','", $category);
                $query .= " AND category_id IN('" . $cate . "')";
            }
            if ($subcategory != '') {
                $subcate = implode("','", $subcategory);
                $query .= " AND sub_category_id IN('" . $subcate . "')";
            }
            if ($price != '') {
                if ($price == 0) {
                    $query .= " ORDER BY `sale_price` ASC";
                } else {
                    $query .= " ORDER BY `sale_price` DESC";
                }
            }
        }
        //  echo $query;
        $data['all_data'] = $this->CommonModel->runQuery($query);
        $this->load->view('get_product', $data);
    }

    public function product_details($id, $title)
    {

        $data['products_image'] = $this->CommonModel->getRowById('product_image', 'product_id', decryptId($id));
        $table = "tbl_product";
        $data['details'] = $this->CommonModel->getRowById($table,  'product_id', decryptId($id))[0];
        $data['title'] =  $data['details']['product_name'] . '| Kisan Greens | Farm Fresh Product in Bhopal, Madhya Pradesh';
        $this->load->view('product-details', $data);
    }



    public function contact()
    {
        if (count($_POST) > 0) {
            $post = $this->input->post();
            $insert = $this->CommonModel->insertRowReturnId('contact_query', $post);
            if ($insert) {
                $this->session->set_userdata('msg', 'Your query is successfully submit. We will contact you as soon as possible.');
            } else {
                $this->session->set_userdata('msg', 'We are facing technical error ,please try again later or get in touch with Email ID provided in contact section.');
            }
        } else {
        }
        $data['title'] = 'Contact Us | Kisan Greens | Farm Fresh Product in Bhopal, Madhya Pradesh';
        $this->load->view('contact', $data);
    }
}
