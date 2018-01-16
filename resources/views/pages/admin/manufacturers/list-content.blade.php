@section('manufacturers-list-content')
@if($manufacturerslist)

<div class="box box-info">
  <div class="box-header">
    <h3 class="box-title">{{ trans('admin.manufacturers_list') }}</h3>
    <div class="box-tools pull-right">
      <a href="{{ route('admin.add_manufacturers_content') }}" class="btn btn-primary pull-right">{{ trans('admin.add_new_manufacturers') }}</a>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-body">
        <table class="table table-bordered table-striped admin-data-table">
          <thead>
            <tr>
              <th>{{ trans('admin.image') }}</th>
              <th>{{ trans('admin.name') }}</th>
              <th>{{ trans('admin.country_name') }}</th>
              <th>{{ trans('admin.status') }}</th>
              <th>{{ trans('admin.action') }}</th>
            </tr>
          </thead>
          <tbody>
            @if(count($manufacturerslist)>0)
            @foreach($manufacturerslist as $row)
            <tr>
              @if($row->logo_url)
              <td><img src="{{ get_image_url($row->logo_url) }}" alt="{{ basename ($row->logo_url) }}"></td>
              @else
              <td><img src="{{ default_placeholder_img_src() }}" alt=""></td>
              @endif
              
              <td>{!! $row->name !!}</td>
              <td>{!! $row->country_name !!}</td>
              
              @if($row->status == 1)
              <td>{{ trans('admin.enable') }}</td>
              @else
              <td>{{ trans('admin.disable') }}</td>
              @endif
                
              <td>
                <div class="btn-group">
                  <button class="btn btn-success btn-flat" type="button">{{ trans('admin.action') }}</button>
                  <button data-toggle="dropdown" class="btn btn-success btn-flat dropdown-toggle" type="button">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul role="menu" class="dropdown-menu">
                    <li><a href="{{ route('admin.update_manufacturers_content', $row->slug) }}"><i class="fa fa-edit"></i>{{ trans('admin.edit') }}</a></li>
                    <li><a class="remove-selected-data-from-list" data-track_name="manufacturers_list" data-id="{{ $row->id }}" href="#"><i class="fa fa-remove"></i>{{ trans('admin.delete') }}</a></li>
                  </ul>
                </div>
              </td>
            </tr>
            @endforeach
            @endif
          </tbody>
          <tfoot>
            <th>{{ trans('admin.image') }}</th>
            <th>{{ trans('admin.name') }}</th>
            <th>{{ trans('admin.country_name') }}</th>
            <th>{{ trans('admin.status') }}</th>
            <th>{{ trans('admin.action') }}</th>
          </tfoot>
        </table>
      </div><!-- /.box-body -->
    </div><!-- /.box -->
  </div>
</div>

@endif
@endsection