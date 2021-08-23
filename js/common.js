$(document).ready(function() {
    
    $(window).scroll(function() {

      // selectors
      var $window = $(window),
          $body = $('body'),
          $panel = $('section');

      // Change 33% earlier than scroll position so colour is there when you arrive.
      var scroll = $window.scrollTop() + ($window.height() / 3);

      $panel.each(function () {
        var $this = $(this);

        // if position is within range of this panel.
        // So position of (position of top of div <= scroll position) && (position of bottom of div > scroll position).
        // Remember we set the scroll to 33% earlier in scroll var.
        if ($this.position().top <= scroll && $this.position().top + $this.height() > scroll) {

          // Remove all classes on body with color-
          $body.removeClass(function (index, css) {
            return (css.match (/(^|\s)color-\S+/g) || []).join(' ');
          });

          // Add class of currently active div
          $body.addClass('color-' + $(this).data('color'));
        }
      });    

    }).scroll();


    
    
    
    // init controller
    var controller = new ScrollMagic.Controller({
        refreshInterval: 0
    })
    // init scrollbar
    var elem = document.querySelector(".content");
    var scrollbar = Scrollbar.init(elem);

    // animate each
    $('.animated').each(function(){
      var $this = $(this);
      var $thisHeight = $(this).height();

      var scene = new ScrollMagic.Scene({triggerElement:$this[0],duration: $thisHeight})
          .addIndicators()
          .addTo(controller);

      scene.triggerHook(0.3)

      scene.on('enter', function(){
          $this.addClass('active');
      });

      scene.on('leave', function(event){
          // $this.removeClass('active');
          // console.log(event.scrollDirection);
      });

      scrollbar.addListener(() => {
        scene.refresh()
      })
    })

    // *****************************
    //
    //  SECTION 2
    //
    // *****************************

    var heroHeight = $('.second-section').height();

    var heroTween = TweenMax.fromTo($(".box"), 1, {css: {transform: "scaleX(0)"}}, {css:{transform: "scaleX(1)"}});

    var heroScene = new ScrollMagic.Scene({triggerElement: ".second-section", duration: heroHeight})
      .setTween(heroTween)
      .addIndicators()
      .addTo(controller);

    heroScene.on("progress", function (event) {
      if (event.progress == 1) {
        heroTween.kill();
      }
    });

    scrollbar.addListener(() => {
      heroScene.refresh()
    })
})