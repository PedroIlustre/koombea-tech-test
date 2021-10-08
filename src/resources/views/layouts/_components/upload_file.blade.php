{{ $slot }}
<form id="send_file" action='{{ route("upload_file") }}' enctype="multipart/form-data" method="post">
    {{ @csrf_field() }} 
{{ method_field('POST') }}
    <label class="btn"> Select a CSV file
    <input name="file_uploaded" type="file" id="file_uploaded" placeholder="File">
    <br>
    <br>
    <button type="submit" class="{{ $class_fieldset }}">Upload File (CSV)</button>
</form>