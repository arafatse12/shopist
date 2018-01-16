@section('user-roles-update-content')
@include('pages-message.form-submit')

<form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
  <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
  <input type="hidden" name="hf_post_type" id="hf_post_type" value="update">
 
  <div class="box box-solid">
    <div class="box-header">
      <h3 class="box-title">{{ trans('admin.update_user_role_title') }} &nbsp;&nbsp;&nbsp;&nbsp;<a class="btn btn-default btn-xs" href="{{ route('admin.users_roles_list') }}">{{ trans('admin.user_role_list_title') }}</a></h3>
      <div class="box-tools pull-right">
        <button class="btn btn-primary pull-right" type="submit">{{ trans('admin.update') }}</button>
      </div>
    </div>
  </div>
  
 <div class="box box-solid">
    <div class="box-body">
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <div class="col-sm-3">
              <label class="control-label" for="inputEnterRoleName">{{ trans('admin.enter_role_name') }}</label>
            </div>
            <div class="col-sm-9">
              <input type="text" placeholder="{{ trans('admin.enter_role_name') }}" class="form-control" value="{{ $user_roles_details->role_name }}" id="user_role_name" name="user_role_name">
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-3">
              <label class="control-label" for="inputAccessList">{{ trans('admin.access_list_by_role') }}</label>
            </div>
            <div class="col-sm-9 permissions-file">
              <ul>
                <?php $i = 1;?>  
                @foreach( get_permissions_files_list() as $key => $val)
                  @if(in_array($key, $user_roles_details->permissions))
                    <li>
                      <div class="allow-btn">
                        <div class="onoffswitch">
                          <input type="checkbox" checked="checked" name="allow_permissions[]" class="onoffswitch-checkbox file-name" id="allow_permissions_{{ $i }}" value="{{ $key }}">
                          <label class="onoffswitch-label" for="allow_permissions_{{ $i }}">
                            <span class="onoffswitch-inner"></span>
                            <span class="onoffswitch-switch"></span>
                          </label>
                        </div>
                      </div>
                      <div class="permissions-file-name">{!! $val !!}</div>
                    </li>
                  @else
                    <li>
                      <div class="allow-btn">
                        <div class="onoffswitch">
                          <input type="checkbox" name="allow_permissions[]" class="onoffswitch-checkbox file-name" id="allow_permissions_{{ $i }}" value="{{ $key }}">
                          <label class="onoffswitch-label" for="allow_permissions_{{ $i }}">
                            <span class="onoffswitch-inner"></span>
                            <span class="onoffswitch-switch"></span>
                          </label>
                        </div>
                      </div>
                      <div class="permissions-file-name">{!! $val !!}</div>
                    </li>
                  @endif
                  <?php $i++;?>
                @endforeach
                <li>
                  <div class="allow-btn">
                    <div class="onoffswitch">
                      @if(in_array('all_checkbox_enable', $user_roles_details->permissions))  
                      <input type="checkbox" checked="checked" name="allow_permissions_all" class="onoffswitch-checkbox" id="allow_permissions_all" value="all_checkbox_enable">
                      @else
                      <input type="checkbox" name="allow_permissions_all" class="onoffswitch-checkbox" id="allow_permissions_all" value="all_checkbox_enable">
                      @endif
                      <label class="onoffswitch-label" for="allow_permissions_all">
                        <span class="onoffswitch-inner"></span>
                        <span class="onoffswitch-switch"></span>
                      </label>
                    </div>
                  </div>
                  <div class="permissions-file-name">{!! trans('admin.access_list_allow_for_all') !!}</div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>  
    </div>
  </div>
  
</form>

@endsection