$("#content .tab a").click(function () {
  $(this).parents(".tab").toggleClass("on");
  return false;
});
