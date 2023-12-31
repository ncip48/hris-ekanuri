{{ Form::open(array('route' => array('personal-report.store'),'method'=>'post', 'enctype' => "multipart/form-data")) }}
<div class="modal-body">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            
            <div class="form-group">
                {{Form::label('employee_id',__('Employee'),['class'=>'form-label'])}}
                {{Form::select('employee_id',$employees,null,array('class'=>'form-control selectric','placeholder'=>__('Select Employee')))}}
                @error('employee_id')
                <small class="invalid-name" role="alert">
                    <strong class="text-danger">{{ $message }}</strong>
                </small>
                @enderror
            </div>

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
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4">
            <h3>Prasyarat</h3>
            <div class="form-group">
                {{Form::label('date_of_report',__('Date Of Report'),['class'=>'form-label'])}}
                {{ Form::date('date_of_report', null, ['class' => 'form-control datepicker', 'placeholder' => __('Enter Your Date Of Report')]) }}
                @error('date_of_report')
                <small class="invalid-date_of_report" role="alert">
                    <strong class="text-danger">{{ $message }}</strong>
                </small>
                @enderror
            </div>
{{-- 
            <div class="form-group">
                {{Form::label('shift_id',__('Shift'),['class'=>'form-label'])}}
                {{Form::select('shift_id',$shift,null,array('class'=>'form-control selectric','placeholder'=>__('Select Shift')))}}
                @error('shift_id')
                <small class="invalid-shift" role="alert">
                    <strong class="text-danger">{{ $message }}</strong>
                </small>
                @enderror
            </div> --}}
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1">
        </div>
        
        <div class="col-lg-7 col-md-7 col-sm-7">
            <h3>*Claim Lembur</h3>
            <div class="form-group">
                {{Form::label('date_of_report',__('Date Of Overtime'),['class'=>'form-label'])}}
                {{ Form::date('date_of_report', null, ['class' => 'form-control datepicker', 'placeholder' => __('Enter Your Date Of Report')]) }}
                @error('date_of_report')
                <small class="invalid-date_of_report" role="alert">
                    <strong class="text-danger">{{ $message }}</strong>
                </small>
                @enderror
            </div>

            <div class="form-group">
                {{Form::label('start_time',__('Start Time'),['class'=>'form-label'])}}
                {{ Form::time('start_time', null, ['class' => 'form-control datepicker', 'placeholder' => __('Enter Your Start Time')]) }}
                @error('start_time')
                <small class="invalid-start_time" role="alert">
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