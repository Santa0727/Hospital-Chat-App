@extends('layouts.theme')

@section('page')
<div class="container py-5">
    <div class="mb-3">
    	<h2 class="h5 mb-0 font-bold">Trouver un Patient</h2>
    </div>
    <div class="card-deck d-block d-md-flex u-columns col2-set multiple-items">
    	<div class="card mb-4 mb-md-0 p-5">
    		<header class="row justify-content-between align-items-end title">
                <div class="col-12">
                    <h2 class="h5 mb-0 font-bold">Choisissez votre date</h2>
                </div>
            </header>
            <hr class="mt-2 mb-4">
            <div id="datetimepicker"></div>
    		<input type="hidden" name="datepicker" value="{{date('Y-m-d')}}">
    	</div>
    	<div class="card mb-4 mb-md-0 p-5">
    		<header class="row justify-content-between align-items-end title">
                <div class="col-12">
                    <h2 class="h5 mb-0 font-bold">Prochaines consultations</h2>
                </div>
            </header>
            <hr class="mt-2 mb-4">
    		<div class="mb-5">
                <h6>Vos rendez-vous pour le <b>{{weekDay()}} <span class="selected-date">{{date('d F Y')}}</span></b></h6>
            </div>
            <div id="appointment-row-data"></div>
            <button class="see-more nav-link btn" style="display: none">
                <i class="fa fa-refresh" aria-hidden="true"></i> Load more
            </button> 
        </div>
        <div class="card mb-4 mb-md-0 p-5" id="chat_box"></div>
	</div>
</div>
@endsection

@section('script')
{{-- <script src="{{asset('home/js/page/appointment.confirm.js')}}"></script> --}}
<script>
    var loadData;
    var date;
    var idsArray = [];
    var page = 1;

    $('#datetimepicker').datetimepicker({
        format: 'DD/MM/YYYY',
        minDate: new Date(),
        inline: true,
        sideBySide: true
    }).on('dp.change', function (e){
        $('#appointment-row-data').html('<div class="text-center">Loading....</div>');
        $.ajax({
            url:"get",
            type:'get',
            dataType:'json',
            data:{
                'date':moment(e.date).format('YYYY-MM-DD'),
                'action':'confirm'
            },
            success:function(res){
                $('input[name="datepicker"]').val(moment(e.date).format('YYYY-MM-DD'));
                $('.selected-date').html(moment(e.date).format('DD MMMM YYYY'));
                $('#appointment-row-data').html(res.view);
                if(res.view != '' && window.innerWidth < 992) {
                    $('.slick-next').click();
                }
            }
        });
    });

    setInterval(function(){
        date = $('input[name="datepicker"]').val();
        idsArray = [];
        $("#appointment-row-data .row").each(function() {
            idsArray.push($(this).data('id'));
        });
        if(idsArray.length > 0 ){
            loadData = true;
            $.ajax({
                url:"get?page="+page,
                type:'get',
                dataType:'json',
                data:{
                    'status':'1',
                    'date':date,
                    'action':'confirm_request',
                    'idsArray':idsArray
                },
                success:function(res){
                    if (res.view != '') {
                        if ($('#appointment-row-data').html() == '') {
                            $('#appointment-row-data').append(res.view);
                        } else {
                            $('.see-more').css('display', 'block');
                        }
                    } else {
                        $('.see-more').css('display', 'none');
                    }
                },
                error: function(err) {
                    console.log(err);
                }
            });
        } else {
            loadData = false;
            $.ajax({
                url:"get?page="+page,
                type:'get',
                dataType:'json',
                data:{
                    'status':'1',
                    'date':date,
                    'action':'confirm_request'
                },
                success:function(res){
                    if (res.view != '') {
                        if ($('#appointment-row-data').html() == '') {
                            $('#appointment-row-data').append(res.view);
                            display = false;
                        } else {
                            $('.see-more').css('display', 'block');
                        }
                    } else {
                        $('.see-more').css('display', 'none');
                    }
                },
                error: function(err) {
                    console.log(err);
                }
            });
        }
    }, 5000);

    $('.multiple-items').slick({
        draggable: false,
        arrows: false,
        infinite: false,
        slidesToShow: 2,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });

    $(document).on('click', '.chat-btn', function(e){
        var id = $(this).data('id');
        $.ajax({
            url:"chat/data",
            method:"POST",
            data: {id: id},
            success:function(result){
                $("#chat_box").html(result.view);
                $('.multiple-items').slick('slickNext');
            }
        });
    });

    $(document).on('click', '.before-btn', function(e){
        $('.multiple-items').slick('slickPrev');
    });

    $(document).on('click', '.see-more', function(e){
        e.preventDefault();
        $.ajax({
            url:"get?page="+page,
            dataType:'json',
            data:{
                'status': loadData,
                'date':date,
                'action':'confirm_request',
                'idsArray':idsArray
            },
            success: function(res) {
                $('#appointment-row-data').append(res.view);
                page++
            }
        });
    });
</script>
<script src="https://momentjs.com/downloads/moment.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.14.1/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.14.1/firebase-auth.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.14.1/firebase-storage.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.14.1/firebase-messaging.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.14.1/firebase-firestore.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.14.1/firebase-performance.js"></script>
<script src="{{url('firebase/init.js?version='.time())}}"></script>
@endsection
