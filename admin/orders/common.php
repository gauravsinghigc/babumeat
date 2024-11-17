<div class="row m-t-10">
  <div class="col-md-7">
    <div class="btn-group btn-group-sm">
      <a href="<?php echo DOMAIN; ?>/admin/orders/index.php" class="btn btn-sm btn-success square">All Orders</a>
      <a href="<?php echo DOMAIN; ?>/admin/orders/accepted.php" class="btn btn-sm btn-info square">All Accepted</a>
      <a href="<?php echo DOMAIN; ?>/admin/orders/shipped.php" class="btn btn-sm btn-success square">All Shipped</a>
      <a href="<?php echo DOMAIN; ?>/admin/orders/delivery.php" class="btn btn-sm btn-warning square">All Out for Delivery</a>
      <a href="<?php echo DOMAIN; ?>/admin/orders/delivered.php" class="btn btn-sm btn-primary square">All Delivered</a>
      <a href="<?php echo DOMAIN; ?>/admin/orders/cancelled.php" class="btn btn-sm btn-danger square">All Cancelled</a>
    </div>
  </div>
  <div class="col-md-5">
    <div class="search-form m-t-0">
      <form action="" method="get">
        <div class="flex-s-b p-0 m-b-0">
          <input type="text" name="search" value="true" hidden="">
          <select name="search_type" class="form-control-2" id="searchoptions" onchange="CheckSearchOptions()">
            <option value="Custom Order Id" selected>Order Id</option>
            <option value="Net Payable Amount">Net Payable Amount</option>
            <option value="Order Reference id">Order Reference id</option>
            <option value="Order Payment Mode">Order Payment Mode</option>
            <option value="Order Create Date">Order Create Date</option>
          </select>
          <input type="text" class="form-control-2" id="searchplaceholder" placeholder="Search By Order Id" onchange="form.submit()" list="available_details" name="search_value">
          <datalist id="available_details">
            <?php SelectOptions("SELECT * FROM orders GROUP BY CustomOrderId", "CustomOrderId", "CustomOrderId", "ASC"); ?>
            <?php SelectOptions("SELECT * FROM orders GROUP BY NetPayableAmount", "NetPayableAmount", "NetPayableAmount", "ASC"); ?>
            <?php SelectOptions("SELECT * FROM orders GROUP BY OrderReferenceid", "OrderReferenceid", "OrderReferenceid", "ASC"); ?>
            <?php SelectOptions("SELECT * FROM orders GROUP By OrderPaymentMode", "OrderPaymentMode", "OrderPaymentMode", "ASC"); ?>
            <?php SelectOptions("SELECT * FROM orders GROUP By OrderCreateDate", "OrderCreateDate", "OrderCreateDate", "ASC"); ?>
          </datalist>
        </div>
      </form>
    </div>
  </div>
  <script>
    function CheckSearchOptions() {
      var searchoptions = document.getElementById("searchoptions");
      var searchplaceholder = document.getElementById("searchplaceholder");
      searchplaceholder.placeholder = "Search By " + searchoptions.value;
    }
  </script>
  <?php CLEAR_SEARCH(); ?>
</div>