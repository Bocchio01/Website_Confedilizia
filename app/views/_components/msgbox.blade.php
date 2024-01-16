<style>
    .message-box {
        border: 2px solid;
        padding: 20px;

        border-radius: 15px;

        color: rgb(1156, 101, 0);
        background-color: rgb(255, 235, 156);
        border-color: rgb(1156, 101, 0);
    }

    .message-box-error {
        color: rgb(156, 0, 6);
        background-color: rgb(255, 199, 206);
        border-color: rgb(156, 0, 6);
    }

    .message-box-success {
        color: rgb(0, 97, 0);
        background-color: rgb(198, 239, 206);
        border-color: rgb(0, 97, 0);
    }
</style>

<div id="store-msgbox" class="message-box message-box-{{ $type }}">
    @if($type == 'success')
    <h4>Operazione completata</h4>
    @else
    <h2>Errore</h2>
    @endif

    @foreach ($messages as $message)
    <p>{{ $message }}</p>
    @endforeach
</div>

<script>
    function displayMsgBox() {
        document.getElementById('store-msgbox').style.
    }
</script>