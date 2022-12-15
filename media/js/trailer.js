$(document).ready(function () {
  let ind = 0;
  //trailer click event
  $.ajax({
    url: "./js/trailer.json",
    dataType: "json",
    success: function (data) {
      var useTrailer = data.trailer;

      function trailer_func(ind) {
        var trailerTxt = "";
        trailerTxt += '<div class="youtube_box">';
        trailerTxt +=
          '<div><iframe src="' +
          useTrailer[ind].url +
          '" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>';
        trailerTxt += "</div>";
        trailerTxt += "<dl><dt>" + useTrailer[ind].title + "</dt>";
        trailerTxt += "<dd>" + useTrailer[ind].text;

        trailerTxt += '<a href="#" class="close">close</a>';

        $(".trailer_pop").html(trailerTxt);
      }

      $(document).on("click", ".trailer_lst li", function (e) {
        e.preventDefault();

        ind = $(this).index();
        console.log(ind);

        trailer_func(ind);

        $(".trailer_pop").fadeIn();
        $(".trailer_pop_bg").fadeIn();
      });

      $(document).on(
        "click",
        ".trailer_pop .close, .trailer_pop_bg",
        function (e) {
          e.preventDefault();

          $(".trailer_pop").fadeOut("fast", function () {
            $(".trailer_pop").html("");
          });
          $(".trailer_pop_bg").fadeOut("fast");
        }
      );
    },
  });
});
