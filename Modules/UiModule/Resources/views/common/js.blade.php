<!--jQuery-->
<script src="{{asset('uiassets/js/jquery-3.4.1.min.js')}}"></script>
<!--Popper js-->
<script src="{{asset('uiassets/js/popper.min.js')}}"></script>
<!--Bootstrap js-->
<script src="{{asset('uiassets/js/bootstrap.min.js')}}"></script>
<!--Magnific popup js-->
<script src="{{asset('uiassets/js/jquery.magnific-popup.min.js')}}"></script>
<!--jquery easing js-->
<script src="{{asset('uiassets/js/jquery.easing.min.js')}}"></script>
<!--jquery ytplayer js-->
<script src="{{asset('uiassets/js/jquery.mb.YTPlayer.min.js')}}"></script>
<!--wow js-->
<script src="{{asset('uiassets/js/wow.min.js')}}"></script>
<!--owl carousel js-->
<script src="{{asset('uiassets/js/owl.carousel.min.js')}}"></script>
<!--countdown js-->
<script src="{{asset('uiassets/js/jquery.countdown.min.js')}}"></script>
<!--custom js-->
<script src="{{asset('uiassets/js/scripts.js')}}"></script>
<script src="{{asset('assets/js/notify/bootstrap-notify.min.js')}}"></script>
<script src="{{asset('assets/js/custom-validation.js')}}"></script>
<script>
    $('#register').on('submit',function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        formData.append('image', $('#image')[0].files[0]);
        formData.append('type',"{{request()->type}}")
        $.ajax({
            type:'post',
            url:$(this).attr('action'),
            data:formData,
            processData: false,
            contentType: false,
            statusCode: {
                200:function (response) {
                    if (response.code == 200) {
                        document.getElementById("register").reset();
                        $.notify({
                            // options
                            message: response.message,
                        },{
                            // settings
                            type: 'success',
                            position:'absolute',
                            z_index: 999999,
                            showProgressbar:true,
                            delay:1000

                        });

                    } else {
                        $.notify({
                            // options
                            message: 'error while processing request',
                        },{
                            // settings
                            type: 'danger',
                            position:'absolute',
                            z_index: 999999,
                            showProgressbar:true,
                            delay:1000

                        });
                    }
                },
                422:function (response){
                    $.map(response.responseJSON.errors,(error)=>{
                        $.notify({
                            // options
                            message: error[0],
                        },{
                            // settings
                            type: 'danger',
                            position:'absolute',
                            z_index: 999999,
                            showProgressbar:true,
                            delay:2000

                        });
                    });
                }
            },
        })
    });
</script>
