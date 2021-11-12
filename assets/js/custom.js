$(document).ready(function () {
  // $("#cate-toggle").children().append(drop);
  let arr = $("#cate-toggle")
    .children()
    .children()
    .children()
    .next()
    .children()
    .children()
    .next();
  arr.each(function (index) {
    // console.log(index);
    var parent = $(this);
    var child = $(this).children();
    if (child.length > 3) {
      let drop =
        '<li class="rx-parent"><a class="rx-default custom" href="' +
        parent.prev().attr("href") +
        '">More Categories</a></li>';
      var width = $(window).width();
      for (var i = 2; i <= child.length; i++) {
        if (width > 425) {
          $(child[i]).css("display", "none");
        } else {
          $(child[i]).css("display", "block");
        }
      }
      if (width > 425) {
        parent.append(drop);
      }
    }
  });
  
});
