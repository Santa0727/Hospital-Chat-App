@extends('layouts.theme')

@section('style')
<style>
    .doctor-home .card-scroll {
        height: 440px;
    }
</style>
@endsection

@section('page')
<section class="doctor-home">
    
    @if (auth()->user()->cagetories)
    <div class="float-right">
        <div class="d-flex">
            <h5 class="my-auto mr-2">{{auth()->user()->categories->name}}</h5>
            <img src="{{auth()->user()->categories->image}}" alt="" class="rounded-circle" width="60" style="background: {{auth()->user()->categories->color}}">
        </div>
    </div>
    @endif

    <div class="page-header d-md-flex justify-content-between">
        <div>
            <h3>Welcome back, {{auth()->user()->name}}</h3>
            <p class="text-muted">This page shows an overview for your account summary.</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex py-2">
                                <h5 class="my-auto">Pending Appointments</h5>
                                <input type="text" name="daterangepicker_pending" class="form-control date-picker ml-auto">
                            </div>
                            
                            <div class="card-scroll">
                                <div class="table-responsive" id="pending_view">
                                @if ($appData->where('status', 0)->count())
                                    <table class="table"><tbody>
                                        @foreach ($appData->where('status', 0) as $app)
                                        <tr data-id="{{$app->id}}">
                                            <th class="d-flex">
                                                <figure class="avatar avatar-md mr-2">
                                                    <img src="{{$app->appointment->user->image() }}" class="rounded-circle" alt="image">
                                                </figure>
                                                <div class="my-auto">
                                                    {{$app->appointment->user->name}}
                                                    <p class="text-muted">{{$app->appointment->category->name}}</p>
                                                </div>
                                            </th>
                                            <td>{{date('M d - H:i', strtotime($app->applied_time)) }}</td>
                                            <td class="text-right">
                                                <div class="text-danger text-center action-btn app-btn" data-id="{{$app->id}}" data-type="cancel">
                                                    <i class="fa fa-ban font-large" aria-hidden="true"></i>
                                                    <h6>Deny</h6>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody></table>
                                @else
                                    <div class="alert alert-danger alert-with-border" role="alert">No Data found!</div>
                                @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex py-2">
                                <h5 class="my-auto">Confirm Appointments</h5>
                                <input type="text" name="daterangepicker_confirm" class="form-control date-picker ml-auto">
                            </div>

                            <div class="card-scroll">
                                <div class="table-responsive" id="confirm_view">
                                @if ($appData->where('status', 1)->count()) 
                                    <table class="table"><tbody>
                                        @foreach ($appData->where('status', 1) as $app)
                                        <tr data-id="{{$app->id}}">
                                            <th class="d-flex">
                                                <figure class="avatar avatar-md mr-2">
                                                    <img src="{{$app->appointment->user->image() }}" class="rounded-circle" alt="image">
                                                </figure>
                                                <div class="my-auto">
                                                    {{$app->appointment->user->name}}
                                                    <p class="text-muted">{{$app->appointment->category->name}}</p>
                                                </div>
                                            </th>
                                            <td>{{date('M d - H:i', strtotime($app->applied_time)) }}</td>
                                            <td class="text-center">
                                                <a href="{{url('dashboard/chat/page')}}" class="text-center text-success action-btn">
                                                    <i class="fa fa-video-camera font-large"></i>
                                                    <h6>Start</h6>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody></table>
                                @else
                                    <div class="alert alert-danger alert-with-border" role="alert">No Data found!</div>
                                @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex py-2">
                                <h5 class="my-auto">Job Feed</h5>
                                <input type="text" name="daterangepicker_job" class="form-control date-picker ml-auto">
                            </div>

                            <div class="card-scroll" id="job_view">

                                @if ($jobData->count())
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <th scope="row" class="text-center">#</th>
                                            <th scope="row" class="text-center">Name</th>
                                            <th scope="row" class="text-center">Gender</th>
                                            <th scope="row" class="text-center">Category</th>
                                            <th scope="row" class="text-center">Availability</th>
                                            <th scope="row" class="text-center">Action</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($jobData as $id => $job)
                                            <tr>
                                                <th scope="row" class="text-center">{{$id + 1}}</th>
                                                <td>
                                                    <div class="d-flex">
                                                        <figure class="avatar avatar-md mr-2">
                                                            <img src="{{$job->user->image() }}" class="rounded-circle" alt="image">
                                                        </figure>
                                                        <div class="my-auto">
                                                            {{$job->user->name}}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{$job->user->gender}}</td>
                                                <td>{{$job->category->name}}</td>
                                                <td>{{date('H:i', strtotime($job->appointmentShift->start_time)) }} ~ {{date('H:i',strtotime($job->appointmentShift->end_time)) }}</td>
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <div class="text-success text-center action-btn job-btn mr-auto" data-id="{{$job->id}}" data-shift="{{$job->appointmentShift}}">
                                                            <i class="fa fa-check-circle-o font-large" aria-hidden="true"></i>
                                                            <h6>Accept</h6>
                                                        </div>

                                                        <div class="text-danger text-center action-btn app-btn ml-auto" data-id="{{$job->id}}" data-type="cancel_request">
                                                            <i class="fa fa-ban font-large" aria-hidden="true"></i>
                                                            <h6>Deny</h6>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                @else
                                <div class="alert alert-danger alert-with-border" role="alert">There is no available Data</div>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body text-center">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item text-center">
                            <img src="{{auth()->user()->image() }}" alt="" width="160">
                            <h3 class="text-primary mt-4">{{auth()->user()->name}}</h3>
                            <p>
                                @if (auth()->user()->categories)
                                {{auth()->user()->categories->name}}
                                @else
                                General
                                @endif
                            </p>
                        </li>
                        <li class="list-group-item text-left pt-4 px-0">
                            <h3 class="text-primary">{{$favouriteCount}} <small>Followers</small></h3>
                            <h6 class="pb-0">Appointments Limit</h6>
                            <div class="d-flex">
                                <div class="progress w-75 mt-1">
                                    <div class="progress-bar" role="progressbar" style="width: {{$favouriteCount/3}}%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                        {{round($favouriteCount/3, 1) }}%
                                    </div>
                                </div>
                                <p class="w-25 text-right">{{$favouriteCount}}/300</p>
                            </div>
                        </li>
                        <li class="list-group-item text-left pt-4 px-0">
                            <div class="row">
                                <div class="col-6">
                                    <h3 class="text-primary">{{$appCount}}</h3><p>Appointments</p>
                                </div>
                                <div class="col-6">
                                    <h3 class="text-primary">{{$postCount}}</h3><p>Posts</p>
                                </div>
                                <div class="col-6">
                                    <h3 class="text-primary">{{$friendCount}}</h3><p>Friends</p>
                                </div>
                                <div class="col-6">
                                    <h3 class="text-primary">{{$patientCount}}</h3><p>Patients</p>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item text-left pt-4 px-0">
                            <div class="row">
                                <div class="col-lg-12 col-md-6">
                                    <div class="card bg-primary text-center p-3" style="border-radius: 1rem">
                                        <blockquote class="blockquote mb-0 card-body">
                                            <h3>{{$callCount}}</h3>
                                            <h5>Missed Call</h5>
                                            <i class="width-30 height-30 fa fa-volume-control-phone" aria-hidden="true"></i>
                                        </blockquote>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-6">
                                    <div class="card border-primary text-center p-3" style="border-radius: 1rem">
                                        <blockquote class="blockquote mb-0 card-body">
                                            <h3>{{$messageCount}}</h3>
                                            <h5>New Messages</h5>
                                            <i class="width-30 height-30" data-feather="mail"></i>
                                        </blockquote>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="purposal_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Appointment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{ Form::open(array('id' => 'job_form')) }}
                <div class="modal-body">
                    {{ Form::hidden('shift_id','', ['class' => 'form-control']) }}
                    {{ Form::hidden('job_id','', ['class' => 'form-control']) }}
                    {{ Form::hidden('apply_date','', ['class' => 'form-control']) }}
                    {{ Form::hidden('action', 'store-appointment') }}
                    <div class="input-group mb-4" id="clockpicker">
                        <div class="input-group-prepend">
                          <span class="input-group-text">
                            <i class="fa fa-clock-o"></i>
                          </span>
                        </div>
                        {{ Form::text('apply_time','',['class' => 'form-control','id' => 'time']) }}
                    </div>
                    <div class="row form-group">
                        <div class="col-md-1 col-2">
                            <label><i class="fa fa-credit-card-alt fa-2x" aria-hidden="true"></i></label>
                        </div>
                        <div class="col-md-6 col-6">
                            UpFront payment
                        </div>
                        <div class="col-md-5 col-4 text-right">
                            <label class="switch">
                                <input type="checkbox" name="frontPayment">
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </div>
                    <div class="row payment-row" style="display:none;">
                        <div class="col-md-1 col-2"></div>
                        <div class="col-md-11 col-10">
                            {{ Form::text('paymentValue','',['class' => 'form-control','placeholder' => 'enter value here']) }}
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary save-job">Save</button>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</section>

@endsection

@section('script')
    <script>
        var isInitiate = 0;
        var job_row;
        var loading = '<div class="text-center"><div class="d-inline-flex"><div class="spinner-border text-primary mr-2" role="status"></div><div class="text-primary my-auto">Loading...</div></div></div>';
        var noData = '<div class="text-center text-danger">Server Error!</div>';

        $('input[name="daterangepicker_pending"]').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            minDate: new Date()
        }).on('change', function(e){
            var date = $('input[name="daterangepicker_pending"]').val();
            getView('pending', moment(date).format('YYYY-MM-DD'));
        });

        $('input[name="daterangepicker_confirm"]').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            minDate: new Date()
        }).on('change', function(e){
            var date = $('input[name="daterangepicker_confirm"]').val();
            getView('confirm', moment(date).format('YYYY-MM-DD'));
        });

        $('input[name="daterangepicker_job"]').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            minDate: new Date()
        }).on('change', function(e){
            var date = $('input[name="daterangepicker_job"]').val();
            getView('job', moment(date).format('YYYY-MM-DD'));
        });

        $(document).on('click', '.app-btn', function(){
            var id = $(this).data('id');
            var type = $(this).data('type');
            var clst = $(this).closest('tr');

            $.ajax({
                url: '/dashboard/appointment/get',
                type: 'get',
                dataType: 'json',
                data: {
                    'id': id,
                    'action': type
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

        $(document).on('click', '.job-btn', function(){
            var id = $(this).data('id');
            var shift = $(this).data('shift');
            job_row = $(this).closest('tr');
            
            if(isInitiate == '1'){
                $('#time').timepicker('destroy');
            }

            isInitiate = 1;

            $('input[name="apply_time"]').clockpicker({
                autoclose: true
            });

            $('#purposal_modal').find('input[name="shift_id"]').val(shift.id);
            $('#purposal_modal').find('input[name="job_id"]').val(id);
            $('#purposal_modal').find('input[name="apply_date"]').val(shift.date);
            $('#purposal_modal').find('input[name="apply_time"]').val('');
            $('#purposal_modal').modal({backdrop: 'static', keyboard: false},'show');
        });

        $(document).on('click', 'input[name="frontPayment"]', function(){ 
            $('input[name="frontPayment"]').val(this.checked);
            if (this.checked){
                $('.payment-row').show();
            } else {
                $('.payment-row').hide();
            }
        });

        $(document).on('submit', '#job_form', function(e){
            e.preventDefault();

            $.ajax({
                type: 'post',
                url: '/dashboard/jobs',
                data: new FormData(this),
                processData: false,
                cache: false,
                contentType: false,
                success: function(res) {
                    toastr.success('Successfully Created!');
                    job_row.remove();
                    $('#pending_view').html(res.view);
                    $('#purposal_modal').modal('hide');
                }, error: function(err) {
                    toastr.error('Something went wrong');
                }
            });
        });

        function getView(action, date) {
            $('#' + action + '_view').html(loading);

            $.ajax({
                url: '/dashboard/appointment/get',
                type:'get',
                dataType:'json',
                data:{
                    'date': date,
                    'action': action
                },
                success:function(res){
                    $('#' + action + '_view').html(res.view);
                },
                error: function(err) {
                    console.log(err);
                    $('#' + action + '_view').html(noData);
                }
            });
        }
    </script>
@endsection
