$("#content .tab a").click(function () {
  //3) 현재 내가 클릭한 a태그 중 "부모태그인 .tab"을 찾아서 .on 추가해야함
  $(this).parents(".tab").toggleClass("on");
  return false;
});
