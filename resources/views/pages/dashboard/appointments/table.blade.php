@extends('layouts.theme')

@section('style')
    <style>
        .appoint-section .select2-selection.select2-selection--single, .appoint-section input, .appoint-section .select2 {
            max-width: 200px;
            height: calc(1.5em + .75rem + 3px);
        }
        tr.disabled {
            opacity: .6;
        }
        .disabled, .disabled .action-btn {
            cursor: not-allowed;
        }
        .sidebar {
            position: absolute;
            width: 360px;
            right: 0;
            top: 0;
            display: block;
            background: #f4f6f8;
            border-left: 1px solid rgba(0, 0, 0, .1) ;
            height: 100%;
        }
        .sidebar i {
            font-size: 2rem
        }
        .middle-text {
            top: 50%;
            left: 50%;
            position: absolute;
            text-align: center;
            transform: translate(-50%, -50%);
        }
    </style>
@endsection

@section('page')

<div class="appoint-section">
    <div class="page-header">
        <div>
            <h3>Appointments</h3>
            <nav aria-label="breadcrumb" class="d-flex align-items-start">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="index.html">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="#">Appointments</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Table</li>
                </ol>
            </nav>
        </div>
    </div>
    
    <div class="row" id="list">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-center">
                        <select name="type">
                            <option value="confirmed">Confirmed</option>
                            <option value="pending">Pending</option>
                            <option value="past">Past</option>
                        </select>
    
                        <input name="date" class="form-control ml-2">
                        
                        <input type="text" class="form-control ml-auto" placeholder="Search">
                    </div>
    
                    <div class="table-responsive mt-2" id="view">
                        @if ($confirmData->count())

                            @foreach ($confirmData as $app)

                            @php
                                if (auth()->user()->user_type == 2) {
                                    $user = $app->appointment->user;
                                } else {
                                    $user = $app->doctor;
                                }
                            @endphp

                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td class="d-flex">
                                            <figure class="avatar avatar-lg">
                                                <img src="{{$user->image()}}" class="rounded-circle" alt="avatar">
                                            </figure>
                                            <div class="ml-2 my-auto">
                                                <h5>{{$user->name}}</h5>
                                                <p class="text-muted">{{$app->appointment->category->name}}</p>
                                            </div>
                                        </td>

                                        <td class="address-row">{{$user->address}}</td>

                                        <td>
                                            <i class="fa fa-clock-o mr-2 text-primary" aria-hidden="true"></i>
                                            {{date('M d H:i', strtotime($app->applied_time))}}
                                        </td>

                                        <td>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="text-danger text-center action-btn">
                                                    <i class="fa fa-ban font-large" aria-hidden="true"></i>
                                                    <h6>Deny</h6>
                                                </div>

                                                <div class="text-center text-success action-btn">
                                                    <i class="fa fa-video-camera font-large"></i>
                                                    <h6>Start</h6>
                                                </div>

                                                <div class="text-center text-black less-btn action-btn" style="display: none" id="{{$app->id}}_less" data-id="{{$app->id}}">
                                                    <i class="fa fa-folder-open-o font-large"></i>
                                                    <h6>Less</h6>
                                                </div>
                                                <div class="text-center text-black more-btn action-btn" id="{{$app->id}}_more" data-id="{{$app->id}}"">
                                                    <i class="ti-more-alt font-large"></i>
                                                    <h6>More</h6>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            @endforeach
                            
                        @else
                            <div class="alert alert-danger alert-with-border" role="alert">
                                There is available Confirmed proposal today
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="sidebar p-5" style="display: none"></div>
</div>

@endsection

@section('script')
<script>
    var type = 'confirmed';
    var start_date = moment(new Date()).format('YYYY-MM-DD');
    var end_date = start_date;
                    
    var loadingView = '<div class="middle-text"><div class="d-flex text-info"><div class="spinner-border mr-2" role="status">' +
    '<span class="sr-only"></span></div><h5 class="my-auto">Loading...</h5></div></div>';
    var errorView = '<div class="middle-text"><h5 class="text-danger">Server Error!</h5></div>'

    $('select[name="type"]').select2({
        placeholder: 'Status'
    });

    $('input[name="date"]').daterangepicker({
        opens: 'center',
        minDate: new Date()
    }, function (start, end, label) {
        start_date = start.format('YYYY-MM-DD');
        end_date = end.format('YYYY-MM-DD');
        getView();
    });

    $(document).on('change', 'select[name="type"]', function() {
        type = $(this).val();
        var today = new Date();

        if (type == 'past') {
            var yesterday = today.setDate(today.getDate() - 1);
            $('input[name="date"]').val(moment(yesterday).format('MM/DD/YYYY') + ' - ' + moment(yesterday).format('MM/DD/YYYY'));

            start_date = moment(yesterday).format('MM/DD/YYYY');
            end_date = moment(yesterday).format('MM/DD/YYYY');

            $('input[name="date"]').daterangepicker({
                maxDate: moment(yesterday)
            }, function (start, end, label) {
                start_date = start.format('YYYY-MM-DD');
                end_date = end.format('YYYY-MM-DD');
                getView();
            });
        } else {
            $('input[name="date"]').daterangepicker({
                minDate: today
            }, function (start, end, label) {
                start_date = start.format('YYYY-MM-DD');
                end_date = end.format('YYYY-MM-DD');
                getView();
            });
        }

        getView();
    });

    $(document).on('click', '.more-btn', function() {
        var clst = $(this).closest('tr');

        if (!clst.hasClass('disabled')) {
            var id = $(this).data('id');
            $(this).toggle();
            $('#' + id + '_less').toggle();

            $('tr').addClass('disabled');
            clst.addClass('shadow');
            clst.removeClass('disabled');

            sidebarShow(id);
        }
    });

    $(document).on('click', '.less-btn', function() {
        var id = $(this).data('id');
        $(this).toggle();
        $('#' + id + '_more').toggle();

        $('tr').removeClass('disabled');
        var clst = $(this).closest('tr');
        clst.removeClass('shadow');

        sidebarHide();
    });

    $(document).on('click', '.app-btn', function(e){
        var id = $(this).data('id');
        var action = $(this).data('type');
        var appointment = $(this).data('appointment');
        var clst = $(this).closest('tr');

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

    function sidebarShow(id) {
        $('#list').css('margin-right', '360px');
        $('.address-row').toggle();
        $('.sidebar').css('display', 'block');
        $('.sidebar').html(loadingView);

        $.ajax({
            url: '/dashboard/appointment/profile',
            type: 'get',
            dataType: 'json',
            data: {
                id: id
            },
            success:function(res) {
                $('.sidebar').html(res.view);
            },
            error: function(err) {
                console.log(err);
                $('.sidebar').html(errorView);
            }
        });
    }

    function sidebarHide() {
        $('#list').css('margin-right', '0');
        $('.address-row').toggle();
        $('.sidebar').css('display', 'none');
    }

    function getView() {
        $('#view').html('<div class="d-flex justify-content-center"><div class="d-inline-flex"><div class="spinner-border text-primary mr-2" role="status">' +
        '</div><h5 class="my-auto text-primary">loading....</h5></div></div>');

        $.ajax({
            url: '/dashboard/appointment/view',
            type: 'get',
            dataType: 'json',
            data: {
                action: type,
                start_date: start_date,
                end_date: end_date
            },
            success:function(res) {
                $('#view').html(res.view);
            },
            error: function(err) {
                console.log(err);
                $('#view').html('<h5 class="text-center my-5 text-danger">Server Error!</h5>');
            }
        });
    }
</script>
@endsection