jQuery(document).ready(function ($) {


  // resize big banner
  function resize_big_banner () {
    $('body').find('.full-height-banner').each(function () {
      var $this = $(this),
          height;

      if( $this.data('index') === 1 || $this.data('index') === '1' ) {

        height = window.innerHeight - 40;
        if(height > 800){
          height = 600;
        }
        if ( window.innerHeight < 500) {
          height = window.innerHeight;
        } else {

        }

      } else {
        height = 300;
      }
      $this.css('height', height );
    });
  }

  // resize_collaborative set
  function resize_collaborative(){
    if(window.innerWidth > 768){
      //$('#collaboration-list').children('li').length;
      $('#collaboration-list').children('li').each(function (i) {
        var n = $('#collaboration-list').children('li').length;
        $(this).css('width', 100 / n + '%');
      });
    } else {
        $('#collaboration-list').children('li').attr('style', ' ');
    }
  }
  resize_collaborative();


  //resize facebook box
  function resize_facebook_box(){
    $(".fb-like-box").each(function () {
      var $this = $(this);
      var width = $this.parent().width();
      console.log();
      $this.attr('width', width);
      $this.find('iframe').attr('width', width).css({'max-width': width + 'px', 'width':  width + 'px'});

    });
  }

  setTimeout(function(){
    resize_facebook_box();
  }, 500 );

  // trigger resize event
  $(window).resize(function () {
    setTimeout(function () {
      resize_big_banner();
      resize_collaborative();
      resize_facebook_box();
    }, 200);
  });




  $('.full-height-banner').on('click', function(){
    var $this = $(this);
    var $header = $("#main-header");
    if($this.hasClass('open')){
      if(!$header.hasClass('down')){
        $("#main-header").addClass('down').removeClass('up');
      }
      $this.removeClass('open');
      $(this).stop().animate({
        'height': 300, });
    } else {
      if(!$header.hasClass('up')){
        $("#main-header").addClass('up').removeClass('down');
      }
      $this.addClass('open');
      $(this).stop().animate({
        'height': window.innerHeight, });
    }

  });






  // featured setti
  $(window).scroll(function() {
    $('.animated-element').each(function(){
    var imagePos = $(this).offset().top;

    var topOfWindow = $(window).scrollTop();
      if (imagePos < topOfWindow+$(this).data('trigger')) {
        $(this).addClass($(this).data('effect'));
      }
    });
  });


  /*** FLICKR SETTI HAE JOO TAVARAA JEE ***/

  function get_photo_content(id) {
    // body...
    var dfd = new jQuery.Deferred();
    var flickerAPI = "https://api.flickr.com/services/rest/?";
    flickerAPI = flickerAPI + "method=flickr.photos.getInfo";
    flickerAPI = flickerAPI + "&api_key=bb2825b85ad73148147651fb47e92cab";
    flickerAPI = flickerAPI + "&photo_id=" + id;
    flickerAPI = flickerAPI + "&format=json&nojsoncallback=1";
    $.getJSON( flickerAPI, function (data) {
      // body...
      //console.log(data.photo.urls.url[0]._content);
      $('#photographer-link').attr('href', data.photo.urls.url[0]._content);
      //console.log(data);
    });
  }

  //FLICKR
  function flickr_photos() {
    var flickerAPI = "https://api.flickr.com/services/rest/?method=flickr.groups.pools.getPhotos&nojsoncallback=1";
    flickerAPI = flickerAPI + "&api_key=bb2825b85ad73148147651fb47e92cab";
    flickerAPI = flickerAPI + "&group_id=1586384@N25";
    flickerAPI = flickerAPI + "&format=json";
    flickerAPI = flickerAPI + "&per_page=100";

    $.getJSON( flickerAPI, function (data) {
      // body...
      var rand = Math.floor(Math.random()*100%99),
        $bigbanner = $('#big-banner');
      photo = data.photos.photo[rand];
      var photostring = 'https://farm' + photo.farm +
                '.staticflickr.com/' + photo.server +
                '/' + photo.id + '_' + photo.secret + '_b.jpg';
      $bigbanner.css('background-image', 'url(' + photostring + ')');
      $('#photographer-link').text(photo.ownername);
      get_photo_content(photo.id);
      //$('#photographer-link').attr('href', info.urls.url[0]._content);
      resize_big_banner();
    });

  }
  flickr_photos();

});

// functions
