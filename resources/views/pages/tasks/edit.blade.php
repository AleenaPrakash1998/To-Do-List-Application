@extends('layouts.master')
@section('content')
    <div class="card mb-4">
        <div class="card-body">
            <h1 class="mb-0 fw-semibold fs-5">Update {{$task->name}}</h1>
            <p class="card-text pt-2">
                Define your project&#39;s new look. Easily set up a new task with our intuitive
                customization tool.
            </p>
        </div>
    </div>
    <form id="task-update-form" method="POST" action="{{ route('tasks.update', $task->id) }}"
          enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header fw-semibold">General</h5>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="defaultFormControlInput" class="form-label">Title</label>
                            <input type="text" class="form-control" id="defaultFormControlInput"
                                   aria-describedby="defaultFormControlHelp" name="title"
                                   value="{{ old('title', $task->title) }}">
                            @error('name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description"
                                      name="description">{{ old('description', $task->description) }}</textarea>
                            @error('description')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="due_date" class="form-label">Due Date</label>
                            <input type="date" class="form-control" id="due_date" name="due_date"
                                   value="{{ old('due_date', $task->due_date) }}">
                            @error('due_date')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
{{--                            <div>--}}
{{--                                <div class="form-check form-check-inline">--}}
{{--                                    <input type="radio" id="pending" name="status" value="pending"--}}
{{--                                           class="form-check-input" {{ old('status') == 'pending' ? 'checked' : '' }}>--}}
{{--                                    <label for="active" class="form-check-label">Pending</label>--}}
{{--                                </div>--}}
{{--                                <div class="form-check form-check-inline">--}}
{{--                                    <input type="radio" id="completed" name="status" value="completed"--}}
{{--                                           class="form-check-input" {{ old('status') == 'completed' ? 'checked' : '' }}>--}}
{{--                                    <label for="inactive" class="form-check-label">Completed</label>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" id="pending" name="status" value="pending"
                                           class="form-check-input" {{ $task->status == 'pending' ? 'checked' : '' }}>
                                    <label for="pending" class="form-check-label">Pending</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" id="completed" name="status" value="completed"
                                           class="form-check-input" {{ $task->status == 'completed' ? 'checked' : '' }}>
                                    <label for="completed" class="form-check-label">Completed</label>
                                </div>
                            </div>

                            @error('status')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-body">
                <div class="card-text alert bg-primary">
                    <p class="card-text pt-2">Review your theme settings before saving changes. Ensure everything looks
                        perfect for
                        your project&#39;s new aesthetic.
                    </p>
                </div>
                <div class="d-flex align-items-center">
                    <div class="me-auto">
                        <div class="form-check form-switch mb-2">
                        </div>
                    </div>
                    <div class="col-auto me-3">
                        <button type="submit" class="btn btn-primary" id="submit-form">Update Product</button>
                    </div>
                    <div class="col-auto">
                        <button type="button" class="btn btn-outline-secondary" id="cancel-form">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    @include('pages.tasks._columns.modal.update-success-modal')
@endsection

@push('custom-scripts')

    <script>
        $(function () {
            $('#cancel-form').click(function () {
                window.location.href = "{{ route('tasks.index') }}";
            });

            $("#task-update-form").validate({
                rules: {
                    title: {
                        required: true
                    },
                    description: {
                        required: true,
                    },
                    status: {
                        required: true,
                    },
                    due_date: {
                        required: true,
                    },
                },
                errorPlacement: function (error, element) {
                    if (error.text() === "" && element.hasClass('select2-hidden-accessible')) {
                        element.next('.select2-container').removeClass('is-invalid');
                        element.next('.select2-container').addClass('is-valid');
                    } else {
                        if (element.hasClass('js-example-basic-multiple')) {
                            error.insertAfter(element.next('.select2-container'));
                        } else {
                            error.insertAfter(element);
                        }
                    }
                }
            });

            $('#submit-form').click(function (event) {
                event.preventDefault();
                let form = $('#task-update-form');
                let formData = new FormData(form[0]);

                if (form.valid()) {
                    $.ajax({
                        url: "{{ route('tasks.update', $task->id) }}",
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        },
                        processData: false,
                        contentType: false,
                        data: formData,
                        success: function (response) {
                            $('#successModal').modal('show');

                            $('#successModal .btn-close, #successModal .btn-primary').on('click', function () {
                                $('#successModal').modal('hide');
                                window.location.href = "{{ route('tasks.index') }}";
                            });
                        },
                        error: function (xhr, textStatus, errorThrown) {
                            if (xhr.responseJSON && xhr.responseJSON.errors) {
                                $.each(xhr.responseJSON.errors, function (field, errors) {
                                    let fieldElement = $('input[name="' + field + '"], select[name="' + field + '"], textarea[name="' + field + '"]');
                                    fieldElement.closest('.mb-3').find('.text-danger').remove();
                                    fieldElement.after('<div class="text-danger">' + errors.join('<br>') + '</div>');
                                });
                            } else {
                                console.log('Error:', errorThrown);
                            }
                        }
                    });
                }
            });
        });

        function readURL(input, newImgID, currentImgID) {
            if (input.files && input.files[0]) {
                let reader = new FileReader();

                reader.onload = function (e) {
                    $('#' + newImgID).attr('src', e.target.result).show();
                    $('#' + currentImgID).hide();
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

    </script>
@endpush

<style>
    .select2-container--default .select2-selection--multiple {
        border-color: #d9dee3 !important;
    }

    .input-group-addon {
        padding: 0.75rem !important;
    }
</style>
