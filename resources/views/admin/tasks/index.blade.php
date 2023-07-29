@extends('layouts.admin')
@section('content')
@can('task_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.tasks.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.task.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.task.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Task">
                <thead>
                    <tr>
                        <th>

                        </th>
                        <th>
                            {{ trans('cruds.task.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.task.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.task.fields.status') }}
                        </th>
                        <th>
                            {{ trans('cruds.task.fields.tag') }}
                        </th>
                        <th>
                            {{ trans('cruds.task.fields.attachment') }}
                        </th>
                        <th>
                            {{ trans('cruds.task.fields.start_date') }}
                        </th>
                        <th>
                            {{ trans('cruds.task.fields.due_date') }}
                        </th>
                        <th>
                            {{ trans('cruds.task.fields.assigned_to') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tasks as $key => $task)
                        <tr data-entry-id="{{ $task->id }}">
                            <td></td>
                            <td>
                                {{ $task->id ?? '' }}
                            </td>
                            <td>
                                @can('task_show')
                                    <a href="{{ route('admin.tasks.show', $task->id) }}">
                                        {{ $task->name ?? '' }}
                                    </a>
                                @endcan
                            </td>
                            <td>
                                @can('task_edit')
                                  <select class="status form-control" data-id="{{ $task->id }}">
                                      @foreach($statuses as $status)
                                          <option value="{{ $status->id }}" {{ $task->status->id == $status->id ? 'selected' : '' }}>{{ $status->name }}</option>
                                      @endforeach
                                  </select>
                                @else
                                  {{ $task->status->name ?? '' }}
                                @endcan
                            </td>
                            <td>
                                @foreach($task->tags as $key => $item)
                                    <span class="badge badge-info">{{ $item->name }}</span>
                                @endforeach
                            </td>
                            <td>
                              @if($task->attachment && $task->attachment->getUrl())
                                  @if($task->isImage())
                                      <a href="#" class="image-link" data-image-url="{{ $task->attachment->getUrl() }}" data-toggle="modal" data-target="#imageModal">
                                          {{ trans('global.view_file') }}
                                      </a>
                                  @else
                                      <a href="{{ $task->attachment->getUrl() }}" target="_blank">
                                          {{ trans('global.view_file') }}
                                      </a>
                                  @endif
                              @endif
                            </td>
                            <td>
                                {{ $task->start_date ?? '' }}
                            </td>
                            <td>
                                {{ $task->due_date ?? '' }}
                            </td>
                            <td>
                                {{ $task->assigned_to->name ?? '' }}
                            </td>
                            <td>
                                @can('task_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.tasks.edit', $task->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('task_delete')
                                    <form action="{{ route('admin.tasks.destroy', $task->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-body">
                    <img id="modalImage" src="" alt="Image" class="img-fluid">
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>
@endsection

<style>
  .modal-dialog {
      max-width: 1000px !important ;
  }

  .status-new {
    background-color: #7CFC00; /* Màu nền */
    color: #000000; /* Màu chữ */
  }

  .status-in-progress {
    background-color: #FFA500;
    color: #000000;
  }

  .status-completed {
    background-color: #FF0000;
    color: #FFFFFF;
  }
</style>

@section('scripts')
@parent
<script>
    $(function () {
        let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

    @can('task_delete')
    let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
    let deleteButton = {
        text: deleteButtonTrans,
        url: "{{ route('admin.tasks.massDestroy') }}",
        className: 'btn-danger',
        action: function (e, dt, node, config) {
        var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
            return $(entry).data('entry-id')
        });

        if (ids.length === 0) {
            alert('{{ trans('global.datatables.zero_selected') }}')

            return
        }

        if (confirm('{{ trans('global.areYouSure') }}')) {
            $.ajax({
            headers: {'x-csrf-token': _token},
            method: 'POST',
            url: config.url,
            data: { ids: ids, _method: 'DELETE' }})
            .done(function () { location.reload() })
        }
        }
    }
    dtButtons.push(deleteButton)
    @endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });

  let table = $('.datatable-Task:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

//update status at table
$('select.status').change(function () {
    var status_id = $(this).val();
    var task_id = $(this).data('id');

    $.ajax({
        url: '/admin/tasks/' + task_id + '/status',
        type: 'POST',
        data: {
            '_token': '{{ csrf_token() }}',
            'status_id': status_id
        },
        success: function (data) {
            // alert(data.message);
            toastr.success(data.message);
        },
        error: function (data) {
            // console.log('Error:', data);
            toastr.error('There was an error updating the status.');
        }
    });
});

//modal open hình đính kèm
$(document).ready(function() {
    $('.image-link').on('click', function(e) {
        e.preventDefault();
        $('#modalImage').attr('src', $(this).data('image-url'));
    });
});

</script>
@endsection