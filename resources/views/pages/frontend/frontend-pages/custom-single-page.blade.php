@section('custom-single-page-content')
<div id="custom_single_page">
  <div class="container">
    {!! string_decode($page_data->post_content) !!}
  </div>
</div>
@endsection