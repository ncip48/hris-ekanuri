{{ Form::model($employeeSchedule, array('route' => array('employee-schedule.update', $employeeSchedule->id), 'method' => 'PUT')) }}
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

            {{-- <div class="form-group">
                {{Form::label('shift_id',__('Shift'),['class'=>'form-label'])}}
                {{Form::select('shift_id',$shift,null,array('class'=>'form-control selectric','placeholder'=>__('Select Shift')))}}
                @error('shift_id')
                <small class="invalid-shift" role="alert">
                    <strong class="text-danger">{{ $message }}</strong>
                </small>
                @enderror
            </div> --}}

            <div class="form-group">
                {{Form::label('date',__('Date'),['class'=>'form-label'])}}
                {{ Form::date('date', null, ['class' => 'form-control datepicker', 'placeholder' => __('Enter Date')]) }}
                @error('date')
                <small class="invalid-date" role="alert">
                    <strong class="text-danger">{{ $message }}</strong>
                </small>
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