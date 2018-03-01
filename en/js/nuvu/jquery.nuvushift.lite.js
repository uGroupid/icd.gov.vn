//NuvuShift Lite - 2011 - A jQuery Plugin. NRC Studios - http://nuvushift.nrcstudios.info written by: Nolan R Campbell - nuvuscripts@gmail.com
(function($){


     $.fn.nuvushift = function( options ) {
      //set document width and height
      var dWidth    = $(document).width();
      var dHeight   = $(document).height();


		// default options
		options = $.extend({
            img1yStart : 0,
            img1xStart : 0,
            img1xRange : 50,
            img1yRange : 80,
            img1invert : 'false',
            img2yStart : 0,
            img2xStart : 0,
            img2xRange : 150,
            img2yRange : 1,
            img2invert : 'false',
            img3yStart : 0,
            img3xStart : 0,
            img3xRange : 50,
            img3yRange : 180,
            img3invert : 'false',
            img4yStart : 0,
            img4xStart : 0,
            img4xRange : 100,
            img4yRange : 10,
            img4invert : 'false',
            img5yStart : 0,
            img5xStart : 0,
            img5xRange : 420,
            img5yRange : 400,
            img5invert : 'false',
   

		}, options);

    return this.each(function() {

        var $this = $(this);
        //extend settings as options
        var o = $.metadata ? $.extend({}, options, $this.metadata()) : options;

        //document mousemove event
        $(document).mousemove(function(e){
          //evt pageX and Y
        var x      = e.pageX
        var y      = e.pageY
        //set xRate and yRate
        var xRate = Math.round((x/dWidth)* 100)/100
        var yRate = Math.round((y/dWidth)* 100)/100
        //begin each function
        $(this).each( function() {
          //container move


          //img left and right(invert or !invert)
         if(options.img1invert == 'true'){
            $this.find('.img1').css({'left': o.img1xStart + (o.img1xRange*xRate) })
            $this.find('.img1').css({'top': o.img1yStart + (o.img1yRange*yRate) })}
            else
            {
            $this.find('.img1').css({'left': o.img1xStart - (o.img1xRange*xRate) })
            $this.find('.img1').css({'top': o.img1yStart - (o.img1yRange*yRate) })}

        if(options.img2invert == 'true'){
            $this.find('.img2').css({'left': o.img2xStart + (o.img2xRange*xRate) })
            $this.find('.img2').css({'top': o.img2yStart + (o.img2yRange*yRate) })}
            else
            {
            $this.find('.img2').css({'left': o.img2xStart - (o.img2xRange*xRate) })
            $this.find('.img2').css({'top': o.img2yStart - (o.img2yRange*yRate)})}
        if(options.img3invert == 'true'){
            $this.find('.img3').css({'left': o.img3xStart + (o.img3xRange*xRate)})
            $this.find('.img3').css({'top': o.img3yStart + (o.img3yRange*yRate) })}
            else
            {
            $this.find('.img3').css({'left': o.img3xStart - (o.img3xRange*xRate) })
            $this.find('.img3').css({'top': o.img3yStart - (o.img3yRange*yRate) })}
          if(options.img4invert == 'true'){
            $this.find('.img4').css({'left': o.img4xStart + (o.img4xRange*xRate) })
            $this.find('.img4').css({'top': o.img4yStart + (o.img4yRange*yRate) })}
            else
            {
            $this.find('.img4').css({'left': o.img4xStart - (o.img4xRange*xRate) })
            $this.find('.img4').css({'top': o.img4yStart - (o.img4yRange*yRate) })}
       if(options.img5invert == 'true'){
            $this.find('.img5').css({'left': o.img5xStart + (o.img5xRange*xRate) })
            $this.find('.img5').css({'top': o.img5yStart + (o.img5yRange*yRate) })}
            else
            {
            $this.find('.img5').css({'left': o.img5xStart - (o.img5xRange*xRate) })
            $this.find('.img5').css({'top': o.img5yStart - (o.img5yRange*yRate) })}



          } );
        });
      });

       $(window).resize(function(e){
        docWidth  = $(window).width()
        docHeight = $(window).height()
      });




     };//end each























  })(jQuery)

