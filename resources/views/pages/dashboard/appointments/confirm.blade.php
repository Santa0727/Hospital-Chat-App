@extends('layouts.theme')

@section('page')
<div class="page-header">
    <div>
        <h3>Appointment</h3>
        <nav aria-label="breadcrumb" class="d-flex align-items-start">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="index.html">Home</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Appointments</li>
            </ol>
        </nav>
    </div>
</div>

{{-- <div class="card">
    <div class="card-body">
        <h6 class="card-title">Filtre Patient</h6>
        <form class="d-flex float-right">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search for Patients">
                <div class="input-group-append">
                    <button class="btn btn-outline-light" type="submit">
                        <i class="ti-search"></i>
                    </button>
                </div>
            </div>
        </form>
        <ul class="nav nav-pills mb-3" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="pills-3-tab" data-toggle="pill" href="#pills-3"
                   role="tab" aria-controls="pills-3" aria-selected="true" data-id="3">Voir tout</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-0-tab" data-toggle="pill" href="#pills-0"
                   role="tab" aria-controls="pills-0" aria-selected="false" data-id="0">En Visite</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-1-tab" data-toggle="pill" href="#pills-1"
                   role="tab" aria-controls="pills-1" aria-selected="false" data-id="1">Salle d'Attente</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-2-tab" data-toggle="pill" href="#pills-2"
                   role="tab" aria-controls="pills-2" aria-selected="false" data-id="2">Annulé</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade show active" id="pills-3" role="tabpanel" aria-labelledby="pills-3-tab">
                <div class="table-responsive">
                    <table class="table"><tbody>
                    @foreach ($appointments as $key => $appointment)
                    <tr>
                        <td class="d-flex">
                            @isset($appointment->appointment->user->profile_img)
                            <figure class="avatar avatar-md">
                                <img src="{{$appointment->appointment->user->profile_img}}" class="rounded-circle" alt="image">
                            </figure>
                            @else
                            <div class="avatar">
                                @switch($key % 6)
                                    @case(0)
                                        <span class="avatar-title bg-success rounded-circle">{{$appointment->appointment->user->name[0]}}</span>
                                        @break
                                    @case(1)
                                        <span class="avatar-title bg-warning rounded-circle">{{$appointment->appointment->user->name[0]}}</span>
                                        @break
                                    @case(2)
                                        <span class="avatar-title bg-primary rounded-circle">{{$appointment->appointment->user->name[0]}}</span>
                                        @break
                                    @case(3)
                                        <span class="avatar-title bg-danger rounded-circle">{{$appointment->appointment->user->name[0]}}</span>
                                        @break
                                    @case(4)
                                        <span class="avatar-title bg-info rounded-circle">{{$appointment->appointment->user->name[0]}}</span>
                                        @break
                                    @default
                                    <span class="avatar-title bg-secondary rounded-circle">{{$appointment->appointment->user->name[0]}}</span>
                                @endswitch
                            </div>
                            @endisset
                            <div class="my-auto ml-2">
                                <h6 class="mb-1" style="font-weight: 600">{{$appointment->appointment->user->name}}</h6>
                                <span class="text-muted">{{date('H:i',strtotime($appointment->applied_time))}}</span>
                            </div>
                        </td>
                        @switch($appointment->status)
                            @case('0')
                                <td class="my-auto">
                                    <div class="my-auto text-center">
                                        <div class="badge bg-warning-bright text-warning mb-1">Pending</div>
                                        <p>{{date('M d', strtotime($appointment->applied_date))}},&nbsp;{{date('H:i',strtotime($appointment->applied_time))}}</p>
                                    </div>
                                </td>
                                <td class="my-auto text-right">
                                    <button type="button" class="btn btn-outline-success btn-pulse mx-2 accept-btn" data-id="{{$appointment->id}}"><i class="ti-check-box"></i></button>
                                    <button type="button" class="btn btn-outline-danger btn-pulse mx-2 cancel-btn" data-id="{{$appointment->id}}"><i class="ti-trash"></i></button>
                                </td>
                                @break
                            @case('1')
                                <td class="my-auto">
                                    <div class="my-auto text-center">
                                        <div class="badge bg-success-bright text-success mb-1">Confirmed</div>
                                        <h6>{{date('M d', strtotime($appointment->applied_date))}},&nbsp;{{date('H:i',strtotime($appointment->applied_time))}}</h6>
                                    </div>
                                </td>
                                <td class="my-auto text-right">
                                    <button type="button" class="btn btn-outline-primary btn-pulse mx-2 chat-btn"><i class="fa fa-comments" aria-hidden="true"></i></button>
                                    <button type="button" class="btn btn-outline-success btn-pulse mx-2 video-btn"><i class="fa fa-video-camera" aria-hidden="true"></i></button>
                                </td>
                                @break
                            @default
                            <td class="my-auto">
                                <div class="my-auto text-center">
                                    <div class="badge bg-danger-bright text-danger mb-1">Cancelled</div>
                                    <p>{{date('M d', strtotime($appointment->applied_date))}},&nbsp;{{date('H:i',strtotime($appointment->applied_time))}}</p>
                                </div>
                            </td>
                            <td class="my-auto text-right">
                                <h6 class="text-danger"><i>Cancelled</i></h6>
                            </td>
                        @endswitch
                    </tr>
                    @endforeach
                    </tbody></table>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-0" role="tabpanel" aria-labelledby="pills-0-tab"></div>
            <div class="tab-pane fade" id="pills-1" role="tabpanel" aria-labelledby="pills-1-tab"></div>
            <div class="tab-pane fade" id="pills-2" role="tabpanel" aria-labelledby="pills-2-tab"></div>
        </div>

    </div>
</div> --}}
<div class="row no-gutters app-block">
    <div class="col-md-3 app-sidebar">
        <div class="app-sidebar-menu">
            <h5 class="font-weight-bold">Types</h5>
            <div>
                <div class="list-group list-group-flush">
                    <a href="#" class="list-group-item active d-flex align-items-center">
                        <i class="ti-list list-group-icon mr-2"></i>All
                    </a>

                    <a href="#" class="list-group-item">
                        <i class="fa fa-comment-o mr-2" aria-hidden="true"></i>Confirmed
                    </a>

                    <a href="#" class="list-group-item">
                        <i class="fa fa-hourglass-start mr-2"></i>Pending
                    </a>

                    <a href="#" class="list-group-item">
                        <i class="ti-trash list-group-icon mr-2"></i>Cancelled
                    </a>

                    <a href="#" class="list-group-item">
                        <i class="ti-heart list-group-icon mr-2"></i>Social
                    </a>
                </div>
            </div>

            <p class="mt-4 font-weight-bold">Tags</p>
            <div class="list-group list-group-flush">
                <a href="#" class="list-group-item d-flex align-items-center">
                    <span class="text-success fa fa-circle mr-2"></span>
                    Chats
                </a>

                <a href="#" class="list-group-item d-flex align-items-center">
                    <span class="text-danger fa fa-circle mr-2"></span>
                    Cancelled
                </a>

                <a href="#" class="list-group-item d-flex align-items-center">
                    <span class="text-warning fa fa-circle mr-2"></span>
                    Pending
                    <span class="small ml-auto">5</span>
                </a>

                <a href="#" class="list-group-item d-flex align-items-center">
                    <span class="text-info fa fa-circle mr-2"></span>
                    Friends
                </a>

                <a href="#" class="list-group-item d-flex align-items-center">
                    <span class="text-secondary fa fa-circle mr-2"></span>
                    Favorite
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-9 app-content">
        <h3 class="mb-4">Todo List</h3>
        <div class="app-action">
            <div class="action-left">
                <ul class="list-inline">
                    <li class="list-inline-item mb-0">
                        <a href="#" class="btn btn-outline-light dropdown-toggle" data-toggle="dropdown">
                            Filter
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Favourites</a>
                            <a class="dropdown-item" href="#">Done</a>
                            <a class="dropdown-item" href="#">Deleted</a>
                        </div>
                    </li>
                    <li class="list-inline-item mb-0">
                        <a href="#" class="btn btn-outline-light dropdown-toggle" data-toggle="dropdown">
                            Sort
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Ascending</a>
                            <a class="dropdown-item" href="#">Descending</a>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="action-right">
                <form class="d-flex mr-3">
                    <a href="#" class="app-sidebar-menu-button btn btn-outline-light">
                        <i data-feather="menu" class="width-15 height-15"></i>
                    </a>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Task search"
                               aria-describedby="button-addon1">
                        <div class="input-group-append">
                            <button class="btn btn-outline-light" type="button" id="button-addon1">
                                <i class="ti-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
                <div class="app-pager d-flex align-items-center">
                    <div class="mr-3">1-50 of 253</div>
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Previous">
                                    <i class="ti-angle-left"></i>
                                </a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Next">
                                    <i class="ti-angle-right"></i>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <div class="card card-body app-content-body">
            <div class="app-lists">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item task-list">
                        <div class="mr-3">
                            <a href="#" class="app-sortable-handle">
                                <i class="ti-line-double"></i>
                            </a>
                        </div>
                        <div>
                            <div class="custom-control custom-checkbox custom-checkbox-success mr-2">
                                <input type="checkbox" class="custom-control-input" id="customCheck1">
                                <label class="custom-control-label" for="customCheck1"></label>
                            </div>
                        </div>
                        <div>
                            <a href="#" class="add-star mr-3" title="Add stars">
                                <i class="fa fa-star-o font-size-16"></i>
                            </a>
                        </div>
                        <div class="flex-grow-1 min-width-0">
                            <div class="mb-1 d-flex align-items-center justify-content-between">
                                <div class="app-list-title text-truncate">How To Protect Your Computer Very
                                    Useful Tips
                                </div>
                                <div class="pl-3 d-flex align-items-center">
                                    <div class="mr-3 d-sm-inline d-none">
                                        <div class="badge bg-danger-bright text-danger">Social</div>
                                    </div>
                                    <div class="mr-3 d-sm-inline d-none">
                                        <div class="avatar-group">
                                            <figure class="avatar avatar-sm" title="Lisle Essam"
                                                    data-toggle="tooltip">
                                                <img src="../../theme/media/image/user/women_avatar2.jpg"
                                                     class="rounded-circle"
                                                     alt="image">
                                            </figure>
                                            <figure class="avatar avatar-sm" title="Baxie Roseblade"
                                                    data-toggle="tooltip">
                                                <img src="../../theme/media/image/user/man_avatar5.jpg"
                                                     class="rounded-circle"
                                                     alt="image">
                                            </figure>
                                            <figure class="avatar avatar-sm" title="Mella Mixter"
                                                    data-toggle="tooltip">
                                                <img src="../../theme/media/image/user/women_avatar1.jpg"
                                                     class="rounded-circle"
                                                     alt="image">
                                            </figure>
                                            <figure class="avatar avatar-sm" title="Jo Hugill"
                                                    data-toggle="tooltip">
                                                <img src="../../theme/media/image/user/man_avatar1.jpg"
                                                     class="rounded-circle"
                                                     alt="image">
                                            </figure>
                                            <figure class="avatar avatar-sm" title="Cullie Philcott"
                                                    data-toggle="tooltip">
                                                <img src="../../theme/media/image/user/women_avatar5.jpg"
                                                     class="rounded-circle"
                                                     alt="image">
                                            </figure>
                                        </div>
                                    </div>
                                    <div class="dropdown">
                                        <a href="#" class="btn btn-floating btn-sm" data-toggle="dropdown">
                                            <i class="ti-more-alt"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#">Edit</a>
                                            <a class="dropdown-item" href="#">Clone</a>
                                            <a class="dropdown-item" href="#">Make an assignment</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item text-danger" href="#">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item task-list">
                        <div class="mr-3">
                            <a href="#" class="app-sortable-handle">
                                <i class="ti-line-double"></i>
                            </a>
                        </div>
                        <div>
                            <div class="custom-control custom-checkbox custom-checkbox-success mr-2">
                                <input type="checkbox" class="custom-control-input" id="customCheck2">
                                <label class="custom-control-label" for="customCheck2"></label>
                            </div>
                        </div>
                        <div>
                            <a href="#" class="add-star mr-3" title="Add stars">
                                <i class="fa fa-star font-size-16 text-warning"></i>
                            </a>
                        </div>
                        <div class="flex-grow-1 min-width-0">
                            <div class="mb-1 d-flex align-items-center justify-content-between">
                                <div class="app-list-title text-truncate">How Hypnosis Can Help You
                                </div>
                                <div class="pl-3 d-flex align-items-center">
                                    <div class="mr-3 d-sm-inline d-none">
                                        <div class="badge bg-warning-bright text-warning">Theme Support</div>
                                    </div>
                                    <div class="mr-3 d-sm-inline d-none">
                                        <div class="avatar-group">
                                            <figure class="avatar avatar-sm" title="Baxie Roseblade"
                                                    data-toggle="tooltip">
                                                <img src="../../theme/media/image/user/man_avatar5.jpg"
                                                     class="rounded-circle"
                                                     alt="image">
                                            </figure>
                                            <figure class="avatar avatar-sm" title="Mella Mixter"
                                                    data-toggle="tooltip">
                                                <img src="../../theme/media/image/user/women_avatar1.jpg"
                                                     class="rounded-circle"
                                                     alt="image">
                                            </figure>
                                            <figure class="avatar avatar-sm" title="Jo Hugill"
                                                    data-toggle="tooltip">
                                                <img src="../../theme/media/image/user/man_avatar1.jpg"
                                                     class="rounded-circle"
                                                     alt="image">
                                            </figure>
                                            <figure class="avatar avatar-sm" title="Cullie Philcott"
                                                    data-toggle="tooltip">
                                                <img src="../../theme/media/image/user/women_avatar5.jpg"
                                                     class="rounded-circle"
                                                     alt="image">
                                            </figure>
                                        </div>
                                    </div>
                                    <div class="dropdown">
                                        <a href="#" class="btn btn-floating btn-sm" data-toggle="dropdown">
                                            <i class="ti-more-alt"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#">Edit</a>
                                            <a class="dropdown-item" href="#">Clone</a>
                                            <a class="dropdown-item" href="#">Make an assignment</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item text-danger" href="#">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item task-list">
                        <div class="mr-3">
                            <a href="#" class="app-sortable-handle">
                                <i class="ti-line-double"></i>
                            </a>
                        </div>
                        <div>
                            <div class="custom-control custom-checkbox custom-checkbox-success mr-2">
                                <input type="checkbox" class="custom-control-input" id="customCheck3">
                                <label class="custom-control-label" for="customCheck3"></label>
                            </div>
                        </div>
                        <div>
                            <a href="#" class="add-star mr-3" title="Add stars">
                                <i class="fa fa-star font-size-16 text-warning"></i>
                            </a>
                        </div>
                        <div class="flex-grow-1 min-width-0">
                            <div class="mb-1 d-flex align-items-center justify-content-between">
                                <div class="app-list-title text-truncate">Dealing With Technical Support 10
                                    Useful Tips
                                </div>
                                <div class="pl-3 d-flex align-items-center">
                                    <div class="mr-3 d-sm-inline d-none">
                                        <div class="badge bg-info-bright text-info">Friends</div>
                                    </div>
                                    <div class="mr-3 d-sm-inline d-none">
                                        <div class="avatar-group">
                                            <div class="avatar avatar-sm" title="Polly Everist"
                                                 data-toggle="tooltip">
                                                <span class="avatar-title bg-primary rounded-circle">P</span>
                                            </div>
                                            <div class="avatar avatar-sm" title="Godwin Adanez"
                                                 data-toggle="tooltip">
                                                <span class="avatar-title bg-success rounded-circle">G</span>
                                            </div>
                                            <figure class="avatar avatar-sm" title="Lisle Essam"
                                                    data-toggle="tooltip">
                                                <img src="../../theme/media/image/user/women_avatar2.jpg"
                                                     class="rounded-circle"
                                                     alt="image">
                                            </figure>
                                            <figure class="avatar avatar-sm" title="Baxie Roseblade"
                                                    data-toggle="tooltip">
                                                <img src="../../theme/media/image/user/man_avatar5.jpg"
                                                     class="rounded-circle"
                                                     alt="image">
                                            </figure>
                                            <figure class="avatar avatar-sm" title="Mella Mixter"
                                                    data-toggle="tooltip">
                                                <img src="../../theme/media/image/user/women_avatar1.jpg"
                                                     class="rounded-circle"
                                                     alt="image">
                                            </figure>
                                            <figure class="avatar avatar-sm" title="Jo Hugill"
                                                    data-toggle="tooltip">
                                                <img src="../../theme/media/image/user/man_avatar1.jpg"
                                                     class="rounded-circle"
                                                     alt="image">
                                            </figure>
                                            <figure class="avatar avatar-sm" title="Cullie Philcott"
                                                    data-toggle="tooltip">
                                                <img src="../../theme/media/image/user/women_avatar5.jpg"
                                                     class="rounded-circle"
                                                     alt="image">
                                            </figure>
                                        </div>
                                    </div>
                                    <div class="dropdown">
                                        <a href="#" class="btn btn-floating btn-sm" data-toggle="dropdown">
                                            <i class="ti-more-alt"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#">Edit</a>
                                            <a class="dropdown-item" href="#">Clone</a>
                                            <a class="dropdown-item" href="#">Make an assignment</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item text-danger" href="#">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item task-list">
                        <div class="mr-3">
                            <a href="#" class="app-sortable-handle">
                                <i class="ti-line-double"></i>
                            </a>
                        </div>
                        <div>
                            <div class="custom-control custom-checkbox custom-checkbox-success mr-2">
                                <input type="checkbox" class="custom-control-input" id="customCheck4">
                                <label class="custom-control-label" for="customCheck4"></label>
                            </div>
                        </div>
                        <div>
                            <a href="#" class="add-star mr-3" title="Add stars">
                                <i class="fa fa-star-o font-size-16"></i>
                            </a>
                        </div>
                        <div class="flex-grow-1 min-width-0">
                            <div class="mb-1 d-flex align-items-center justify-content-between">
                                <div class="app-list-title text-truncate">Get The Boot A Birds Eye Look Into
                                    Mcse Boot Camps
                                </div>
                                <div class="pl-3 d-flex align-items-center">
                                    <div class="mr-3 d-sm-inline d-none">
                                        <div class="badge bg-warning-bright text-warning">Social</div>
                                    </div>
                                    <div class="mr-3 d-sm-inline d-none">
                                        <div class="avatar-group">
                                            <div class="avatar avatar-sm" title="Godwin Adanez"
                                                 data-toggle="tooltip">
                                                <span class="avatar-title bg-success rounded-circle">G</span>
                                            </div>
                                            <figure class="avatar avatar-sm" title="Lisle Essam"
                                                    data-toggle="tooltip">
                                                <img src="../../theme/media/image/user/women_avatar2.jpg"
                                                     class="rounded-circle"
                                                     alt="image">
                                            </figure>
                                        </div>
                                    </div>
                                    <div class="dropdown">
                                        <a href="#" class="btn btn-floating btn-sm" data-toggle="dropdown">
                                            <i class="ti-more-alt"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#">Edit</a>
                                            <a class="dropdown-item" href="#">Clone</a>
                                            <a class="dropdown-item" href="#">Make an assignment</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item text-danger" href="#">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item task-list">
                        <div class="mr-3">
                            <a href="#" class="app-sortable-handle">
                                <i class="ti-line-double"></i>
                            </a>
                        </div>
                        <div>
                            <div class="custom-control custom-checkbox custom-checkbox-success mr-2">
                                <input type="checkbox" class="custom-control-input" id="customCheck5">
                                <label class="custom-control-label" for="customCheck5"></label>
                            </div>
                        </div>
                        <div>
                            <a href="#" class="add-star mr-3" title="Add stars">
                                <i class="fa fa-star-o font-size-16"></i>
                            </a>
                        </div>
                        <div class="flex-grow-1 min-width-0">
                            <div class="mb-1 d-flex align-items-center justify-content-between">
                                <div class="app-list-title text-truncate">Buying Used Electronic Test
                                    Equipment.
                                </div>
                                <div class="pl-3 d-flex align-items-center">
                                    <div class="mr-3 d-sm-inline d-none">
                                        <div class="badge bg-success-bright text-success">Freelance</div>
                                    </div>
                                    <div class="mr-3 d-sm-inline d-none">
                                        <div class="avatar-group">
                                            <div class="avatar avatar-sm" title="Polly Everist"
                                                 data-toggle="tooltip">
                                                <span class="avatar-title bg-primary rounded-circle">P</span>
                                            </div>
                                            <div class="avatar avatar-sm" title="Godwin Adanez"
                                                 data-toggle="tooltip">
                                                <span class="avatar-title bg-success rounded-circle">G</span>
                                            </div>
                                            <figure class="avatar avatar-sm" title="Lisle Essam"
                                                    data-toggle="tooltip">
                                                <img src="../../theme/media/image/user/women_avatar2.jpg"
                                                     class="rounded-circle"
                                                     alt="image">
                                            </figure>
                                            <figure class="avatar avatar-sm" title="Baxie Roseblade"
                                                    data-toggle="tooltip">
                                                <img src="../../theme/media/image/user/man_avatar5.jpg"
                                                     class="rounded-circle"
                                                     alt="image">
                                            </figure>
                                            <figure class="avatar avatar-sm" title="Mella Mixter"
                                                    data-toggle="tooltip">
                                                <img src="../../theme/media/image/user/women_avatar1.jpg"
                                                     class="rounded-circle"
                                                     alt="image">
                                            </figure>
                                        </div>
                                    </div>
                                    <div class="dropdown">
                                        <a href="#" class="btn btn-floating btn-sm" data-toggle="dropdown">
                                            <i class="ti-more-alt"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#">Edit</a>
                                            <a class="dropdown-item" href="#">Clone</a>
                                            <a class="dropdown-item" href="#">Make an assignment</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item text-danger" href="#">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item task-list">
                        <div class="mr-3">
                            <a href="#" class="app-sortable-handle">
                                <i class="ti-line-double"></i>
                            </a>
                        </div>
                        <div>
                            <div class="custom-control custom-checkbox custom-checkbox-success mr-2">
                                <input type="checkbox" class="custom-control-input" id="customCheck6">
                                <label class="custom-control-label" for="customCheck6"></label>
                            </div>
                        </div>
                        <div>
                            <a href="#" class="add-star mr-3" title="Add stars">
                                <i class="fa fa-star-o font-size-16"></i>
                            </a>
                        </div>
                        <div class="flex-grow-1 min-width-0">
                            <div class="mb-1 d-flex align-items-center justify-content-between">
                                <div class="app-list-title text-truncate">Fix Responsiveness
                                </div>
                                <div class="pl-3 d-flex align-items-center">
                                    <div class="mr-3 d-sm-inline d-none">
                                        <div class="badge bg-warning-bright text-warning">Theme Support</div>
                                    </div>
                                    <div class="mr-3 d-sm-inline d-none">
                                        <div class="avatar-group">
                                            <div class="avatar avatar-sm" title="Godwin Adanez"
                                                 data-toggle="tooltip">
                                                <span class="avatar-title bg-warning rounded-circle">G</span>
                                            </div>
                                            <div class="avatar avatar-sm" title="Polly Everist"
                                                 data-toggle="tooltip">
                                                <span class="avatar-title bg-info rounded-circle">P</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="dropdown">
                                        <a href="#" class="btn btn-floating btn-sm" data-toggle="dropdown">
                                            <i class="ti-more-alt"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#">Edit</a>
                                            <a class="dropdown-item" href="#">Clone</a>
                                            <a class="dropdown-item" href="#">Make an assignment</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item text-danger" href="#">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item task-list">
                        <div class="mr-3">
                            <a href="#" class="app-sortable-handle">
                                <i class="ti-line-double"></i>
                            </a>
                        </div>
                        <div>
                            <div class="custom-control custom-checkbox custom-checkbox-success mr-2">
                                <input type="checkbox" class="custom-control-input" id="customCheck7">
                                <label class="custom-control-label" for="customCheck7"></label>
                            </div>
                        </div>
                        <div>
                            <a href="#" class="add-star mr-3" title="Add stars">
                                <i class="fa fa-star font-size-16 text-warning"></i>
                            </a>
                        </div>
                        <div class="flex-grow-1 min-width-0">
                            <div class="mb-1 d-flex align-items-center justify-content-between">
                                <div class="app-list-title text-truncate">
                                    Hypnotherapy For Motivation Getting The Drive Back
                                </div>
                                <div class="pl-3 d-flex align-items-center">
                                    <div class="mr-3 d-sm-inline d-none">
                                        <div class="badge bg-secondary-bright text-secondary">Coding</div>
                                    </div>
                                    <div class="mr-3 d-sm-inline d-none">
                                        <div class="avatar-group">
                                            <figure class="avatar avatar-sm" title="Baxie Roseblade"
                                                    data-toggle="tooltip">
                                                <img src="../../theme/media/image/user/man_avatar5.jpg"
                                                     class="rounded-circle"
                                                     alt="image">
                                            </figure>
                                        </div>
                                    </div>
                                    <div class="dropdown">
                                        <a href="#" class="btn btn-floating btn-sm" data-toggle="dropdown">
                                            <i class="ti-more-alt"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#">Edit</a>
                                            <a class="dropdown-item" href="#">Clone</a>
                                            <a class="dropdown-item" href="#">Make an assignment</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item text-danger" href="#">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item task-list">
                        <div class="mr-3">
                            <a href="#" class="app-sortable-handle">
                                <i class="ti-line-double"></i>
                            </a>
                        </div>
                        <div>
                            <div class="custom-control custom-checkbox custom-checkbox-success mr-2">
                                <input type="checkbox" class="custom-control-input" id="customCheck8">
                                <label class="custom-control-label" for="customCheck8"></label>
                            </div>
                        </div>
                        <div>
                            <a href="#" class="add-star mr-3" title="Add stars">
                                <i class="fa fa-star-o font-size-16"></i>
                            </a>
                        </div>
                        <div class="flex-grow-1 min-width-0">
                            <div class="mb-1 d-flex align-items-center justify-content-between">
                                <div class="app-list-title text-truncate">Are You Struggling In Life
                                </div>
                                <div class="pl-3 d-flex align-items-center">
                                    <div class="mr-3 d-sm-inline d-none">
                                        <div class="badge bg-warning-bright text-warning">Theme Support</div>
                                    </div>
                                    <div class="mr-3">
                                        <div class="avatar-group">
                                            <div class="avatar avatar-sm" title="Polly Everist"
                                                 data-toggle="tooltip">
                                                <span class="avatar-title bg-primary rounded-circle">P</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="dropdown">
                                        <a href="#" class="btn btn-floating btn-sm" data-toggle="dropdown">
                                            <i class="ti-more-alt"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#">Edit</a>
                                            <a class="dropdown-item" href="#">Clone</a>
                                            <a class="dropdown-item" href="#">Make an assignment</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item text-danger" href="#">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item task-list">
                        <div class="mr-3">
                            <a href="#" class="app-sortable-handle">
                                <i class="ti-line-double"></i>
                            </a>
                        </div>
                        <div>
                            <div class="custom-control custom-checkbox custom-checkbox-success mr-2">
                                <input type="checkbox" class="custom-control-input" id="customCheck9">
                                <label class="custom-control-label" for="customCheck9"></label>
                            </div>
                        </div>
                        <div>
                            <a href="#" class="add-star mr-3" title="Add stars">
                                <i class="fa fa-star-o font-size-16"></i>
                            </a>
                        </div>
                        <div class="flex-grow-1 min-width-0">
                            <div class="mb-1 d-flex align-items-center justify-content-between">
                                <div class="app-list-title text-truncate">Believing Is The Absence Of Doubt
                                </div>
                                <div class="pl-3 d-flex align-items-center">
                                    <div class="mr-3 d-sm-inline d-none">
                                        <div class="badge bg-success-bright text-success">Freelance</div>
                                    </div>
                                    <div class="mr-3 d-sm-inline d-none">
                                        <div class="avatar-group">
                                            <figure class="avatar avatar-sm" title="Lisle Essam"
                                                    data-toggle="tooltip">
                                                <img src="../../theme/media/image/user/women_avatar2.jpg"
                                                     class="rounded-circle"
                                                     alt="image">
                                            </figure>
                                            <figure class="avatar avatar-sm" title="Baxie Roseblade"
                                                    data-toggle="tooltip">
                                                <img src="../../theme/media/image/user/man_avatar5.jpg"
                                                     class="rounded-circle"
                                                     alt="image">
                                            </figure>
                                            <figure class="avatar avatar-sm" title="Mella Mixter"
                                                    data-toggle="tooltip">
                                                <img src="../../theme/media/image/user/women_avatar1.jpg"
                                                     class="rounded-circle"
                                                     alt="image">
                                            </figure>
                                        </div>
                                    </div>
                                    <div class="dropdown">
                                        <a href="#" class="btn btn-floating btn-sm" data-toggle="dropdown">
                                            <i class="ti-more-alt"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#">Edit</a>
                                            <a class="dropdown-item" href="#">Clone</a>
                                            <a class="dropdown-item" href="#">Make an assignment</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item text-danger" href="#">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item task-list">
                        <div class="mr-3">
                            <a href="#" class="app-sortable-handle">
                                <i class="ti-line-double"></i>
                            </a>
                        </div>
                        <div>
                            <div class="custom-control custom-checkbox custom-checkbox-success mr-2">
                                <input type="checkbox" class="custom-control-input" id="customCheck10">
                                <label class="custom-control-label" for="customCheck10"></label>
                            </div>
                        </div>
                        <div>
                            <a href="#" class="add-star mr-3" title="Add stars">
                                <i class="fa fa-star-o font-size-16"></i>
                            </a>
                        </div>
                        <div class="flex-grow-1 min-width-0">
                            <div class="mb-1 d-flex align-items-center justify-content-between">
                                <div class="app-list-title text-truncate">Success Steps For Your Personal Or
                                    Business Life
                                </div>
                                <div class="pl-3 d-flex align-items-center">
                                    <div class="mr-3 d-sm-inline d-none">
                                        <div class="badge bg-danger-bright text-danger">Social</div>
                                    </div>
                                    <div class="mr-3 d-sm-inline d-none">
                                        <div class="avatar-group">
                                            <figure class="avatar avatar-sm" title="Mella Mixter"
                                                    data-toggle="tooltip">
                                                <img src="../../theme/media/image/user/women_avatar1.jpg"
                                                     class="rounded-circle"
                                                     alt="image">
                                            </figure>
                                            <div class="avatar avatar-sm" title="Polly Everist"
                                                 data-toggle="tooltip">
                                                <span class="avatar-title bg-primary rounded-circle">P</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="dropdown">
                                        <a href="#" class="btn btn-floating btn-sm" data-toggle="dropdown">
                                            <i class="ti-more-alt"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#">Edit</a>
                                            <a class="dropdown-item" href="#">Clone</a>
                                            <a class="dropdown-item" href="#">Make an assignment</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item text-danger" href="#">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item task-list">
                        <div class="mr-3">
                            <a href="#" class="app-sortable-handle">
                                <i class="ti-line-double"></i>
                            </a>
                        </div>
                        <div>
                            <div class="custom-control custom-checkbox custom-checkbox-success mr-2">
                                <input type="checkbox" class="custom-control-input" id="customCheck11">
                                <label class="custom-control-label" for="customCheck11"></label>
                            </div>
                        </div>
                        <div>
                            <a href="#" class="add-star mr-3" title="Add stars">
                                <i class="fa fa-star-o font-size-16"></i>
                            </a>
                        </div>
                        <div class="flex-grow-1 min-width-0">
                            <div class="mb-1 d-flex align-items-center justify-content-between">
                                <div class="app-list-title text-truncate">Don't Let The Outtakes Take You
                                    Out
                                </div>
                                <div class="pl-3 d-flex align-items-center">
                                    <div class="mr-3 d-sm-inline d-none">
                                        <div class="badge bg-warning-bright text-warning">Theme Support</div>
                                    </div>
                                    <div class="mr-3">
                                        <div class="avatar-group">
                                            <div class="avatar avatar-sm" title="Godwin Adanez"
                                                 data-toggle="tooltip">
                                                <span class="avatar-title bg-success rounded-circle">G</span>
                                            </div>
                                            <figure class="avatar avatar-sm" title="Lisle Essam"
                                                    data-toggle="tooltip">
                                                <img src="../../theme/media/image/user/women_avatar2.jpg"
                                                     class="rounded-circle"
                                                     alt="image">
                                            </figure>
                                        </div>
                                    </div>
                                    <div class="dropdown">
                                        <a href="#" class="btn btn-floating btn-sm" data-toggle="dropdown">
                                            <i class="ti-more-alt"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#">Edit</a>
                                            <a class="dropdown-item" href="#">Clone</a>
                                            <a class="dropdown-item" href="#">Make an assignment</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item text-danger" href="#">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item task-list">
                        <div class="mr-3">
                            <a href="#" class="app-sortable-handle">
                                <i class="ti-line-double"></i>
                            </a>
                        </div>
                        <div>
                            <div class="custom-control custom-checkbox custom-checkbox-success mr-2">
                                <input type="checkbox" class="custom-control-input" id="customCheck12">
                                <label class="custom-control-label" for="customCheck12"></label>
                            </div>
                        </div>
                        <div>
                            <a href="#" class="add-star mr-3" title="Add stars">
                                <i class="fa fa-star-o font-size-16"></i>
                            </a>
                        </div>
                        <div class="flex-grow-1 min-width-0">
                            <div class="mb-1 d-flex align-items-center justify-content-between">
                                <div class="app-list-title text-truncate">It is a good idea to think of your
                                    PC as an office.
                                </div>
                                <div class="pl-3 d-flex align-items-center">
                                    <div class="mr-3 d-sm-inline d-none">
                                        <div class="badge bg-warning-bright text-warning">Theme Support</div>
                                    </div>
                                    <div class="mr-3 d-sm-inline d-none">
                                        <div class="avatar-group">
                                            <div class="avatar avatar-sm" title="Godwin Adanez"
                                                 data-toggle="tooltip">
                                                <span class="avatar-title bg-success rounded-circle">G</span>
                                            </div>
                                            <figure class="avatar avatar-sm" title="Lisle Essam"
                                                    data-toggle="tooltip">
                                                <img src="../../theme/media/image/user/women_avatar2.jpg"
                                                     class="rounded-circle"
                                                     alt="image">
                                            </figure>
                                            <figure class="avatar avatar-sm" title="Baxie Roseblade"
                                                    data-toggle="tooltip">
                                                <img src="../../theme/media/image/user/man_avatar5.jpg"
                                                     class="rounded-circle"
                                                     alt="image">
                                            </figure>
                                            <figure class="avatar avatar-sm" title="Mella Mixter"
                                                    data-toggle="tooltip">
                                                <img src="../../theme/media/image/user/women_avatar1.jpg"
                                                     class="rounded-circle"
                                                     alt="image">
                                            </figure>
                                            <div class="avatar avatar-sm" title="Polly Everist"
                                                 data-toggle="tooltip">
                                                <span class="avatar-title bg-primary rounded-circle">P</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="dropdown">
                                        <a href="#" class="btn btn-floating btn-sm" data-toggle="dropdown">
                                            <i class="ti-more-alt"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#">Edit</a>
                                            <a class="dropdown-item" href="#">Clone</a>
                                            <a class="dropdown-item" href="#">Make an assignment</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item text-danger" href="#">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <!-- end::app-lists -->

            <!-- begin:app-detail -->
            <div class="card app-detail">
                <div class="card-header">
                    <div class="app-detail-action-left align-items-center">
                        <a class="app-detail-close-button btn btn-outline-light mr-3" href="#">
                            <i class="ti-arrow-left"></i>
                        </a>
                        <h5 class="mb-0">Draw design and presentation for customers. </h5>
                    </div>
                    <div class="app-detail-action-right">
                        <div>
                            <a href="#" class="btn btn-success" data-toggle="tooltip"
                               title="2:44 AM">
                                <i class="ti-check mr-2"></i>
                                Completed
                            </a>
                            <span data-toggle="modal" data-target="#editTaskModal">
                                    <a href="#" class="btn btn-outline-light ml-2" title="Edit Task"
                                       data-toggle="tooltip">
                                        <i class="ti-pencil"></i>
                                    </a>
                                </span>
                            <a href="#" class="btn btn-outline-light ml-2" data-toggle="tooltip"
                               title="Delete Task">
                                <i class="ti-trash"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="app-detail-article">
                    <div class="card-body">
                        <div class="d-flex align-items-center p-l-r-0 m-b-20">
                            <div class="d-flex align-items-center">
                                <div class="avatar-group">
                                    <div class="avatar avatar-sm" title="Polly Everist"
                                         data-toggle="tooltip">
                                        <span class="avatar-title bg-primary rounded-circle">P</span>
                                    </div>
                                    <div class="avatar avatar-sm" title="Godwin Adanez"
                                         data-toggle="tooltip">
                                        <span class="avatar-title bg-success rounded-circle">G</span>
                                    </div>
                                    <figure class="avatar avatar-sm" title="Lisle Essam"
                                            data-toggle="tooltip">
                                        <img src="../../theme/media/image/user/women_avatar2.jpg"
                                             class="rounded-circle"
                                             alt="image">
                                    </figure>
                                    <figure class="avatar avatar-sm" title="Baxie Roseblade"
                                            data-toggle="tooltip">
                                        <img src="../../theme/media/image/user/man_avatar5.jpg"
                                             class="rounded-circle"
                                             alt="image">
                                    </figure>
                                    <figure class="avatar avatar-sm" title="Mella Mixter"
                                            data-toggle="tooltip">
                                        <img src="../../theme/media/image/user/women_avatar1.jpg"
                                             class="rounded-circle"
                                             alt="image">
                                    </figure>
                                </div>
                            </div>
                            <div class="ml-auto">
                                <span class="badge bg-warning-bright text-warning badge-pill mr-2">Theme Support</span>
                                <a href="#" data-toggle="tooltip" title="Files" class="mr-2">
                                    <i class="fa fa-paperclip"></i>
                                </a>
                                <a href="#" class="mr-2">
                                    <i class="fa fa-star font-size-16 text-warning"></i>
                                </a>
                                <span class="text-muted">4:14 AM</span>
                            </div>
                        </div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consectetur corporis
                            incidunt labore modi numquam omnis pariatur possimus suscipit vitae
                            voluptas?</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi aperiam
                            asperiores
                            error esse fugiat fugit laboriosam necessitatibus officia, placeat, quam quis
                            reprehenderit similique soluta suscipit tempore! Consequuntur eligendi hic in
                            libero
                            nostrum rem ut? At itaque laboriosam natus provident reprehenderit.</p>
                    </div>
                    <hr class="m-0">
                    <div class="card-body">
                        <h6 class="mb-3 font-size-11 text-uppercase">Files</h6>
                        <ul class="list-unstyled mb-0">
                            <li class="small">
                                <a href="#">
                                    <i data-feather="paperclip" class="mr-1 width-15 height-15"></i>
                                    uikit-design.psd
                                </a>
                            </li>
                            <li class="small">
                                <a href="#">
                                    <i data-feather="paperclip" class="mr-1 width-15 height-15"></i>
                                    uikit-design.sketch
                                </a>
                            </li>
                        </ul>
                    </div>
                    <hr class="m-0">
                    <div class="card-body">
                        <h6 class="mb-3 font-size-11 text-uppercase">Comment</h6>
                        <div class="reply-email-quill-editor mb-3"></div>
                        <div class="d-flex justify-content-between">
                            <div class="reply-email-quill-toolbar">
                                    <span class="ql-formats mr-0">
                                      <button class="ql-bold"></button>
                                      <button class="ql-italic"></button>
                                      <button class="ql-underline"></button>
                                      <button class="ql-link"></button>
                                      <button class="ql-image"></button>
                                    </span>
                            </div>
                            <button class="btn btn-primary">Send</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    var type = 3;

    $(document).on('click','.nav-link',function(){
        type = $(this).data('id');
        getTabView(type);
    });

    $(document).on('click','.cancel-btn',function(){
        var id   = $(this).data('id');
        var action = 2;
        getTabView();
    });

    $(document).on('click','.accept-btn',function(){
        var id   = $(this).data('id');
        var action = 1;
        getView(id, action);
    });

    function getView(id, action) {
        $.ajax({
            url: "appointment/view",
            type:'post',
            dataType:'json',
            data:{
                'id' : id,
                'type' : type,
                'action' : action
            },
            success:function(res){
                if (action == 2) {
                    toastr.success('Appoiintment cancelled!');
                } else {
                    toastr.success('Appoiintment accepted!');
                }
                $('#pills-' + type).html(res.view);
            }
        })
    }

    function getTabView(type) {
        $.ajax({
            url: "appointment/view",
            type: 'post',
            dataType: 'json',
            data: { 'type': type },
            success: function(res) {
                $('#pills-' + type).html(res.view);
            },
            error: function(err) {console.log(err)}
        });
    }
</script>
@endsection