{{ $slot }}
<form id="send_file" action="/upload_file" method="post">
    {{ @csrf_field() }} 
{{ method_field('POST') }}
    <label class="btn"> Select a CSV file
    <input name="file" type="file" id="file" placeholder="File">
    <br>
    <br>
    <button type="submit" class="{{ $class_fieldset }}">Send File CSV</button>
</form>