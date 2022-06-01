<script src="{{asset('assets/js/jquery-3.5.1.min.js')}}"></script>
<!-- Bootstrap js-->
<script src="{{asset('assets/js/bootstrap/popper.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap/bootstrap.js')}}"></script>
<!-- feather icon js-->
<script src="{{asset('assets/js/icons/feather-icon/feather.min.js')}}"></script>
<script src="{{asset('assets/js/icons/feather-icon/feather-icon.js')}}"></script>
<!-- Sidebar jquery-->
<script src="{{asset('assets/js/sidebar-menu.js')}}"></script>
<script src="{{asset('assets/js/config.js')}}"></script>
<!-- Plugins JS start-->
<script src="{{asset('assets/js/chart/chartist/chartist.js')}}"></script>
<script src="{{asset('assets/js/chart/chartist/chartist-plugin-tooltip.js')}}"></script>
<script src="{{asset('assets/js/chart/knob/knob.min.js')}}"></script>
<script src="{{asset('assets/js/chart/knob/knob-chart.js')}}"></script>
<script src="{{asset('assets/js/chart/apex-chart/apex-chart.js')}}"></script>
<script src="{{asset('assets/js/chart/apex-chart/stock-prices.js')}}"></script>
<script src="{{asset('assets/js/notify/bootstrap-notify.min.js')}}"></script>
<script src="{{asset('assets/js/dashboard/default.js')}}"></script>
{{--<script src="{{asset('assets/js/notify/index.js')}}"></script>--}}
<script src="{{asset('assets/js/datepicker/date-picker/datepicker.js')}}"></script>
<script src="{{asset('assets/js/datepicker/date-picker/datepicker.en.js')}}"></script>
<script src="{{asset('assets/js/datepicker/date-picker/datepicker.custom.js')}}"></script>
<script src="{{asset('assets/js/typeahead/handlebars.js')}}"></script>
<script src="{{asset('assets/js/typeahead/typeahead.bundle.js')}}"></script>
<script src="{{asset('assets/js/typeahead/typeahead.custom.js')}}"></script>
<script src="{{asset('assets/js/typeahead-search/handlebars.js')}}"></script>
<script src="{{asset('assets/js/typeahead-search/typeahead-custom.js')}}"></script>
<script src="{{asset('assets/js/tooltip-init.js')}}"></script>
<!-- Plugins JS Ends-->
<script src="{{asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatables/datatable.custom.js')}}"></script>
<!-- Theme js-->
<script src="{{asset('assets/js/script.js')}}"></script>
<script src="{{asset('assets/js/theme-customizer/customizer.js')}}"></script>
<script src="{{asset('assets/js/custom-validation.js')}}"></script>
<script type="text/javascript"
        src="{{ asset('https://cdn.datatables.net/rowgroup/1.0.3/js/dataTables.rowGroup.js') }}"></script>


<!-- Select2 -->
<script src="{{ asset('assets/lib/select2/dist/js/select2.min.js') }}"></script>

<script>
    function notifyMe(message, type = 'default')
    {
        $.notify({
            // options
            message,
        },{
            // settings
            type,
            position:'absolute',
            z_index: 999999,
            showProgressbar:true,
            delay:2000

        });
    }



    function select2Ajax(url)
    {
        return {
            ajax:{
                url,
                dataType: 'json',
                data : function (params) {
                    return {
                        searchTerm: params.term,
                        page : params.page || 1
                    }
                },

                processResults: function (response){
                    return {
                        results: response.data,
                        pagination: {
                            "more": response.pagination
                        }
                    }
                },
                cache : true
            }
        }
    }

    function customUpdateDataTable(id, url)
    {
        let oTable = $(id).DataTable();
        oTable.ajax.url(url).load();
        window.history.pushState('', '', url);
    }

    function checkLang()
    {
        let lang = '{{ App::getLocale() }}'
        let layout = lang === 'en' ? 'ltr' : 'rtl'

        $(".main-layout li, .box-layout li").removeClass('active');
        let elememt = $('.main-layout li[data-attr=' + layout + ']').addClass("active");
        // $("body").attr("main-theme-layout", layout);
        // $("html").attr("dir", layout);
    }
    checkLang()

    //localization li
    $('.main-layout li').on('click', function() {
        console.log('this is test')
        $(".main-layout li").removeClass('active');
        $(this).addClass("active");
        var layout = $(this).attr("data-attr");
        let lang = layout === 'ltr' ? 'en' : 'ar';
        $.ajax({
            url: '{{ url('change-language') }}/' + lang ,
            success: function (response) {
                location.reload();
                // $("body").attr("main-theme-layout", layout);
                // $("html").attr("dir", layout);
            }
        })

    });


    function changeLAng(la){
        $(".main-layout li").removeClass('active');
        $("#change_to_"+la).addClass("active");
        var layout = la;
        let lang = layout === 'ltr' ? 'en' : 'ar';
        $.ajax({
            url: '{{ url('toggle-language') }}/' + lang ,
            success: function (response) {
                location.reload();
                // $("body").attr("main-theme-layout", layout);
                // $("html").attr("dir", layout);
            }
        })

    }

</script>


@stack('scripts')
@yield('js')
