{{ Form::open(array('route' => array('personal-report.store'),'method'=>'post', 'enctype' => "multipart/form-data")) }}
<div class="modal-body">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="form-group">
                {{Form::label('date_of_report',__('Date Of Report'),['class'=>'form-label'])}}
                {{ Form::date('date_of_report', null, ['class' => 'form-control datepicker', 'placeholder' => __('Enter Your Date Of Report')]) }}
                @error('date_of_report')
                <small class="invalid-date_of_report" role="alert">
                    <strong class="text-danger">{{ $message }}</strong>
                </small>
                @enderror
            </div>
            <div class="form-group">
                {{Form::label('employee_id',__('Employee'),['class'=>'form-label'])}}
                {{-- {{Form::text('name',null,array('class'=>'form-control','placeholder'=>__('Enter Your Name')))}} --}}
                {{Form::select('employee_id',$employees,null,array('class'=>'form-control selectric','placeholder'=>__('Select Employee')))}}
                @error('employee_id')
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
                {{Form::label('branch_id',__('Branch'),['class'=>'form-label'])}}
                {{Form::select('branch_id',$branch,null,array('class'=>'form-control selectric','placeholder'=>__('Select Branch')))}}
                @error('branch_id')
                <small class="invalid-branch" role="alert">
                    <strong class="text-danger">{{ $message }}</strong>
                </small>
                @enderror
            </div>

            <div class="form-group">
                {{Form::label('department_id',__('Department'),['class'=>'form-label'])}}
                {{Form::select('department_id',$department,null,array('class'=>'form-control selectric','placeholder'=>__('Select Department')))}}
                @error('department')
                <small class="invalid-department" role="alert">
                    <strong class="text-danger">{{ $message }}</strong>
                </small>
                @enderror
            </div>

            <div class="form-group">
                {{Form::label('sub_department_id',__('Sub Department'),['class'=>'form-label'])}}
                {{Form::select('sub_department_id',$sub_department,null,array('class'=>'form-control selectric','placeholder'=>__('Select Sub Department')))}}
                @error('sub_department_id')
                <small class="invalid-sub-department" role="alert">
                    <strong class="text-danger">{{ $message }}</strong>
                </small>
                @enderror
            </div>

            <div class="form-group">
                {{Form::label('designation_id',__('Designation'),['class'=>'form-label'])}}
                {{Form::select('designation_id',$designation,null,array('class'=>'form-control selectric','placeholder'=>__('Select Designation')))}}
                @error('designation_id')
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
    <input type="submit" value="{{__('Submit')}}" class="btn  btn-primary">
</div>
{{ Form::close() }}