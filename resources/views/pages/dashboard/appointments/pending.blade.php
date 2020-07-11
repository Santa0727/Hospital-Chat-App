@extends('layouts.theme')

@section('style')

@endsection

@section('page')
<div class="page-header">
    <div>
        <h3>Pending Appointment</h3>
        <nav aria-label="breadcrumb" class="d-flex align-items-start">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="index.html">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="#">Appointments</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Pending</li>
            </ol>
        </nav>
    </div>
</div>

<div class="row">
    <div class="col-lg-8 px-0">
        <div class="table-responsive">
            <table class="table">
                <tbody id="pending_view">
                    @foreach ($pendingData as $app)
                    <tr>
                        <td>
                            <div class="d-flex">
                                <figure class="avatar avatar-xl mr-2">
                                    <img src="{{$app->doctor->image()}}" class="rounded-circle mr-2" alt="avatar">
                                </figure>
                                <div class="ml-2">
                                    <i class="fa fa-star text-warning" aria-hidden="true"></i>
                                    <i class="fa fa-star text-warning" aria-hidden="true"></i>
                                    <i class="fa fa-star text-warning" aria-hidden="true"></i>
                                    <i class="fa fa-star text-warning" aria-hidden="true"></i>
                                    <i class="fa fa-star-o text-warning" aria-hidden="true"></i>
                                    <h5>{{$app->doctor->name}}</h5>
                                    <p class="text-muted">
                                        @if ($app->doctor->categories)
                                        {{$app->doctor->categories->name}}
                                        @else
                                        General
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </td>
                        <td>{{$app->doctor->address}}</td>
                        <td>
                            <i class="fa fa-clock-o mr-2 text-primary" aria-hidden="true"></i>
                            {{date('H:i', strtotime($app->applied_time))}}
                        </td>
                        <td>
                            <button type="button" class="btn btn-outline-success btn-rounded btn-uppercase app-btn" data-type="confirm_appointment" data-appointment="{{$app->appointment->id}}" data-id="{{$app->id}}">
                                <i class="ti-check-box"></i><span class="d-sm-block d-none ml-2"> Confirm</span>
                            </button>

                            <button type="button" class="btn btn-outline-danger btn-rounded btn-uppercase app-btn" data-type="cancel" data-id="{{$app->id}}">
                                <i class="ti-trash"></i><span class="d-sm-block d-none ml-2"> Cancel</span>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

@section('script')
{{-- <script src="{{asset('home/js/page/appointment.pending.js')}}"></script> --}}
<script>
    $(document).ready(function() {
    var date;

    $('#datetimepicker').datetimepicker({
        format: 'DD/MM/YYYY',
        minDate: new Date(),
        inline: true,
        sideBySide: true
    }).on('dp.change', function (e){
        $('#pending_view').html('<div class="d-flex justify-content-center"><div class="d-inline-flex"><div class="spinner-border text-primary mr-2" role="status">' +
        '</div><h5 class="my-auto text-primary">loading....</h5></div></div>');

        $.ajax({
            url:"/dashboard/appointment/get",
            type:'get',
            dataType:'json',
            data:{
                'date': moment(e.date).format('YYYY-MM-DD'),
                'action': 'pending'
            },
            success:function(res){
                $('input[name="datepicker"]').val(moment(e.date).format('YYYY-MM-DD'));
                $('#pending_view').html(moment(e.date).format('DD MMMM YYYY'));
                $('#pending_view').html(res.view);
            }
        })
    });

    $(document).on('click', '.app-btn', function(e){
        var id = $(this).data('id');
        var action = $(this).data('type');
        var appointment = $(this).data('appointment');
        var clst = $(this).closest('.tr');

        $.ajax({
            url: '/dashboard/appointment/get',
            type: 'get',
            dataType: 'json',
            data: {
                'id': id,
                'action': action,
                'appointment': appointment
            },
            success:function(res) {
                clst.remove();
                toastr.success('Successfully Done!');
            },
            error: function(err) {
                toastr.error('Something went wrong');
            }
        });
    });

    setInterval(function(){
        date = $('input[name="datepicker"]').val();
        var idsArray = [];
        $("#appointment-row-data .row").each(function() {
            idsArray.push($(this).data('id'));
        });
        if(idsArray.length > 0 ){
            $.ajax({
                url:"/dashboard/appointment/get?page="+page,
                type:'get',
                dataType:'json',
                data:{
                    'status':'0',
                    'date':date,
                    'action':'confirm_request',
                    'idsArray': idsArray
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
            $.ajax({
                url:"/dashboard/appointment/get?page="+page,
                type:'get',
                dataType:'json',
                data:{
                    'status': '0',
                    'date': date,
                    'action': 'confirm_request'
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
                }
            });
        }
    }, 5000);

    $(document).on('click', '.see-more', function(e){
        e.preventDefault();

        var idsArray = [];
        $("#appointment-row-data .row").each(function() {
            idsArray.push($(this).data('id'));
        });

        $.ajax({
            url:"/dashboard/appointment/get?page="+page,
            dataType:'json',
            data:{
                'status': 0,
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
});
</script>
@endsection
