<div class="navigation">
    <div class="navigation-header">
        <span>Navigation</span>
        <a href="#">
            <i class="ti-close"></i>
        </a>
    </div>
    <div class="navigation-menu-body">
        <ul>
            <li>
                <a class="{{(isset($active) && $active == 'home') ? 'active ' : ''}}"  href="{{url('dashboard/home')}}">
                    <span class="nav-link-icon">
                        <i class="fa fa-columns"></i>
                    </span>
                    <span>Tableau de bord</span>
                </a>
            </li>

            @if (auth()->user()->user_type == '2')

            <li>
                <a class="{{(isset($active) && $active == 'find') ? 'active ' : ''}}" href="{{url('dashboard/jobs')}}">
                    <span class="nav-link-icon"><i class="fa fa-calendar-check-o"></i></span>
                    <span>Trouver un patient</span>
                </a>
            </li>

            <li>
                <a class="{{(isset($active) && $active == 'explore') ? 'active ' : ''}}" href="{{url('dashboard/explore')}}">
                    <span class="nav-link-icon"><i class="fa fa-calendar-check-o"></i></span>
                    <span>Doctor Explore</span>
                </a>
            </li>

            @else

            <li>
                <a class="{{(isset($active) && $active == 'create-appointment') ? 'active' : ''}}" href="{{url('dashboard/jobs/create')}}">
                    <span class="nav-link-icon"><i class="fa fa-rocket" aria-hidden="true"></i></span>
                    <span>Create</span>
                </a>
            </li>

            <li>
                <a class="{{(isset($active) && $active == 'explore') ? 'active ' : ''}}" href="{{url('dashboard/explore')}}">
                    <span class="nav-link-icon"><i class="fa fa-calendar-check-o"></i></span>
                    <span>Doctor Explore</span>
                </a>
            </li>

            @endif
            <li>
                <a href="#">
                    <span class="nav-link-icon">
                        <i class="fa fa-tasks" aria-hidden="true"></i>
                    </span>
                    <span>Appointments</span>
                </a>
                <ul>
                    <li>
                        <a class="{{(isset($active) && $active == 'tableView') ? 'active' : ''}}" href="{{url('dashboard/appointment/table')}}">
                            <span>Table</span>
                        </a>
                    </li>
                    <li>
                        <a class="{{(isset($active) && $active == 'calendarView') ? 'active' : ''}}" href="{{url('dashboard/appointment/calendar')}}">
                            <span>Calendar</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li>
                <a class="{{(isset($active) && $active == 'chat') ? 'active' : ''}}" href="{{url('dashboard/chat/page')}}">
                    <span class="nav-link-icon">
                        <i class="fa fa-comments"></i>
                    </span>
                    <span>Chats</span>
                    <span class="ml-auto" id="unread_chat_count">
                        @if (appMessages()->where('type', 'chat')->count())
                        <span class="badge badge-success">
                            {{appMessages()->where('type', 'chat')->count()}}
                        </span>
                        @endif
                    </span>
                </a>
            </li>
            <li>
                <a class="{{(isset($active) && $active == 'profile') ? 'active' : ''}}" href="{{url('dashboard/profile')}}">
                    <span class="nav-link-icon">
                        <i class="fa fa-file"></i>
                    </span>
                    <span>Préférence</span>
                </a>
            </li>
            <li>
                <a class="{{(isset($active) && $active == 'doctors') ? 'active' : ''}}" href="{{url('dashboard/user/doctors')}}">
                    <span class="nav-link-icon">
                        <i class="fa fa-book"></i>
                    </span>
                    <span>
                        @if (auth()->user()->user_type == 2)
                            Friends
                        @else
                            Doctors
                        @endif
                    </span>
                </a>
            </li>

            @if (auth()->user()->user_type == 3)

            <li>
                <a class="{{(isset($active) && $active == 'patients') ? 'active' : ''}}" href="{{url('dashboard/user/patients')}}">
                    <span class="nav-link-icon">
                        <i class="fa fa-user"></i>
                    </span>
                    <span>
                        Friends
                    </span>
                </a>
            </li>

            @endif
        </ul>
    </div>
</div>
