    <script src="{{asset('js/jquery.js')}}"></script>
    <script src="{{asset('js/jquery.sticky.js')}}"></script>
    <script type="text/javascript">
      if($(window).width() >= 991){
        $("#menu").sticky({topSpacing:15});
      }
      else{
        $("#menu").unstick();
      }
      $( window ).resize(function() {
        if($(window).width() >= 991){
          $("#menu").sticky({topSpacing:15});
        }
        else{
          $("#menu").unstick();
        }
      });
      var k=1;
      $( "#trigger" ).click(function(e) {;
        e.preventDefault();
        if(k++<7)
          $( "#logo" ).attr("src","{{asset('images')}}/logonoheader"+ k +".png");
      });
    </script>
  </script>