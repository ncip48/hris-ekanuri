{{ Form::model($employeeContract, array('route' => array('employee-contract.update', $employeeContract->id), 'method' => 'PUT' )) }}
<div class="modal-body">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
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
                {{Form::label('start_date',__('Start Date'),['class'=>'form-label'])}}
                {{ Form::date('start_date', null, ['class' => 'form-control datepicker', 'placeholder' => __('Enter Start Date')]) }}
                @error('start_date')
                <small class="invalid-date_of_report" role="alert">
                    <strong class="text-danger">{{ $message }}</strong>
                </small>
                @enderror
            </div>
            <div class="form-group">
                {{Form::label('end_date',__('End Date'),['class'=>'form-label'])}}
                {{ Form::date('end_date', null, ['class' => 'form-control datepicker', 'placeholder' => __('Enter End Date')]) }}
                @error('end_date')
                <small class="invalid-date_of_report" role="alert">
                    <strong class="text-danger">{{ $message }}</strong>
                </small>
                @enderror
            </div>
                <div class="form-group">
                    {{ Form::label('contract_file', __('Contract File'), ['class' => 'form-label']) }}
                    {{-- {{ Form::file('file', null, ['class' => 'form-control', 'placeholder' => __('Attach File')]) }} --}}
                    <input type="file" name="contract_file" class="form-control">
                    @error('contract_file')
                        <span class="invalid-name" role="alert">
                            <strong class="text-danger">{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

        </div>
    </div>
</div>

<div class="modal-footer">
    <input type="button" value="{{__('Cancel')}}" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="{{__('Update')}}" class="btn  btn-primary">
</div>
{{ Form::close() }}