<script src="<?= base_url() ?>assets/vendor/bootstrap/jquery-1.12.4.min.js"></script>
<script src="<?= base_url() ?>assets/vendor/bootstrap/popper.min.js"></script>
<script src="<?= base_url() ?>assets/vendor/bootstrap/bootstrap.min.js"></script>
<script src="<?= base_url() ?>assets/vendor/countdown/countdown.min.js"></script>
<script src="<?= base_url() ?>assets/vendor/niceselect/nice-select.min.js"></script>
<script src="<?= base_url() ?>assets/vendor/slickslider/slick.min.js"></script>
<script src="<?= base_url() ?>assets/vendor/venobox/venobox.min.js"></script>
<script src="<?= base_url() ?>assets/js/nice-select.js"></script>
<script src="<?= base_url() ?>assets/js/countdown.js"></script>
<script src="<?= base_url() ?>assets/js/accordion.js"></script>
<script src="<?= base_url() ?>assets/js/venobox.js"></script>
<script src="<?= base_url() ?>assets/js/slick.js"></script>
<script src="<?= base_url() ?>assets/js/main.js"></script>

<div id="snackbar">Item Added Successfully</div>
<script>
  function fetchdata() {
    $.ajax({
      url: '<?= base_url("Shop/fetch_cart") ?>',
      success: function(response) {
        $('#cartlist').html(response);

      }
    });
  }
  fetchdata();

  function load_product() {
    $.ajax({
      url: '<?= base_url("Shop/fetch_data_cart") ?>',
      success: function(response) {
        $('#cart').html(response);

      }
    });


    $.ajax({
      url: '<?= base_url("Shop/fetch_totalitems") ?>',
      method: 'POST',
      success: function(response) {
        $('.totalitem').text(response);
      }
    });

    $.ajax({
      url: '<?= base_url("Shop/fetch_totalamount") ?>',
      method: 'POST',
      success: function(response) {
        $('.totalamount').text(response);

      }
    });
    load_checkoutbar();
    promo();
  }
  load_product();
  // load_cart_list();

  function mySanckbar() {
    x = document.getElementById("snackbar");
    x.className = "show";
    setTimeout(function() {
      x.className = x.className.replace("show", "");
    }, 3000);
  }

  $(document).on('click', '.addCart', function() {
    var pid = $(this).data('id');
    var qty = $('#qtysidecart' + pid).val();
    $(".addCart").attr('disabled', true);

    $.ajax({
      method: "POST",
      url: "<?= base_url('Shop/addToCart') ?>",
      data: {
        pid: pid,
        qty: qty
      },
      beforeSend: function() {
        $('.cartbtn' + pid).html('<i class="fa fa-spinner fa-spin"></i> Loading...');
      },
      success: function(response) {
        console.log("cart response =" + response);
        load_product();
        mySanckbar();
        $(".addCart").attr('disabled', false);
        $('#cartbtn' + pid).html('Add');
        // $("#cart").click();
      }
    });
  });
  $(document).on('click', '.buynow', function() {
    var pid = $(this).data('id');
    var qty = $('#qtysidecart' + pid).val();
    $.ajax({
      method: "POST",
      url: "<?= base_url('Shop/addToCart') ?>",
      data: {
        pid: pid,
        qty: qty
      },
      success: function(response) {
        window.location = "<?= base_url('checkout') ?>";
      }
    });
  });
  $(document).on('click', '.removeCarthm', function() {
    var pid = $(this).data('id');
    console.log(pid);
    $.ajax({
      method: "POST",
      url: "<?= base_url('Shop/delete_item') ?>",
      data: {
        pid: pid
      },
      success: function(response) {
        load_product();
        alert('Item has been removed into your cart')
        <?php
        if (strtolower($title) == 'my cart') {
        ?>
          load_cart_list();
        <?php
        } else {
        ?>
          $("#cart").click();
        <?php
        }
        ?>
      }
    });
  });
  $(document).on('click', '.qty', function() {
    var numberField = jQuery(this).parent().find('[type="number"]');
    var currentVal = numberField.val();
    var sign = jQuery(this).val();
    if (sign === '-') {
      if (currentVal > 1) {
        numberField.val(parseFloat(currentVal) - 1);
      }
    } else {
      numberField.val(parseFloat(currentVal) + 1);
    }

    var rowid = jQuery(this).data('rowid');
    var price = jQuery(this).data('price');
    var qty = numberField.val();

    $.ajax({
      method: "POST",
      url: "<?= base_url("Shop/update_qty") ?>",
      data: {
        rowid: rowid,
        qty: qty
      },
      success: function(response) {
        load_product();
        $('#item_total' + rowid).text((qty * price));
      }
    });
  });


  $(document).on('change', '#state', function() {

    var state = $(this).val();

    $.ajax({
      method: "POST",
      url: "<?= base_url('UserHome/getcity') ?>",
      data: {
        state: state
      },
      success: function(response) {
        // console.log(response);
        $('#city').html(response);
      }
    });
  });
  $(document).on('click', '#promo', function() {
    promo();
  });

  function load_checkoutbar() {
    var referalpoint = $('#referalpointcheck').data('point');

    var shipping = $('#shipping_charges').val();

    
    var tamt = $('#totalamount').val();
    var promocode_amt = $('#promocode_amt').val();
    if (promocode_amt == '') {
      console.log(parseInt(tamt));
      $('#cartgrandprice').text('₹ ' + parseInt(tamt) + parseInt(shipping));
      $('#grand_total').val(parseInt(tamt) + parseInt(shipping));
      $('#cartprice').text('₹ ' + (parseInt(tamt) + parseInt(shipping)) + '/-');
      console.log('4');
    } else {
      $('#cartgrandprice').text('₹ ' + parseInt(tamt) - parseInt(promocode_amt) + parseInt(shipping));
      $('#grand_total').val(parseInt(tamt) - parseInt(promocode_amt) + parseInt(shipping));
      $('#cartprice').text('₹ ' + (parseInt(tamt) - parseInt(promocode_amt) + parseInt(shipping)) + '/-');
      console.log('3');

    }
  }

  function promo() {
    var promocode = $('#promocode').val();
    console.log(promocode);
    $.ajax({
      method: "POST",
      url: "<?= base_url('UserHome/checkPromo') ?>",
      data: {
        promocode: promocode
      },
      success: function(response) {
        console.log(response);
        if (response == 'false') {
          $('#promomsg').text('');
          $('#promocode_amt').val('0');
          var tamt = $('#totalamount').val();
          var referalpoint = $('#referalpoint').val();

          $('#cartprice').text('₹ ' + parseInt(tamt) + '/-');

          var sc = $('#shipping_charges').val();
          $('#cartgrandprice').text('₹ ' + ((parseInt(tamt)) + parseFloat(sc)).toFixed(2));


          $('#grand_total').val(parseInt(tamt));

        } else {
          var obj = JSON.parse(response);
          //  console.log(obj[0]['deduction']);

          $('#promocode_amt').val(obj[0]['amount']);
          var tamt = $('#totalamount').val();
          var lastamt = $('#grand_total').val();


          if (parseInt(lastamt) >= obj[0]['minimum_order']) {

            $('#promomsg').html('<span style="color:#28a745 "><b>Applied !Promo code Offer amount - ₹ ' + obj[0]['amount'] + '</b></span>');
            $('#cartprice').text('₹ ' + (tamt - obj[0]['amount']) + '/-');

            var sc = $('#shipping_charges').val();
            $('#cartgrandprice').text('₹ ' + (parseInt(tamt) - (parseInt(obj[0]['amount']) + parseFloat(sc)).toFixed(2)));

            $('#grand_total').val((parseInt(tamt) - (parseInt(obj[0]['amount']) + parseFloat(sc)).toFixed(2)));
          } else {
            alert('This Promocode is not applicable for your order');
            location.reload();
          }

        }
      }
    });
  }


  function load_cart_list() {
    $.ajax({
      url: '<?= base_url("Shop/fetch_data_cart") ?>',
      method: 'POST',
      success: function(response) {
        $('#cart_items_preview').html(response);
      }
    });

  }

  function load_checkout_list() {
    $.ajax({
      url: '<?= base_url("Shop/fetch_checkout_cart") ?>',
      method: 'POST',
      success: function(response) {
        $('#checkout_items_preview').html(response);
      }
    });

  }

  $(document).on('click', '.removeCarthm', function() {
    var pid = $(this).data('id');
    console.log("pid" + pid);
    // console.log('sadasd');

    $.ajax({
      method: "POST",
      url: "<?= base_url('Shop/delete_item') ?>",
      data: {
        pid: pid
      },
      success: function(response) {
        load_product();
        load_cart_list();
        load_checkout_list();
      }
    });
  });

  function load_cart_list() {
    $.ajax({
      url: '<?= base_url("Shop/cart") ?>',
      method: 'POST',
      success: function(response) {
        $('#cart_items_preview').html(response);
      }
    });

  }

  load_checkoutbar();
</script>