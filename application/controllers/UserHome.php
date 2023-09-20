<?php
class UserHome extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->profile = $this->CommonModel->getRowById('user_registration', 'user_id', $this->session->userdata('login_user_id'));
    }

    public function index()
    {

        $data['banner'] = $this->CommonModel->getAllRowsInOrder('banner', 'banner_id', 'desc');
        $data['product'] = $this->CommonModel->getRowByOrderWithLimit('product', array('status' => '1'), 'product_id', 'DESC', '10');
        $data['productdesc'] = $this->CommonModel->getRowByOrderWithLimit('product', array('status' => '1'), 'product_id', 'DESC', '20');
        $data['featurepro'] = $this->CommonModel->getRowByOrderWithLimit('product', array('status' => '1', 'product_type' => '2'), 'product_id', 'DESC', '20');
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
                $this->session->set_userdata('msg', '<div class="alert alert-success">Your query is successfully submit. We will contact you as soon as possible.</div>');
            } else {
                $this->session->set_userdata('msg', '<div class="alert alert-danger">We are facing technical error ,please try again later or get in touch with Email ID provided in contact section.</div>');
            }
        } else {
        }
        $data['title'] = 'Contact Us | Kisan Greens | Farm Fresh Product in Bhopal, Madhya Pradesh';
        $this->load->view('contact', $data);
    }



    public function register()
    {
        if ($this->session->has_userdata('login_user_id')) {
            redirect(base_url('profile'));
        }
        $data['logo'] = 'assets/logo.png';
        $data['title'] = 'Register - Kisan Greens | Farm Fresh Product in Bhopal, Madhya Pradesh';
        if (count($_POST) > 0) {
            $count = $this->CommonModel->getNumRows('user_registration', array('email_id' => $this->input->post('email_id'), 'contact_no' => $this->input->post('contact_no')));

            if ($count > 0) {
                $this->session->set_userdata('msg', '<h6 class="alert alert-warning">You have already registered with this email id or contact no.</h6>');
            } else {
                $post = $this->input->post();

                // $message = registermail($post['contact_no'],  $post['password'], base_url() . 'login');
                // sendmail($post['email_id'], 'Registered With Kisan Greens | Welcome User', $message);
                $regid = $this->CommonModel->insertRowReturnId('user_registration', $post);



                if (!empty($regid)) {
                    $this->session->set_userdata('msg', '<h6 class="alert alert-success">You have Registered Successfully.Check mail ID to get your password.Login to continue.</h6>');
                    $this->session->set_userdata(array('login_user_id' => $regid, 'login_user_name' => $post['name'], 'login_user_emailid' => $post['email_id'], 'login_user_contact' => $post['contact_no']));
                    if (count($this->cart->contents()) > 0) {
                        redirect(base_url('checkout'));
                    } else {
                        redirect(base_url('profile'));
                    }
                } else {
                    $this->session->set_userdata('msg', '<h6 class="alert alert-danger">Server error</h6>');
                }
            }
        } else {
        }
        $this->load->view('register', $data);
    }

    public function login()
    {
        if ($this->session->has_userdata('login_user_id')) {
            redirect(base_url('profile'));
        }
        $data['category'] = $this->CommonModel->getAllRowsInOrder('category', 'category_id', 'desc');
        $data['logo'] = 'assets/logo.png';
        $data['title'] = 'Login - Kisan Greens | Farm Fresh Product in Bhopal, Madhya Pradesh';
        if (count($_POST) > 0) {
            extract($this->input->post());
            $table = "user_registration";
            $login_data = $this->CommonModel->getRowByOr($table, array('email_id' => $uname), array('contact_no' => $uname));
            if (!empty($login_data)) {
                if ($login_data[0]['password'] == $password) {
                    $session = $this->session->set_userdata(array('login_user_id' => $login_data[0]['user_id'], 'login_user_name' => $login_data[0]['name'], 'login_user_emailid' => $login_data[0]['email_id'], 'login_user_contact' => $login_data[0]['contact_no']));
                    if (count($this->cart->contents()) > 0) {
                        redirect(base_url('checkout'));
                    } else {
                        redirect(base_url('profile'));
                    }
                } else {
                    $this->session->set_userdata('loginError', '<h6 class="alert alert-warning">Wrong Password.</h6>');
                    redirect(base_url('login'));
                }
            } else {
                $this->session->set_flashdata('loginError', '<h6 class="alert alert-warning">Username or Password not match.</h6>');
                redirect(base_url('login'));
            }
        } else {
            if ($this->session->has_userdata('login_user_id')) {
                redirect(base_url('Web/profile'));
            }
        }
        $this->load->view('login', $data);
    }
    public function forgot_password()
    {
        $data['title'] = 'Forgot Password - Kisan Greens | Farm Fresh Product in Bhopal, Madhya Pradesh';
        if (count($_POST) > 0) {
            extract($this->input->post());
            $email = $this->input->post('email');
            $table = "user_registration";
            $login_data = $this->CommonModel->getSingleRowById($table, array('email_id' => $email));
            if (!empty($login_data)) {
                $message = '<h6 style="margin: 0;
                font-size: 1.3em;
                color: rgb(80, 79, 79);
                font-family: Source Sans Pro;
                letter-spacing: 1px;">Hey there! </h6><br>
                <p style="margin: 0;
                font-size: 1.3em;
                color: rgb(80, 79, 79);
                font-family: Source Sans Pro;
                letter-spacing: 1px;">You Have Been Reset Your Password Sucessfully <br>
                 Your new Password is  - <span style=" color: #ffa800;
                  font-weight: 700;">' . $login_data['password'] . '</span> <br>
                  <p style="margin: 0;
                  padding: 4px;
                  color: #5892FF;
                  font-family: Source Sans Pro;
                  letter-spacing: 1px;">Click To login <a href="' . base_url() . 'login" style="text-decoration: none;
                color: #006573;
                font-weight: 600;"> Kisan Greens</a>
                  </p>
        ';
                mailmsg($email, 'Forgot Password  | From  Kisan Greens', $message);
                $this->session->set_userdata('forget', '<span class="alert alert-success py-2 mt-2">Check your mail ID for Password</span>');
                redirect(base_url('login'));
            } else {
                $this->session->set_userdata('forget', '<span class="alert alert-danger py-2 mt-2">No username found</span>');
                redirect(base_url('forgot-password'));
            }
        } else {
            $this->load->view('forgot-password', $data);
        }
    }
    public function orders()
    {
        if (!$this->session->has_userdata('login_user_id')) {
            redirect();
        }
        $data['login_user'] = $this->session->userdata();
        $data['orderDetails'] = $this->CommonModel->getRowByIdInOrder('book_product', array('user_id' => $this->session->userdata('login_user_id')), 'product_book_id', 'DESC');

        $data['cancelOrderDetails'] = $this->CommonModel->getRowByIdInOrder('book_product', 'user_id = ' . $this->session->userdata('login_user_id') . ' AND booking_status = "2" ', 'product_book_id', 'DESC');

        $data['checkoutnum'] = $this->CommonModel->getNumRows('book_product', array('user_id' => $this->session->userdata('login_user_id')));
        $data['title'] = ' Profile - Kisan Greens | Farm Fresh Product in Bhopal, Madhya Pradesh';
        $data['logo'] = 'assets/logo.png';
        $this->load->view('order-history', $data);
    }
    public function profile()
    {
        // echo '<pre>';
        // print_r($this->profile);

        if (!$this->session->has_userdata('login_user_id')) {
            redirect(base_url());
        }
        $data['login_user'] = $this->session->userdata();
        $data['profiledata'] = $this->CommonModel->getRowById('user_registration', 'user_id', $this->session->userdata('login_user_id'))[0];
        if (count($_POST) > 0) {
            $post = $this->input->post();
            $savedata = $this->CommonModel->updateRowById('user_registration', 'user_id', $this->session->userdata('login_user_id'), $post);
            if ($savedata) {
                $this->session->set_flashdata('msg', 'Profile Updated Sucessfully');
                $this->session->set_flashdata('msg_class', 'alert-success');
            } else {
                $this->session->set_userdata('msg', 'Profile Updated Sucessfully ');
                $this->session->set_flashdata('msg_class', 'alert-danger');
            }
            redirect(base_url('profile'));
        } else {
            $data['title'] = 'Profile - Kisan Greens | Farm Fresh Product in Bhopal, Madhya Pradesh';
            $data['logo'] = 'assets/logo.png';
            $this->load->view('profile', $data);
        }
    }
    public function cancelorder()
    {
        $id = $this->input->post('id');
        $upd = $this->CommonModel->updateRowById('checkout', 'id', $id, array('status' => '2'));
        if ($upd) {
            echo '0';
        } else {
            echo '1';
        }
    }
    public function returnorder()
    {
        $id = $this->input->post('id');
        $upd = $this->CommonModel->updateRowById('checkout', 'id', $id, array('status' => '5'));
        if ($upd) {
            return '0';
        } else {
            return '1';
        }
    }
    public function orderDetails($checkoutID  = true)
    {
        if (!$this->session->has_userdata('login_user_id')) {
            redirect(base_url());
        }
        $data['login_user'] = $this->session->userdata();
        $data['orderDetails'] = $this->CommonModel->getRowByIdInOrder('checkout', array('user_id' => $this->session->userdata('login_user_id')), 'id', 'DESC');
        $data['orderProductDetails'] = $this->CommonModel->getRowById('checkout_product', 'product_book_id', $checkoutID);
        $data['title'] = 'Orde Details - Kisan Greens | Farm Fresh Product in Bhopal, Madhya Pradesh';
        $data['logo'] = 'assets/logo.png';
        $this->load->view('orderDetails', $data);
    }
    public function checkPromo()
    {
        $promocode = $this->input->post('promocode');
        echo json_encode($this->CommonModel->getRowById('tbl_promocode', 'promocode', $promocode));
    }
    public function orderInvoice($checkoutID  = true)
    {
        if (!$this->session->has_userdata('login_user_id')) {
            redirect(base_url());
        }
        $data['orderDetails'] = $this->CommonModel->getRowById('checkout', 'id', $checkoutID);
        $data['orderProductDetails'] = $this->CommonModel->getRowById('checkout_product', 'product_book_id', $checkoutID);
        $data['title'] = ' Your Order Invoice - Kisan Greens | Farm Fresh Product in Bhopal, Madhya Pradesh';
        $data['logo'] = 'assets/logo.png';
        $this->load->view('orderInvoice', $data);
    }
    public function logout()
    {
        $this->session->unset_userdata('login_user_id');
        $this->session->unset_userdata('login_user_name');
        $this->session->unset_userdata('login_user_emailid');
        $this->session->unset_userdata('login_user_contact');
        $this->session->unset_userdata('login_user_type');
        redirect(base_url());
    }

    public function checkout()
    {
        if (!$this->session->has_userdata('login_user_id')) {
            redirect('login');
        }
        $data['login'] = $this->CommonModel->getRowById('user_registration', 'user_id', $this->session->userdata('login_user_id'));

        $data['state_list'] = $this->CommonModel->getAllRows('tbl_state');
        $data['promocode'] = $this->CommonModel->getAllRows('promocode');
        $data['delivery'] = $this->CommonModel->getAllRows('tbl_delivery_charge')[0];

        $data['title'] = 'Checkout - Kisan Greens | Farm Fresh Product in Bhopal, Madhya Pradesh';
        if (count($_POST) > 0) {
            if ($this->input->post('final_amount') > 0) {
                $postdata = $this->input->post();
                $user_id = $this->input->post('user_id');
                $state = $this->input->post('state');
                $city = $this->input->post('city');
                $postal_code = $this->input->post('postal_code');
                $address = $this->input->post('address');
                $data = array('state' => $state, 'city' => $city, 'postal_code' => $postal_code, 'address' => $address);
                $this->CommonModel->updateRowById('user_registration', 'user_id', $user_id, $data);
                $orderId   = orderIdGenerateUser();
                $postdata['order_id']  = $orderId;
                $postdata['booking_date'] = setDateOnly();
                $post = $this->CommonModel->insertRowReturnId('tbl_book_product', $postdata);




                foreach ($this->cart->contents() as $items) :
                    $mydata[]  = array(
                        'create_date' => setDateTime(),
                        'order_id' => $orderId,
                        'no_of_items' => $items['qty'],
                        'base_price' => $items['price'],
                        'user_price' => $items['price'],
                        'booking_price' => ($items['price'] * $items['qty']),
                        'product_id' => $items['id'],
                    );
                endforeach;


                $insert2 = $this->CommonModel->insertRowInBatch('tbl_book_item', $mydata);

                if ($post != '') {
                    if ($this->input->post('payment_mode') == '1') {
                        redirect(base_url('booking-status'));

                        exit();
                    }
                } else {
                    echo 'Check Form Data';
                }
            }
        } else {
            $this->load->view('checkout', $data);
        }
    }
    public function booking_status()
    {

        if (count($this->cart->contents()) > 0) {
            $data['logo'] = 'assets/logo.png';
            $data['title'] = 'Payment Status - Kisan Greens | Farm Fresh Product in Bhopal, Madhya Pradesh';
            $msg = '';
            $msg .= '<img src="assets/img/order.png" alt="Booking" style="max-width: 250px;"/>';

            $msg .= "<p>We're prepping your order.You will be notified regarding the order shipment shortly .<br/>
        Till then happy shopping</p>";
            $msg .= "<br/>";
            $data['message'] = $msg;
            $this->load->view('payment_msg', $data);
            $this->cart->destroy();
        } else {
            redirect(base_url());
        }
    }

    public function getcity()
    {
        $state = $this->input->post('state');
        $data['city'] = $this->CommonModel->getRowByIdInOrder('tbl_city', array('state_id' => $state), 'city_name', 'asc');
        $this->load->view('dropdown', $data);
    }

    public function privacy_policy()
    {
        $data['pp'] = $this->CommonModel->getRowById('tbl_policy', 'ppid', '1');
        $data['title'] = 'Privacy Policy - Kisan Greens | Farm Fresh Product in Bhopal, Madhya Pradesh';
        $this->load->view('privacy-policy', $data);
    }
    public function shipping_policy()
    {
        $data['pp'] = $this->CommonModel->getRowById('tbl_policy', 'ppid', '3');
        $data['title'] = 'Shipping Policy - Kisan Greens | Farm Fresh Product in Bhopal, Madhya Pradesh';
        $this->load->view('shipping-policy', $data);
    }
    // public function refund_policy()
    // {
    //     $data['pp'] = $this->CommonModel->getRowById('tbl_policy', 'ppid', '3');
    //     $data['title'] = 'Shipping Policy - Kisan Greens | Farm Fresh Product in Bhopal, Madhya Pradesh';
    //     $this->load->view('refund-policy', $data);
    // }
    // public function return_policy()
    // {
    //     $data['pp'] = $this->CommonModel->getRowById('tbl_policy', 'ppid', '4');
    //     $data['title'] = 'Return Policy - Kisan Greens | Farm Fresh Product in Bhopal, Madhya Pradesh';
    //     $this->load->view('return-policy', $data);
    // }
    public function term_condition()
    {
        $data['pp'] = $this->CommonModel->getRowById('tbl_policy', 'ppid', '5');
        $data['title'] = 'Terms & Condition - Kisan Greens | Farm Fresh Product in Bhopal, Madhya Pradesh';
        $this->load->view('term-condition', $data);
    }

    public function about()
    {
        $data['title'] = 'About Us - Kisan Greens | Farm Fresh Product in Bhopal, Madhya Pradesh';
        $this->load->view('about', $data);
    }
}
