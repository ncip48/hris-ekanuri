{{ Form::open(['route' => ['overtime-request.store'], 'method' => 'post', 'enctype' => 'multipart/form-data']) }}
<div class="modal-body">
    <div class="row">
        <div class="col-lg-5 col-md-5 col-sm-5">
            <p class="fw-bold">Employee Profile</p>
            <div class="form-group">
                {{-- {{ Form::label('employee_id', __('Employee'), ['class' => 'form-label']) }} --}}
                {{ Form::select('employee_id', $employees, null, ['class' => 'form-control selectric', 'placeholder' => __('Select Employee')]) }}
                {{-- <div class="input-group">
                    <span class="input-group-text">
                        <i class="fas fa-user"></i>
                    </span>
                    {{ Form::input('hidden', 'employee_id', Auth::user()->employee_id, ['class' => 'form-control', 'placeholder' => __('Enter Your Employee ID'), 'readonly' => 'readonly']) }}
                    {{ Form::text('name', Auth::user()->name, ['class' => 'form-control', 'placeholder' => __('Enter Your Name'), 'readonly' => 'readonly']) }}
                </div> --}}

                @error('employee_id')
                    <small class="invalid-name" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                    </small>
                @enderror
            </div>
            <div class="form-group">
                {{-- {{ Form::text('branch', Auth::user()->branch->name, ['class' => 'form-control', 'placeholder' => __('Enter Your Branch'), 'readonly' => 'readonly']) }} --}}
                {{-- {{ Form::label('branch_id', __('Branch'), ['class' => 'form-label']) }} --}}
                {{ Form::select('branch_id', $branch, null, ['class' => 'form-control selectric', 'placeholder' => __('Select Branch')]) }}

                @error('branch')
                    <small class="invalid-branch" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                    </small>
                @enderror
            </div>
        </div>
    </div>
    <hr>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <p class="fw-bold">Claim Overtime</p>
            <div class="table-responsive">
                <table class="table datatable">
                    <thead>
                        {{-- <th>{{ __('No') }}</th> --}}
                        <th>{{ __('Start Date') }}</th>
                        <th>{{ __('End Date') }}</th>
                        <th>{{ __('Duration') }}</th>
                        <th>{{ __('Note') }}</th>
                        {{-- <th>{{ __('action') }}</th> --}}
                    </thead>
                    <tbody id="data-input">
                        <tr>
                            <td><input type="date" name="start_date[]" class="form-control" placeholder="Enter Start Date" /></td>
                            <td><input type="date" name="end_date[]" class="form-control" placeholder="Enter End Date" /></td>
                            <td><input type="text" name="duration[]" class="form-control" placeholder="Enter Duration" /></td>
                            <td><input type="text" name="note[]" class="form-control" placeholder="Enter Note" /></td>
                        </tr>
                        {{-- <tr>
                            <td><input type="date" name="start_date[]" class="form-control" placeholder="Enter Start Date" /></td>
                            <td><input type="date" name="end_date[]" class="form-control" placeholder="Enter End Date" /></td>
                            <td><input type="text" name="duration[]" class="form-control" placeholder="Enter Duration" /></td>
                            <td><input type="text" name="note[]" class="form-control" placeholder="Enter Note" /></td>
                        </tr>
                        <tr>
                            <td><input type="date" name="start_date[]" class="form-control" placeholder="Enter Start Date" /></td>
                            <td><input type="date" name="end_date[]" class="form-control" placeholder="Enter End Date" /></td>
                            <td><input type="text" name="duration[]" class="form-control" placeholder="Enter Duration" /></td>
                            <td><input type="text" name="note[]" class="form-control" placeholder="Enter Note" /></td>
                        </tr> --}}

                    </tbody>
                    {{-- <tfoot>
                        <tr>
                            <td colspan="6">
                                <button type="button" class="btn btn-primary" id="addRow">Add Row</button>
                            </td>
                        </tr>
                    </tfoot> --}}
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal-footer">
    <input type="button" value="{{ __('Cancel') }}" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="{{ __('Submit') }}" class="btn  btn-primary">
</div>
{{ Form::close() }}

{{-- Script --}}

<script>
    $(document).ready(function() {
        var i = 0;

        $('#addRow').click(function() {
            i++;
            $('#data-input').append('<tr id="row' + i + '"><td>' + i +
                '</td><td><input type="date" name="start_date[]" class="form-control" placeholder="Enter Start Date" /></td><td><input type="date" name="end_date[]" class="form-control" placeholder="Enter End Date" /></td><td><input type="text" name="duration[]" class="form-control" placeholder="Enter Duration" /></td><td><input type="text" name="note[]" class="form-control" placeholder="Enter Note" /></td><td><button type="button" name="remove" id="' +
                i +
                '" class="btn btn-danger btn_remove"><i class="ti ti-trash text-white"></i></button></td></tr>'
            );
        });

        $(document).on('click', '.btn_remove', function() {
            var button_id = $(this).attr("id");
            $('#row' + button_id + '').remove();
            // resetIndexes(); // Panggil fungsi untuk mereset nilai i
        });

        // function resetIndexes() {
        //     var remainingRows = $('#data-input tr').filter(function() {
        //         return $(this).attr("id") > button_id;
        //     });

        //     remainingRows.each(function() {
        //         var currentId = parseInt($(this).attr("id").replace("row", ""));
        //         var newId = currentId - 1;
        //         $(this).attr("id", "row" + newId);
        //         $(this).find('td:first').text(newId);
        //         $(this).find('.btn_remove').attr("id", newId);
        //     });

        //     i = remainingRows.length;
        // }
    });
</script>

