@extends('layouts.theme')

@section('style')

@endsection

@section('title')

@endsection

@section('subTitle')

@endsection

@section('content')
<div class="container py-5">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="info-tab" data-toggle="tab" href="#info" role="tab" aria-controls="info" aria-selected="true">Information de base</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="praticien-tab" data-toggle="tab" href="#praticien" role="tab" aria-controls="praticien" aria-selected="false">Fiche praticien</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="cabinet-tab" data-toggle="tab" href="#cabinet" role="tab" aria-controls="cabinet" aria-selected="false">Mon cabinet</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Horaires et contacts</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="password-tab" data-toggle="tab" href="#password" role="tab" aria-controls="password" aria-selected="false">Password</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="info" role="tabpanel" aria-labelledby="info-tab">
            <div class="form-group row">
                <div class="col-md-6">
                    <label class="text-uppercase">Prénom</label>
                    <input id="firstName" type="text" class="form-control @error('firstName') is-invalid @enderror" name="firstName" value="{{ old('firstName') }}" required autofocus>
                    @error('firstName')
                        <div class="text-danger" role="alert">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label>Nom</label>
                    <input id="lastName" type="text" class="form-control @error('lastName') is-invalid @enderror" name="lastName" value="{{ old('lastName') }}" required autofocus>
                    @error('lastName')
                        <div class="text-danger" role="alert">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label class="text-uppercase">Display Name</label>
                <input id="displayName" type="text" class="form-control @error('displayName') is-invalid @enderror" name="displayName" value="{{ old('displayName') }}" required autofocus>
                @error('displayName')
                    <div class="text-danger" role="alert">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label class="text-uppercase">Email Address</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="new-password" autofocus>
                @error('email')
                    <div class="text-danger" role="alert">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="tab-pane fade" id="praticien" role="tabpanel" aria-labelledby="praticien-tab">
            <div class="form-group">
                <label class="text-uppercase">Domaine Médical</label>
                <input id="domaineMedical" type="text" class="form-control @error('domaineMedical') is-invalid @enderror" name="domaineMedical" value="{{ old('domaineMedical') }}" required autocomplete="new-password" autofocus>
            </div>
            <div class="form-group">
                <label class="text-uppercase">Expertises,Actes Et SymptÔmes (Optionnel)</label>
                <input id="symptomes" type="text" class="form-control @error('symptomes') is-invalid @enderror" name="symptomes" value="{{ old('symptomes') }}">
            </div>
            <div class="form-group">
                <label class="text-uppercase">Tarifs Et Remboursements</label>
                <select name="category" class="form-control">
                    <option>Choose a category...</option>
                </select>
            </div>
            <div class="form-group">
                <label class="text-uppercase">Tarifs Et Remboursements</label>
                <select name="salary" class="form-control">
                    <option>Choose a salary...</option>
                </select>
            </div>
            <div class="form-group">
                <label class="text-uppercase">Project Length (Optional)</label>
                <select name="salary" class="form-control">
                    <option>Choose a project length...</option>
                </select>
            </div>
            <div class="form-group">
                <label class="text-uppercase">Working Environment (Optional)</label>
                <select name="environment" class="form-control">
                    <option>Choose a job working environment...</option>
                </select>
            </div>
            <div class="form-group">
                <label class="text-uppercase">Short Description (Optional)</label>
                <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}">
            </div>
            <div class="form-group">
                <label class="text-uppercase">Présentation Du Professionnel De Santé</label>
                <select name="salary" class="form-control">
                    <option>Choose a project length...</option>
                </select>
            </div>
            <div class="form-group">
                <label class="text-uppercase">DiplÔmes nationaux Et universitaires (Optional)</label>
                <div>
                    <button><i class="fa fa-plus" aria-hidden="true"></i> Ajouter diplÔmes</button>
                </div>
            </div>
            <div class="form-group">
                <label class="text-uppercase">Expériences</label>
                <div>
                    <button><i class="fa fa-plus" aria-hidden="true"></i> Ajouter expérience</button>
                </div>
            </div>
            <div class="form-group">
                <label class="text-uppercase">Bonus Points (Optional)</label>
                <div>
                    <button><i class="fa fa-plus" aria-hidden="true"></i> Add Bonus Points</button>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="cabinet" role="tabpanel" aria-labelledby="cabinet-tab">
            <div class="form-group">
                <label class="text-uppercase">Adresse Cabinet</label>
                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autofocus>
            </div>
            <div class="form-group row">
                <div class="col-md-6">
                    <label class="text-uppercase">Nom Du Cabinet</label>
                    <input id="companyName" type="text" class="form-control @error('companyName') is-invalid @enderror" name="companyName" value="{{ old('companyName') }}" required autofocus placeholder="Enter the name of the company">
                </div>
                <div class="col-md-6">
                    <label>Branch Website (Optional)</label>
                    <input id="website" type="text" class="form-control @error('website') is-invalid @enderror" name="website" value="{{ old('website') }}" required autofocus >
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6">
                    <label class="text-uppercase">Nom Du Cabinet (Optionnel)</label>
                    <input id="companyVideo" type="text" class="form-control @error('companyVideo') is-invalid @enderror" name="companyVideo" value="{{ old('companyVideo') }}" required autofocus placeholder="A link to a video about your company">
                </div>
                <div class="col-md-6">
                    <label>Branch Twitter (Optional)</label>
                    <input id="twitter" type="text" class="form-control @error('twitter') is-invalid @enderror" name="twitter" value="{{ old('twitter') }}" required autofocus>
                </div>
            </div>
            <div class="form-group">
                <label class="text-uppercase">Photo Du Cabinet (Optionnel)</label>
                <input id="file" type="file" class="form-control" name="file">
                <div>Maximum file size:30 MB.</div>
            </div>
            <div class="form-group">
                <button><i class="fa fa-plus" aria-hidden="true"></i> Ajouter un cabinet</button>
            </div>
        </div>
        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
            <div class="form-group">
                <b>adresse cabinet</b>
            </div>
            <div class="form-group row">
                <div class="col-md-2">Monday</div>
                <div class="col-md-2">
                    <input type="number" class="form-control" name="startTime[]">
                </div>
                <div class="col-md-2">
                    <input type="number" class="form-control" name="endTime[]">
                </div>
                <div class="col-md-1">
                    <span><i class="fa fa-times-circle" aria-hidden="true"></i></span>
                </div>
                <div class="col-md-1">
                    <span><i class="fa fa-plus-circle" aria-hidden="true"></i></span>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-2">Tuesday</div>
                <div class="col-md-2">
                    <input type="number" class="form-control" name="startTime[]">
                </div>
                <div class="col-md-2">
                    <input type="number" class="form-control" name="endTime[]">
                </div>
                <div class="col-md-1">
                    <span><i class="fa fa-times-circle" aria-hidden="true"></i></span>
                </div>
                <div class="col-md-1">
                    <span><i class="fa fa-plus-circle" aria-hidden="true"></i></span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-2">Wednesday</div>
                <div class="col-md-2">
                    <input type="number" class="form-control" name="startTime[]">
                </div>
                <div class="col-md-2">
                    <input type="number" class="form-control" name="endTime[]">
                </div>
                <div class="col-md-1">
                    <span><i class="fa fa-times-circle" aria-hidden="true"></i></span>
                </div>
                <div class="col-md-1">
                    <span><i class="fa fa-plus-circle" aria-hidden="true"></i></span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-2">Thursday</div>
                <div class="col-md-2">
                    <input type="number" class="form-control" name="startTime[]">
                </div>
                <div class="col-md-2">
                    <input type="number" class="form-control" name="endTime[]">
                </div>
                <div class="col-md-1">
                    <span><i class="fa fa-times-circle" aria-hidden="true"></i></span>
                </div>
                <div class="col-md-1">
                    <span><i class="fa fa-plus-circle" aria-hidden="true"></i></span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-2">Friday</div>
                <div class="col-md-2">
                    <input type="number" class="form-control" name="startTime[]">
                </div>
                <div class="col-md-2">
                    <input type="number" class="form-control" name="endTime[]">
                </div>
                <div class="col-md-1">
                    <span><i class="fa fa-times-circle" aria-hidden="true"></i></span>
                </div>
                <div class="col-md-1">
                    <span><i class="fa fa-plus-circle" aria-hidden="true"></i></span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-2">Saturday</div>
                <div class="col-md-5">
                    Closed
                </div>
                <div class="col-md-1">
                    <span><i class="fa fa-plus-circle" aria-hidden="true"></i></span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-2">Sunday</div>
                <div class="col-md-5">
                    Closed
                </div>
                <div class="col-md-1">
                    <span><i class="fa fa-plus-circle" aria-hidden="true"></i></span>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab">
            <div class="form-group">
                <label class="text-uppercase">current password (leave blank to leave unchanged)</label>
                <input id="currentPassword" type="text" class="form-control @error('currentPassword') is-invalid @enderror" name="currentPassword" value="{{ old('currentPassword') }}" required autofocus>
            </div>
            <div class="form-group">
                <label class="text-uppercase">new password (leave blank to leave unchanged)</label>
                <input id="newPassword" type="text" class="form-control @error('newPassword') is-invalid @enderror" name="newPassword" value="{{ old('newPassword') }}" required autofocus>
            </div>
            <div class="form-group">
                <label class="text-uppercase">confirm new password</label>
                <input id="confirmPassword" type="text" class="form-control @error('confirmPassword') is-invalid @enderror" name="confirmPassword" value="{{ old('confirmPassword') }}" required autofocus>
            </div>
        </div>
    </div>
    <div class="form-group">
        <button type="button" class="btn-primary btn-sm transition-3d-hover">
            Save changes
        </button>
    </div>
</div>
@endsection

@section('script')

@endsection
