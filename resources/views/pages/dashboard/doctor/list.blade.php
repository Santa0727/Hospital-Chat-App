@extends('layouts.theme')

@section('style')
<style>
    .bg-back {
        background-color: #f4f5fd;
    }
    .like-tab {
        position: absolute;
        border-radius: 0 1rem 1rem 0;
        padding: .4rem;
        top: 16px;
        cursor: pointer;
    }
    .like-tab:hover .fa-heart.text-white {
        color: #ff3e6c !important;
    }
    .like-tab:hover .fa-heart.text-danger {
        color: white !important;
    }
    .arrow-icons i {
        font-size: 1.6rem;
        color: lightgrey;
        cursor: pointer;
        background: transparent;
        border-radius: 50%;
        padding: 0 .5rem;
    }
    .arrow-icons i:hover {
        background: rgba(0, 0, 0, .1);
    }
    .arrow-icons i.active {
        color:  grey
    }
    .friend-tab {
        position: absolute;
        border-radius: 1rem 0 0 1rem;
        padding: .4rem;
        top: 16px;
        right: 0;
        background: 
    }
</style>
@endsection

@section('page')

<div class="container">
    <div class="page-header d-md-flex justify-content-between">
        <div>
            <h3>Doctors</h3>
            <nav aria-label="breadcrumb" class="d-flex align-items-start">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="index.html">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="javascript:void(0)">Users</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Doctor List</li>
                </ol>
            </nav>
        </div>

        <div class="d-flex">
            <form class="my-auto mr-4">
                <input id="search" type="text" class="form-control bg-back" placeholder="Search for Doctors">
            </form>

            <div class="my-auto arrow-icons">
                <i class="fa fa-angle-left" aria-hidden="true"></i>
                <i class="fa fa-angle-right active" aria-hidden="true"></i>
            </div>
        </div>
    </div>

    <div class="page-header d-md-flex justify-content-between bg-white"> 
        <ul class="nav nav-pills gallery-filter justify-content-md-center mb-3 mb-md-0">
            <li class="nav-item py-2 text-center">
                <a href="javascript:void(0)" class="btn btn-primary btn-rounded active" data-filter="*" id="cat_0" data-id="0">
                    All
                </a>
            </li>
            @foreach ($categories as $key => $category)
            <li class="nav-item py-2 text-center">
                <a href="javascript:void(0)" class="btn btn-rounded" data-filter=".{{$category->id}}" id="cat_{{$key + 1}}" data-id="{{$key + 1}}">
                    {{substr($category->name, 0, 10)}}
                    @if (strlen($category->name) > 10)
                        ...
                    @endif
                </a>
            </li>
            @endforeach
        </ul>
    </div>

    <div class="row" id="view_1">
        <div class="col-md-12">
            <div class="gallery-container row">
                @foreach ($doctors as $doctor)

                    @if (auth()->user()->id != $doctor->id)
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 {{$doctor->category}} mb-4">
                        <a href="javascript:void(0)" class="image-popup-gallery-item">
                            <div class="card">
                                @if (friend($doctor->id) == 1)
                                <div class="friend-tab bg-success-bright text-danger">
                                    <i class="fa fa-handshake-o text-success  mr-2"></i>
                                </div>
                                @endif

                                <div class="like-tab bg-danger-bright text-danger" id="{{$doctor->id}}" data-id="{{$doctor->id}}">
                                    <i class="fa fa-heart {{like($doctor->id) == 1 ? 'text-danger' : 'text-white'}}  mr-2"></i>
                                    <span>{{$doctor->favourite->count()}}</span>
                                </div>
                                <div class="card-body">
                                    <div class="my-3">
                                        <img src="{{$doctor->image()}}" class="img-fluid rounded" alt="Vase">
                                    </div>
                                    <div class="text-center">
                                        <a href="javascript:void(0)">
                                            <h4>{{$doctor->name}}</h4>
                                        </a>
                                        <ul class="list-inline">
                                            <li class="list-inline-item">
                                                <i class="fa fa-star text-warning"></i>
                                            </li>
                                            <li class="list-inline-item">
                                                <i class="fa fa-star text-warning"></i>
                                            </li>
                                            <li class="list-inline-item">
                                                <i class="fa fa-star text-warning"></i>
                                            </li>
                                            <li class="list-inline-item">
                                                <i class="fa fa-star-half-o text-warning"></i>
                                            </li>
                                            <li class="list-inline-item">
                                                <i class="fa fa-star-o"></i>
                                            </li>
                                            <li class="list-inline-item">(47)</li>
                                        </ul>
                                        <div class="badge bg-info-bright text-info">
                                            @if ($doctor->categories)
                                            {{$doctor->categories->name}}
                                            @else
                                            General 
                                            @endif
                                            </div>
                                        <div class="mt-2">
                                            <a class="btn btn-info text-white">View Profile</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endif

                @endforeach
            </div>
        </div>
    </div>
    <div class="row" id="view_2" style="display: none"></div>
</div>


@endsection

@section('script')
<script src="{{asset('theme/vendors/lightbox/jquery.magnific-popup.min.js')}}"></script>
<script src="{{asset('theme/vendors/jquery.isotope.min.js')}}"></script>
{{-- <script src="{{asset('theme/js/examples/pages/gallery.js')}}"></script> --}}
<script>
    var nth = 0;
    var $container = $('.gallery-container');
    var count = '{{$categories->count()}}';

    $('.gallery-filter').slick({
        slidesToShow: 6,
        slidesToScroll: 1,
        arrows: false,
        responsive: [{
            breakpoint: 1600,
            settings: {
                slidesToShow: 6
            }
        }, {
            breakpoint: 1440,
            settings: {
                slidesToShow: 5
            }
        }, {
            breakpoint: 992,
            settings: {
                slidesToShow: 4
            }
        }, {
            breakpoint: 767,
            settings: {
                slidesToShow: 3
            }
        }, {
            breakpoint: 576,
            settings: {
                slidesToShow: 2
            }
        }, {
            breakpoint: 442,
            settings: {
                slidesToShow: 2
            }
        }]
    });

    $container.isotope({
        filter: '*',
        animationOptions: {
            duration: 750,
            easing: 'linear',
            queue: false
        }
    });

    $(document).on('click','.gallery-filter a', function(){
        $('#view_1').css('display', 'block');
        $('#view_2').css('display', 'none');
        var $this = $(this);

        $('.gallery-filter .active').removeClass('btn-primary active');
        $this.addClass('active btn-primary');

        var selector = $this.attr('data-filter');
        $container.isotope({
            filter: selector,
            animationOptions: {
                duration: 300,
                easing: 'linear',
                queue: false
            }
        });
        return false;
    });

    $(document).on('click','.like-tab', function(){
        var id = $(this).data('id');
        var num = Number($('#' + id + ' span').text());
        $.ajax({
            url: "like",
            type:'post',
            dataType:'json',
            data:{
                'id' : id,
            },
            success:function(res){
                if (res.status) {
                    $('#' + id + ' i').removeClass('text-white');
                    $('#' + id + ' i').addClass('text-danger');
                    $('#' + id + ' span').text(++num);
                } else {
                    $('#' + id + ' i').removeClass('text-danger');
                    $('#' + id + ' i').addClass('text-white');
                    $('#' + id + ' span').text(--num);
                }
            }
        });
    });

    $('.arrow-icons').on('click', '.fa-angle-left', function() {
        $('#view_1').css('display', 'block');
        $('#view_2').css('display', 'none');

        $(this).addClass('active');
        $('.fa-angle-right').removeClass('active');
        $('.gallery-filter').slick('slickPrev');
        nth--;
        if (nth < 0) { nth = Number(count);};
        $('#cat_' + nth).click();
    });

    $('.arrow-icons').on('click', '.fa-angle-right', function() {
        $('#view_1').css('display', 'block');
        $('#view_2').css('display', 'none');

        $(this).addClass('active');
        $('.fa-angle-left').removeClass('active');
        $('.gallery-filter').slick('slickNext');
        nth++;
        if (nth > Number(count)) { nth = 0;};
        $('#cat_' + nth).click();
    });

    $('.gallery-filter').on('click', 'a', function() {
        nth = $(this).data('id');
    });

    $(document).on('keyup', '#search', function() {
        var data = $(this).val();

        if (data != '') {
            $('#view_2').css('display', 'block');
            $('#view_1').css('display', 'none');

            $.ajax({
                url: 'search',
                type: 'get',
                dataType: 'json',
                data: {
                    data: data,
                    type: 'doctor'
                },
                success:function(res) {
                   $('#view_2').html(res.view);
                }
                ,error: function(err) {
                    console.log(err);
                }
            });
        } else {
            $('#view_1').css('display', 'block');
            $('#view_2').css('display', 'none');
        }
    });
</script>
@endsection  