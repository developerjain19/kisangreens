<?php
class UserHome extends CI_Controller
{
    public function index()
    {
        $data['banner'] = $this->CommonModel->getAllRowsInOrder('banner', 'banner_id', 'desc');
        $data['product'] = $this->CommonModel->getRowByOrderWithLimit('product', array('status' => '1'), 'product_id', 'DESC', '10');
        $data['productdesc'] = $this->CommonModel->getRowByOrderWithLimit('product', array('status' => '1'), 'product_id', 'DESC', '20');
        $data['featurepro'] = $this->CommonModel->getRowByOrderWithLimit('product', array('status' => '1' , 'product_type' => '2' ), 'product_id', 'DESC', '20');
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


    public function register()
    {
        if ($this->session->has_userdata('login_user_id')) {
            redirect(base_url('profile'));
        }
        $data['logo'] = 'assets/logo.png';
        $data['title'] = 'Register - Kisan Greens | Farm Fresh Product in Bhopal, Madhya Pradesh';
        if (count($_POST) > 0) {
            $count = $this->CommonModel->getNumRows('user_registration', array('emailid' => $this->input->post('emailid'), 'contact' => $this->input->post('contact')));
            if ($count > 0) {
                $this->session->set_userdata('msg', '<h6 class="alert alert-warning">You have already registered with this email id or contact no.</h6>');
            } else {
                $post = $this->input->post();
                $message = sendmail($post['emailid'] . '/' . $post['number'],  $post['password'], base_url() . 'login');
                sendmail($post['emailid'], 'Registered with  Mielo food products private limited | Welcome User', $message);
                $regid = $this->CommonModel->insertRowReturnId('user_registration', $post);
                if (!empty($regid)) {
                    $this->session->set_userdata('msg', '<h6 class="alert alert-success">You have Registered Successfully.Check mail ID to get your password.Login to continue.</h6>');
                    $session = $this->session->set_userdata(array('login_user_id' => $regid, 'login_user_name' => $post['fullname'], 'login_user_emailid' => $post['emailid'], 'login_user_contact' => $post['contact']));
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
            $login_data = $this->CommonModel->getRowByOr($table, array('emailid' => $uname), array('contact' => $uname));
            if (!empty($login_data)) {
                if ($login_data[0]['password'] == $password) {
                    $session = $this->session->set_userdata(array('login_user_id' => $login_data[0]['reg_id'], 'login_user_name' => $login_data[0]['fullname'], 'login_user_emailid' => $login_data[0]['emailid'], 'login_user_contact' => $login_data[0]['contact']));
                    if (count($this->cart->contents()) > 0) {
                        redirect(base_url('checkout'));
                    } else {
                        redirect(base_url('profile'));
                    }
                } else {
                    $this->session->set_userdata('msg', '<h6 class="alert alert-warning">Wrong Password.</h6>');
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
            $login_data = $this->CommonModel->getSingleRowById($table, array('emailid' => $email));
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
                  font-weight: 700;">' . $login_data[0]['password'] . '</span> <br>
                  <p style="margin: 0;
                  padding: 4px;
                  color: #5892FF;
                  font-family: Source Sans Pro;
                  letter-spacing: 1px;">Click To login <a href="' . base_url() . 'login" style="text-decoration: none;
                color: #006573;
                font-weight: 600;"> Mielo food products private limited</a>
                  </p>
        ';
                mailmsg($email, 'Forgot Password  | From  Mielo food products private limited', $message);
                $this->session->set_userdata('forget', '<span class="text-success">Check your mail ID for Password</span>');
                // redirect(base_url('Index/forget_password'));
            } else {
                $this->session->set_userdata('forget', '<span class="text-danger">No username found</span>');
                redirect(base_url('Index/forget_password'));
            }
        } else {
            $this->load->view('forgot-password', $data);
        }
    }


    public function orders()
    {
        if (!$this->session->has_userdata('login_user_id')) {
            redirect('index');
        }
        $data['category'] = $this->CommonModel->getAllRowsInOrderWithLimit('category', '7', 'category_id', 'ASC');
        $data['contactdetails'] = $this->CommonModel->getRowById('contactdetails', 'cid', '1');
        $data['login_user'] = $this->session->userdata();
        $data['orderDetails'] = $this->CommonModel->getRowByIdInOrder('checkout', array('user_id' => $this->session->userdata('login_user_id')), 'id', 'DESC');
        $data['checkoutnum'] = $this->CommonModel->getNumRows('checkout', array('user_id' => $this->session->userdata('login_user_id')));
        $data['company'] = "Wholesale kiranawala";
        $data['title'] = ' Profile - Kisan Greens | Farm Fresh Product in Bhopal, Madhya Pradesh';
        $data['logo'] = 'assets/logo.png';
        $this->load->view('orders', $data);
    }
    public function profile()
    {
        if (!$this->session->has_userdata('login_user_id')) {
            redirect(base_url());
        }
        $data['login_user'] = $this->session->userdata();
        $data['orderDetails'] = $this->CommonModel->getRowById('checkout', 'user_id', $this->session->userdata('login_user_id'));
        $data['profiledata'] = $this->CommonModel->getRowById('user_registration', 'reg_id', $this->session->userdata('login_user_id'));
        if (count($_POST) > 0) {
            $post = $this->input->post();
            $savedata = $this->CommonModel->updateRowById('user_registration', 'reg_id', $this->session->userdata('login_user_id'), $post);
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
        $data['orderProductDetails'] = $this->CommonModel->getRowById('checkout_product', 'checkoutid', $checkoutID);
        $data['title'] = 'Orde Details - Kisan Greens | Farm Fresh Product in Bhopal, Madhya Pradesh';
        $data['logo'] = 'assets/logo.png';
        $this->load->view('orderDetails', $data);
    }
    public function checkPromo()
    {
        $promocode = $this->input->post('promocode');
        echo json_encode($this->CommonModel->getRowById('promocode', 'title', $promocode));
    }
    public function orderInvoice($checkoutID  = true)
    {
        if (!$this->session->has_userdata('login_user_id')) {
            redirect(base_url());
        }
        $data['orderDetails'] = $this->CommonModel->getRowById('checkout', 'id', $checkoutID);
        $data['orderProductDetails'] = $this->CommonModel->getRowById('checkout_product', 'checkoutid', $checkoutID);
        $data['title'] = ' Your Order Invoice';
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
        $this->session->unset_userdata('referal_id');
        redirect(base_url());
    }

    public function checkout()
    {
        if (!$this->session->has_userdata('login_user_id')) {
            redirect('login');
        } else {
            $data['login'] = $this->CommonModel->getRowById('user_registration', 'reg_id', $this->session->userdata('login_user_id'));
        }
        $data['category'] = $this->CommonModel->getAllRowsInOrder('category', 'category_id', 'desc');
        $data['state_list'] = $this->CommonModel->getAllRows('tbl_state');
        $data['promocode'] = $this->CommonModel->getRowByMoreId('promocode', array('status' => '0', 'featured' => '0'));
        $data['logo'] = 'assets/logo.png';
        $data['project_name'] = ' Mielo food products private limited ';
        $data['title'] = 'Checkout ';
        if (count($_POST) > 0) {
            if ($this->input->post('grand_total') > 0) {
                $postdata = $this->input->post();
                $user_id = $this->input->post('user_id');
                $state = $this->input->post('state');
                $city = $this->input->post('city');
                $pincode = $this->input->post('pincode');
                $address = $this->input->post('address');
                $data = array('state' => $state, 'city' => $city, 'pincode' => $pincode, 'address' => $address);
                $this->CommonModel->updateRowById('user_registration', 'reg_id', $user_id, $data);
                $postdata['order_id'] = '#' . rand(1000, 10000);

                $post = $this->CommonModel->insertRowReturnId('checkout', $postdata);
                $msg = '';
                $this->session->set_userdata(array('checkoutid' => $post));
                // $this->payment( '' , $postdata['grand_total']);

                foreach ($this->cart->contents() as $items) :
                    $vendor_id =   $this->CommonModel->getRowById('products', 'product_id', $items['id']);
                    $product = array('checkoutid' => $post, 'product_id' => $items['id'], 'product_img' => $items['image'], 'product_name' => $items['name'], 'product_price' => $items['price'], 'product_quantity' => $items['qty'], 'total_pro_amt' => ($items['price'] * $items['qty']));
                    $msg .= "Product name - " . $items['name'] . '(â‚¹ ' . $items['price'] . ' * ' . $items['qty'] . ')<br/>';
                    $this->CommonModel->insertRowReturnId('checkout_product', $product);
                endforeach;
                if ($post != '') {
                    if ($this->input->post('payment_type') == '0') {
                        redirect(base_url('booking_status'));

                        $this->cart->destroy();
                        exit();
                    } else {

                        $this->payment(encryptId($post), $postdata['grand_total']);
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
            $msg .= '<p><figure class="cimg"> <img src="assets/images/booking.png" alt="Booking" style="width:350px"/></figure> </p>';
            $msg .= "<br/>";
            $msg .= "<p>We're prepping your order.You will be notified regarding the order shipment shortly .<br/>
        Till then happy shopping ðŸ™‚</p>";
            $data['message'] = $msg;
            $this->load->view('payment_msg', $data);
        } else {
            redirect(base_url());
        }
    }

    public function getcity()
    {
        $state = $this->input->post('state');
        $data['city'] = $this->CommonModel->getRowByIdInOrder('tbl_cities', array('state_id' => $state), 'name', 'asc');
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
        $data['sp'] = $this->CommonModel->getRowById('tbl_policy', 'ppid', '2');
        $data['title'] = 'Shipping Policy - Kisan Greens | Farm Fresh Product in Bhopal, Madhya Pradesh';
        $this->load->view('shipping-policy', $data);
    }
    public function refund_policy()
    {
        $data['rp'] = $this->CommonModel->getRowById('tbl_policy', 'ppid', '3');
        $data['title'] = 'Shipping Policy - Kisan Greens | Farm Fresh Product in Bhopal, Madhya Pradesh';
        $this->load->view('refund-policy', $data);
    }
    public function return_policy()
    {
        $data['pp'] = $this->CommonModel->getRowById('tbl_policy', 'ppid', '4');
        $data['title'] = 'Return Policy - Kisan Greens | Farm Fresh Product in Bhopal, Madhya Pradesh';
        $this->load->view('return-policy', $data);
    }
    public function term_condition()
    {
        $data['terms'] = $this->CommonModel->getRowById('tbl_policy', 'ppid', '5');
        $data['title'] = 'Terms & Condition - Kisan Greens | Farm Fresh Product in Bhopal, Madhya Pradesh';
        $this->load->view('term-condition', $data);
    }

    

}
