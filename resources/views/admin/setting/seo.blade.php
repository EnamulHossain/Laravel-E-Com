@extends('admin.layout.app')
@section('admin')
    <div class="card-body m-4 p-4">
        
        <form action="{{route('seo.update', $data->id)}}" method="POST">
            @csrf
            <div class="mb-4">
                <div class="row mb-3">
                    <label class="col-form-label col-lg-3">Meta Title</label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control" placeholder="meta_title" name="meta_title" id="meta_title" value="{{$data->meta_title}}" >
                    </div>
                </div>
    
                <div class="row mb-3">
                    <label class="col-form-label col-lg-3">Meta Author</label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control" placeholder="meta_author" name="meta_author" id="meta_author" value="{{$data->meta_author}}">
                    </div>
                </div>
    
                <div class="row mb-3">
                    <label class="col-form-label col-lg-3">Meta Tag</label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control" placeholder="meta_tag" name="meta_tag" id="meta_tag" value="{{$data->meta_tag}}">
                    </div>
                </div>
    
                <div class="row mb-3">
                    <label class="col-form-label col-lg-3">Meta Descripition</label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control" placeholder="meta_descripition" name="meta_descripition" id="meta_descripition" value="{{$data->meta_descripition}}">
                    </div>
                </div>
    
                <div class="row mb-3">
                    <label class="col-form-label col-lg-3">Meta Keyword</label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control" placeholder="meta_keyword" name="meta_keyword" id="meta_keyword" value="{{$data->meta_keyword}}">
                    </div>
                </div>
    
                <div class="row mb-3">
                    <label class="col-form-label col-lg-3">Google Verification</label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control" placeholder="google_verification" name="google_verification" id="google_verification" value="{{$data->google_verification}}">
                    </div>
                </div>
    
                <div class="row mb-3">
                    <label class="col-form-label col-lg-3">Google Analytics</label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control" placeholder="google_analytics" name="google_analytics" id="google_analytics" value="{{$data->google_analytics}}">
                    </div>
                </div>
    
                <div class="row mb-3">
                    <label class="col-form-label col-lg-3">Alexa Verification</label>
                    <div class="col-lg-9">
                        {{-- <input type="text" class="form-control" placeholder="alexa_verification" name="alexa_verification" id="alexa_verification"> --}}
                        <textarea name="alexa_verification" id="alexa_verification" class="form-control">{{$data->alexa_verification}}</textarea>
                    </div>
                </div>
    
                <div class="row mb-3">
                    <label class="col-form-label col-lg-3">Google Adsense</label>
                    <div class="col-lg-9">
                        {{-- <input type="text" class="form-control" placeholder="google_adsense" name="google_adsense" id="google_adsense"> --}}
                        <textarea name="google_adsense" id="google_adsense" class="form-control">{{$data->google_adsense}}</textarea>
                    </div>
                </div>

            </div>
            <div class="d-flex justify-content-between align-items-center">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
@endsection
