{{ Form::open(array('route' => array('store_personal_report'),'method'=>'post', 'enctype' => "multipart/form-data")) }}
<div class="modal-body">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="form-group">
                {{Form::label('date_of_report',__('Date Of Report'),['class'=>'form-label'])}}
                {{ Form::text('date_of_report', null, ['class' => 'form-control datepicker', 'placeholder' => __('Enter Your Date Of Report')]) }}
                @error('date_of_report')
                <small class="invalid-date_of_report" role="alert">
                    <strong class="text-danger">{{ $message }}</strong>
                </small>
                @enderror
            </div>
            <div class="form-group">
                {{Form::label('name',__('Name'),['class'=>'form-label'])}}
                {{Form::text('name',null,array('class'=>'form-control','placeholder'=>__('Enter Your Name')))}}
                @error('name')
                <small class="invalid-name" role="alert">
                    <strong class="text-danger">{{ $message }}</strong>
                </small>
                @enderror
            </div>

            {{-- <div class="form-group">
                {{Form::label('email',__('Email'),['class'=>'form-label'])}}
                {{Form::text('email',null,array('class'=>'form-control','placeholder'=>__('Enter Your Email')))}}
                @error('email')
                <small class="invalid-email" role="alert">
                    <strong class="text-danger">{{ $message }}</strong>
                </small>
                @enderror
            </div> --}}

            <div class="form-group">
                {{Form::label('branch',__('Branch'),['class'=>'form-label'])}}
                {{Form::text('branch',null,array('class'=>'form-control','placeholder'=>__('Enter Your Branch')))}}
                {{-- {{Form::select('branch',$branch,null,array('class'=>'form-control selectric','placeholder'=>__('Select Branch')))}} --}}
                @error('branch')
                <small class="invalid-branch" role="alert">
                    <strong class="text-danger">{{ $message }}</strong>
                </small>
                @enderror
            </div>

            <div class="form-group">
                {{Form::label('department',__('Department'),['class'=>'form-label'])}}
                {{Form::text('Departement',null,array('class'=>'form-control','placeholder'=>__('Enter Your Department')))}}
                {{-- {{Form::select('department',$department,null,array('class'=>'form-control selectric','placeholder'=>__('Select Department')))}} --}}
                @error('department')
                <small class="invalid-department" role="alert">
                    <strong class="text-danger">{{ $message }}</strong>
                </small>
                @enderror
            </div>

            <div class="form-group">
                {{Form::label('designation',__('Designation'),['class'=>'form-label'])}}
                {{Form::text('designation',null,array('class'=>'form-control','placeholder'=>__('Enter Your Designation')))}}
                {{-- {{Form::select('designation',$designation,null,array('class'=>'form-control selectric','placeholder'=>__('Select Designation')))}} --}}
                @error('designation')
                <small class="invalid-designation" role="alert">
                    <strong class="text-danger">{{ $message }}</strong>
                </small>
                @enderror
            </div>

            <div class="form-group">
                {{Form::label('report',__('Report'),['class'=>'form-label'])}}
                {{Form::textarea('report',null,array('class'=>'form-control','placeholder'=>__('Enter Your Report')))}}
                @error('report')
                <small class="invalid-report" role="alert">
                    <strong class="text-danger">{{ $message }}</strong>
                </small>
                @enderror

            </div>

        </div>
    </div>
</div>

<div class="modal-footer">
    <input type="button" value="{{__('Cancel')}}" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="{{__('Upload')}}" class="btn  btn-primary">
</div>
{{ Form::close() }}