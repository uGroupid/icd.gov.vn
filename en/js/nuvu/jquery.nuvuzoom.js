//NuvuZoom - 2011 - A jQuery Plugin. NRC Studios - http://nuvuzoom.nrcstudios.info written by: Nolan R Campbell - nuvuscripts@gmail.com
(function($){
       $.fn.nuvuzoom = function( options ) {
         //default options
		options = $.extend({
             magnifier : 2,
             outSpeed: 2000,
             easing: 'swing',
             grow: 'true',
             growPercent: 1.5,
             growSpeed: 2000,
             growWidth: 450,
             growHeight: 200,
              animate: 'true',
             movespeed: 1000
		}, options);
     //return each targeted div
    return this.each(function() {
       var $this = $(this);
        var o = $.metadata ? $.extend({}, options, $this.metadata()) : options;
        var dh = $this.height();
        var dw = $this.width();
        var gh = o.growHeight;
        var gw = o.growWidth;
        var origl = $this.find('img').position().left;
        var origt = $this.find('img').position().top;
     //when div hovered do...
   $this.bind('mouseover', function(e){
     //if grow equals true then animate div
   if(o.grow === 'true') {$(this).stop().animate({'height' : (gh*o.growPercent), 'width' : (gw*o.growPercent)},{duration: o.growSpeed, easing: o.easing, queue: false});};
   var cx =  $(this).outerWidth(false);
        var cy =  $(this).outerHeight(false);
        //if grow option  set size for image
    if(o.grow === 'true') {$(this).find('img').stop().css({'height' : ((gh*o.growPercent) * (o.magnifier + 1)), 'width' : ((gw*o.growPercent) * (o.magnifier + 1))});}
    else {$(this).find('img').stop().css({'height' : (cy * (o.magnifier + 1)), 'width' : (cx * (o.magnifier + 1))});};

       $(this).mousemove(function(e){
                     var x =   e.pageX - $(this).offset().left;
                     var y = e.pageY - $(this).offset().top;
                     var xRate = Math.round((x/cx)* 100)/100;
                     var yRate = Math.round((y/cy)* 100)/100;
                     //set magnification size
                       if(o.animate == 'true'){
                        $(this).find('img').stop(true,false).animate({'left' : (cx/cx) - (x*o.magnifier), 'top' : (cy/cy) - (y*o.magnifier) },{duration : o.movespeed});
                     }else{
                        $(this).find('img').css ({'left' : (cx/cx) - (x*o.magnifier) },{duration : 1});
                        $(this).find('img').css({'top' : (cy/cy) - (y*o.magnifier)},{duration : 1});
                       };
                                    });
      });
    $this.bind('mouseleave', function(e){
             // hover out set image to original size
           $(this).find('img').stop().animate({'height' : dh, 'width' : dw, 'left' : origl, 'top' : origt},{duration : o.outSpeed, easing: o.easing});
           //if grow option set to true animate div to original size
           if(o.grow === 'true') { $(this).stop().animate({'height' : dh, 'width' : dw},{duration: o.outSpeed, easing: o.easing, queue: false}); };
         });
});
};//end each

})(jQuery)

