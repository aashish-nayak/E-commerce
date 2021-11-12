// ============= Ajax Live Search Engine  ==============

function viewCart() {
  $.ajax({
    url: "include/ajax.php",
    type: "POST",
    data: { operation: "view-cart" },
    success: function (data) {
      // let arr = $.parseJSON(data);
      console.log(data);
      let total = 0;
      let totalqty = 0;
      let qtyArr = Array();
      let priceArr = Array();
      let nav = data.split("|");
      $("#cart").html(nav[0]);
      $("#cartPage").html(nav[1]);
      $("#checkout-list").html(nav[2]);
      if ($("#cart").children().length > 5) {
        let j = 0;
        $("#cart")
          .children()
          .each(function (index, li) {
            if (j >= 5) {
              $(li).css("display", "none");
            }
            j++;
          });
        $("#cart").append(
          '<p class="text-center product-list mt-20"><a href="cart.php">View Cart</a></p>'
        );
      }
      $("#cart .product-quantity").each(function () {
        qtyArr.push($(this).html());
      });
      $(".item-price").each(function () {
        priceArr.push($(this).data("price"));
      });
      let i = 0;
      $(priceArr).each(function (index, val) {
        total += val * qtyArr[i];
        totalqty += Number(qtyArr[i]);
        i++;
      });
      $("#total").html("₹ " + total);
      $("#cart-subtotal").html("₹ " + total);
      $("#cart-grandtotal").html("₹ " + total);
      let grand =
        '<p class="minicart-total">SUBTOTAL<span>₹ ' +
        total +
        '</span></p><p class="minicart-total">Total<span>₹ ' +
        total +
        "</span></p>";
      $("#grandTotal").html(grand);
      $("#totalqty").html(totalqty);
      $("#check-subtotal").html("₹ " + total);
      $("#check-total").html("₹ " + total);
    },
  });
}
function delItem(id) {
  $.ajax({
    url: "include/ajax.php",
    type: "POST",
    data: { operation: "del-item", id: id },
    success: function (data) {
      // let arr = $.parseJSON(data);
      viewCart();
    },
  });
}
function addToCart(id,qty=1) {
  $.ajax({
    url: "include/ajax.php",
    type: "POST",
    data: { operation: "add-to-cart", item: id, qty: qty},
    success: function (data) {
      viewCart();
      console.log(data);
    },
  });
}
$(document).ready(function () {
  $(".shopping-cart_link").on("click", function () { 
    addToCart($(this).children().data("proid"));
   });
  $(document).on("click",".qtybutton",function () {
    var $button = $(this);
    var oldValue = $button.parent().find("input").val();
    if ($button.hasClass("inc")) {
      var newVal = ++parseFloat(oldValue);
    } else {
      var newVal = --parseFloat(oldValue);
    }
    $button.parent().find("input").val(newVal);
    let qty = newVal;
    let id = $button.parent().find("input").data('itemid');
    addToCart(id,qty);
  });
  $(document).on("keyup",".cart-plus-minus-box", function () {  
    let qty = $(this).val();
    let id = $(this).data('itemid');
    addToCart(id,qty);
  });
});

viewCart();
