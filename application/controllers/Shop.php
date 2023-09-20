<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Shop extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // $contact = $this->CommonModel->getRowById('contactdetails', 'cid', '1');
        // $this->email = $contact[0]['f_email'];
        // $this->phone = $contact[0]['f_contact'];
        // $this->address = $contact[0]['address'];
        // $this->fb = $contact[0]['facebook'];
        // $this->insta = $contact[0]['instagram'];
        // $this->youtube = $contact[0]['youtube'];
    }
    public function addToCart()
    {
        $product_id = $this->input->post('pid');
        $qty = $this->input->post('qty');
        $product = $this->CommonModel->getRowByIdfield('tbl_product', 'product_id', $product_id, array('product_id', 'sale_price', 'product_name', 'quantity_type'));

        $imgdata = getSingleRowById('tbl_product_image', array('product_id' => $product_id));
        $data = array(
            'id'      => $product[0]['product_id'],
            'qty'     => $qty,
            'quantity_type' => $product[0]['quantity_type'],
            'price'   => $product[0]['sale_price'],
            'name'    => clean($product[0]['product_name']),
            'image'    => $imgdata['image_path']
        );
        $this->cart->insert($data);
        print_r($this->cart->contents());
    }
    public function cart()
    {
        $data['title'] = 'Cart -  Kisan Greens | Farm Fresh Product in Bhopal, Madhya Pradesh';
        $this->load->view('cart', $data);
    }
    public function fetch_data_cart()
    {
        $this->load->view('cart-list');
    }

    public function fetch_cart()
    {
        $this->load->view('cart-product');
    }
    public function delete_item()
    {
        $product_id = $this->input->post('pid');
        $data = array(
            'rowid' => $product_id,
            'qty'   => 0
        );
        $this->cart->update($data);
    }
    public function update_qty()
    {
        extract($this->input->post());
        $data = array(
            'rowid' => $rowid,
            'qty'   => $qty
        );
        $this->cart->update($data);
    }
    public function fetch_totalitems()
    {
        echo $this->cart->total_items();
    }
    public function fetch_totalamount()
    {
        echo '₹' . $this->cart->total() . '/-';
    }

    public function product_discount()
    {
        $totalDiscount = 0;

        foreach ($this->cart->contents() as $items) {
            $data = getSingleRowById('product', array('product_id' => $items['id']));

            $oldPrice = +$data['market_price'];
            $newPrice = +$data['sale_price'];
            $oldPrice = bcmul($oldPrice, $items['qty']);
            $newPrice = bcmul($newPrice, $items['qty']);


            $itemDiscount = $oldPrice - $newPrice;
            $totalDiscount += $itemDiscount;
        }

        echo '₹' . $totalDiscount . '/- (You Saved)';
    }
}
