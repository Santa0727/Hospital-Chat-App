@extends('layouts.theme')

@section('style')

@endsection

@section('page')
<link rel="stylesheet" id="custom-styles" href="{{asset('theme/custom-css/dashboard-explore-doctor.css')}}">

<div class="page-header">
    <div class="header-bar">
        <h3>Stories</h3>
        <button class="btn btn-link" type="button" data-toggle="modal" data-target="#add-story-modal">Add New Story</button>
    </div>
</div>
<div class="page-content">
    @foreach($stories as $story)
    <div class="story-comment">
        <div class="story card">
            <div class="card-header">
                <h5 class="title">
                    <a href="{{route('blog-explore', $story->id)}}" target="_blank" class="link">
                        {{$story->title}}
                    </a>
                </h5>
                <span class="time-ago">posted by {{$story->user->name}}, {{$story->created_ago}}</span>
            </div>
            <div class="card-body">
                @if($story->media_type != null && $story->media_type != '')
                <div class="media">
                    @if($story->media_type == 'video')
                    <video src="{{asset($story->media_url)}}" controls></video>
                    @elseif($story->media_type == 'image')
                    <img src="{{asset($story->media_url)}}" alt="" />
                    @endif
                </div>
                @endif
                <div class="description">
                    <pre>{{$story->description}}</pre>
                </div>
            </div>
            <div class="card-footer">
                <span class="total-count">
                    <i class="fa fa-users" aria-hidden="true"></i>
                    {{$story->comment_count}}
                </span>
                <span class="like-count">
                    <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                    {{$story->like_count}}
                </span>
                <span class="dislike-count">
                    <i class="fa fa-thumbs-down" aria-hidden="true"></i>
                    {{$story->dislike_count}}
                </span>
            </div>
        </div>
        <div class="comments">
            @foreach($story->comments as $comment)
            <div class="comment card">
                <div class="card-body">
                    <pre>{{$comment->body}}</pre>
                </div>
                <div class="card-footer">
                    <span class="auth-name">
                        commented by {{$comment->user->name}}
                        <span class="liked">
                            @if($comment->liked == 1)
                            <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                            @else
                            <i class="fa fa-thumbs-down" aria-hidden="true"></i>
                            @endif
                        </span>
                    </span>
                    <span class="time-ago">{{$comment->created_ago}}</span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endforeach
</div>

<!-- Location Modal -->
<form action="{{route('add-story')}}" method="POST" class="modal fade" id="add-story-modal" tabindex="-1">
@csrf <!-- {{ csrf_field() }} -->
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add New Story</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input class="form-control" type="text" id="title" name="title" required />
                </div>

                <div class="form-group">
                    <label for="description">Descrption</label>
                    <textarea class="form-control" name="description" id="description" rows="10" required></textarea>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="media_type">Media Type</label>
                            <select class="form-control" name="media_type" id="media_type">
                                <option value="" selected>None</option>
                                <option value="video">Video</option>
                                <option value="image">Image</option>
                            </select>
                        </div>
                        <div class="form-group hide" id="video-group">
                            <input type="file" id="video_file" accept="video/*" />
                        </div>
                        <div class="form-group hide" id="image-group">
                            <input type="file" id="image_file" accept="image/*" />
                        </div>
                        <div class="progress hide">
                            <div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="margin-left:5px; width: 0%;">0%</div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="video-preview hide">
                            <video src="" controls id="video-preview" style="width: 100%; height:auto;"></video>
                        </div>
                        <div class="image-preview hide">
                            <img id="image-preview" src="{{ asset('story-media/images/default.png') }}" style="width:100%; height:auto;" />
                        </div>
                        <div class="errors hide"></div>
                    </div>
                </div>

                <input class="hide" type="text" id="media_url" value="" name="media_url" />
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="button" id="submit_form" class="btn btn-success">Submit</button>
            </div>
        </div>
    </div>
</form>

@endsection

@section('script')

<script type="text/javascript" src="{{url('front/js/jquery.mb.slider.js')}}"></script>
<script type="text/javascript" src="{{url('front/js/moment-round.js')}}"></script>
<script>
$(document).ready(function() {
});
$('#submit_form').click(function() {
    if($('#title').val() == '' || $('#description').val() == '') {
        alert('Please fill title and description');
        return;
    }
    var type = $('#media_type').val();
    if(type == '') {
        $('#add-story-modal').submit();
        return;
    }
    type += '_file';
    mediaUpload(type);
});
$('#media_type').change(function() {
    var media = $(this).val();
    if(media == 'video') {
        $('#video-group').removeClass('hide');
        $('#image-group').addClass('hide');
        $('.video-preview').removeClass('hide');
        $('.image-preview').addClass('hide');
        $('.progress').removeClass('hide');
    }
    else if(media == 'image') {
        $('#video-group').addClass('hide');
        $('#image-group').removeClass('hide');
        $('.video-preview').addClass('hide');
        $('.image-preview').removeClass('hide');
        $('.progress').removeClass('hide');
    }
    else {
        $('#video-group').addClass('hide');
        $('#image-group').addClass('hide');
        $('.video-preview').addClass('hide');
        $('.image-preview').addClass('hide');
        $('.progress').addClass('hide');
    }
});

function mediaUpload(media_file)
{
    if($('#'+media_file)[0].files.length == 0) return false;
    var ajax_url = (media_file == 'video_file' ? "{{route('ajax-video-story-upload')}}" : "{{route('ajax-image-story-upload')}}");
    var formdata = new FormData();
    formdata.append(media_file, $('#'+media_file)[0].files[0]);
    formdata.append('_token', "{{ csrf_token() }}");
    $.ajax({
        type: 'POST',
        url: ajax_url,
        data: formdata,
        contentType: false,
        cache: false,
        dataType: false,
        processData: false,
        xhr: function() {
            var xhr = new window.XMLHttpRequest();
            xhr.upload.addEventListener('progress', function(element) {
                if(element.lengthComputable) {
                    var percentComplete = parseInt((element.loaded / element.total) * 100);
                    $('.progress-bar').text(percentComplete + '%');
                    $('.progress-bar').css('width', percentComplete + '%');
                }
            }, false);
            return xhr;
        },
        beforeSend: function() {
            $('.progress-bar').text('0%');
            $('.progress-bar').css('width', '0%');
            $('.errors').addClass('hide');
        },
        success: function(data) {
            if(data.errors) {
                $('.progress-bar').text('0%');
                $('.progress-bar').css('width', '0%');
                $('.errors').removeClass('hide');
                $('.errors').html('<span class="text-danger"><b>'+data.errors+'</b></span>');
            }
            else {
                console.log(data);
                $('#media_url').val(data.file_name);
                $('#add-story-modal').submit();
            }
        }
    });
}

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#image-preview').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
}
$("#image_file").change(function() {
    readURL(this);
});

</script>

@endsection
