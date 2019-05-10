@extends('frontend.layouts.app')
@section('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simplebar@latest/dist/simplebar.css">

@endsection
@section('page_title' , trans('frontend.chat'))

@section('content')

<div class="container">
  <div class="row">

      <div class="main-section">
          <div class="head-section">
            
            <div class="headRight-section">
                <div class="headRight-sub">
                    <h3>{{trans('frontend.conversations')}}</h3>
                    <small>{{trans('frontend.conversations_description')}}</small>
                </div>
            </div>
        </div>
        
        <div class="body-section">
            <div class="left-section mCustomScrollbar" data-mcs-theme="minimal-dark" data-simplebar>
            <ul></ul>
        </div>
        <div class="right-section">
            <div class="message mCustomScrollbar" data-mcs-theme="minimal-dark" data-simplebar>
               <ul>
                  <li class="msg-left">
                     <div class="msg-left-sub">
                      <img src="https://www.nicesnippets.com/demo/man03.png">
                      <div class="msg-desc">
                       Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                       tempor incididunt ut labore et dolore magna aliqua.
                   </div>
                   <small>05:25 am</small>
               </div>
           </li>
           <li class="msg-right">
             <div class="msg-left-sub">
              <img src="https://www.nicesnippets.com/demo/man03.png">
              <div class="msg-desc">
               Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
               tempor incididunt ut labore et dolore magna aliqua.
           </div>
           <small>05:25 am</small>
       </div>
   </li>
   <li class="msg-left">
     <div class="msg-left-sub">
      <img src="https://www.nicesnippets.com/demo/man03.png">
      <div class="msg-desc">
       Lorem ipsum dolor sit amet, consectetur adipisicing elit
   </div>
   <small>05:25 am</small>
</div>
</li>
<li class="msg-right">
 <div class="msg-left-sub">
  <img src="https://www.nicesnippets.com/demo/man03.png">
  <div class="msg-desc">
   Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
   tempor incididunt ut labore et dolore magna aliqua.
</div>
<small>05:25 am</small>
</div>
</li>
<li class="msg-left">
 <div class="msg-left-sub">
  <img src="https://www.nicesnippets.com/demo/man03.png">
  <div class="msg-desc">
   Lorem ipsum dolor sit amet, consectetur adipisicing elit
</div>
<small>05:25 am</small>
</div>
</li>
<li class="msg-right">
 <div class="msg-left-sub">
  <img src="https://www.nicesnippets.com/demo/man03.png">
  <div class="msg-desc">
   Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
   tempor incididunt ut labore et dolore magna aliqua.
</div>
<small>05:25 am</small>
</div>
</li>
</ul>
</div>
<div class="right-section-bottom">
    <input type="text" name="" placeholder="type here...">
    <button class="btn-send"><i class="fa fa-send"></i></button>
</div>
</div>
</div>
</div>

</div>

</div>
</div>

@endsection
@section('scripts')
<script src="{{asset('frontend/js/jquery.nicescroll.min.js')}}"></script>
<script>

    $(document).ready(function() {

    $(".left-section").niceScroll();
    // $(".message").niceScroll();


  // All Coversation
  var offset  = 0;
  $.ajaxSetup({
     headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
     }
 });
  $.ajax({
    url: '{{url('/get-conversation')}}',
    type: 'POST',
    data: {
      offset_id : offset,
      lang : '{{LaravelLocalization::getCurrentLocale()}}'
  },
  success: function (data) {
      if(data != '') {
        $.each( data.data , function ( key , value ) {
        	var img = value.user_image

        	if (value.user_image == "" || value.user_image == null) {
        		img = "https://www.mycustomer.com/sites/all/modules/custom/sm_pp_user_profile/img/default-user.png"
        	}

            var notification = "";
            if (value.count > 0) {
                notification = '<small class="notification-icon">'+value.count+'</small>';
            } else if (value.count > 9) {
                notification = '<small class="notification-icon">9+</small>';
            }

            $('.left-section ul').append('<li reciver_id="'+value.reciver_id+'" conv_id="' + value.conversation_id + '">'+
              '<div class="chatList">'+
              '<div class="img">'+
							//	'<i class="fa fa-circle"></i>'+
                            '<img src="'+img+'">'+
                            '</div>'+
                            '<div class="desc">'+
                            '<h5>'+ value.user_name+'</h5>'+
                            '<small>'+value.last_message.substring(0,10)+'</small> <br>'+
                            '<small class="time">'+value.date+'</small>'+
                            notification +
                            '</div>'+
                            '</div>'+
                            '</li>');
            offset++;
        });
    }
}
});









    // this is for load more function
    var offset  = 0;
    // Add Active Class When Click On Li
    $('.left-section').on('click', 'li', function() {
        // adding active class for li
        $(this).parent('li').addClass('active').siblings().removeClass('active');
        $(this).addClass('active').siblings().removeClass('active');

        // setting header of chat
        $('.headRight-sub h3').html($(this).find('h5').text());
        $('.headRight-sub small').html($(this).find('small:last').text());
        // add reciver_id to send btn
        $('.btn-send').attr('reciver_id', $(this).attr('reciver_id'))

        // reset offset for new conversation
        offset = 0;
        $('.message ul').empty();

        // hide notification icon
        $(this).find('.notification-icon').fadeOut(1500); 

        // get all messages of conversation
        getAllMessage($(this).attr('conv_id'));
    });
    


    $('.right-section  li:last').animate({
        scrollTop: $(".right-section  li:last").offset().top
    }, 1000)

    // Get ALl Message Ajax
    function getAllMessage(convID) {
        $.ajax({
            url: '{{url('/get-messages')}}',
            type: 'POST',
            data: {
                offset_id : offset,
                conversation_id : convID,
                lang : '{{LaravelLocalization::getCurrentLocale()}}'
            },
            success: function (data) {
                $.each( data.data , function ( key , value ) {
                    if (value.sender_id == '{{auth()->user()->id}}') {

                        $('.message ul').append(
                            '<li class="msg-right">'+
                            '<div class="msg-left-sub">'+
                            '<img src="'+value.sender_image+'">'+
                            '<div class="msg-desc">'+value.text+'</div>'+
                            '<small>'+ value.date +'</small>'+
                            '</div>'+
                            '</li>');
                    } else if ((value.receiver_id == '{{auth()->user()->id}}')) {
                        $('.message ul').append(
                            ' <li class="msg-left">' +
                            '<div class="msg-left-sub">'+
                            '<img src="'+ value.sender_image +'">'+
                            '<div class="msg-desc"> '+ value.text +'</div>'+
                            '<small>' + value.date + '</small>'+
                            '</div>'+
                            '</li>');
                    }
                    offset++;
                });
                $(".right-section .message").animate({ scrollTop: $('.right-section .message').prop("scrollHeight")}, 1000);
            }
        });
    }

    $('.right-section').on('click', '.btn-send', function() {
        var message = $(this).parent().find('input').val();
        var reciver_id = $(this).attr('reciver_id');
        if (message == "") {
            swal('{{trans('frontend.send_message_required')}}')
            return false
        }

        if (typeof reciver_id == 'undefined') {
            swal('Please choose conversation!')
            alert('ss')
            return false
        }

        sendMessage(reciver_id, message);
    });
    // Get ALl Message Ajax
    function sendMessage(receiver, message) {
        $.ajax({
            url: '{{url('/send-message')}}',
            type: 'POST',
            data: {
                receiver_id : receiver,
                message : message,
                lang : '{{LaravelLocalization::getCurrentLocale()}}'
            },
            success: function (value) {
                value = value.data
                if (value.sender_id == '{{auth()->user()->id}}') {
                    $('#mCSB_2_container ul').append(
                        '<li class="msg-right">'+
                        '<div class="msg-left-sub">'+
                        '<img src="'+value.sender_image+'">'+
                        '<div class="msg-desc">'+value.text+'</div>'+
                        '<small>'+ value.date +'</small>'+
                        '</div>'+
                        '</li>');
                } else  {
                    $('#mCSB_2_container ul').append(
                        ' <li class="msg-left">' +
                        '<div class="msg-left-sub">'+
                        '<img src="'+ value.receiver_image +'">'+
                        '<div class="msg-desc"> '+ value.text +'</div>'+
                        '<small>' + value.date + '</small>'+
                        '</div>'+
                        '</li>');
                }
                $('.right-section-bottom input').val('');
            }
        });
    }
});


</script>





@endsection
