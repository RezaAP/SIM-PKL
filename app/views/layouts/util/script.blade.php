<script src="{{ base_url('assets/') }}vendor/jquery/jquery.min.js"></script>
<script src="{{ base_url('assets/') }}vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="{{ base_url('assets/') }}vendor/jquery-easing/jquery.easing.min.js"></script>

<script src="{{ base_url('assets/') }}js/sb-admin-2.min.js"></script>

<script src="{{ base_url('assets/') }}vendor/datatables/datatables.min.js"></script>

<script>
    if($('.content-datatable').length){
        $('.content-datatable').DataTable()
    }

    $(document).on('change','[name=status]', function(){
        window.location.href = '{{ current_url() }}?status='+$(this).val()

    })

    let params = new URLSearchParams(window.location.search);
    let status = params.get('status')? params.get('status') : ''

    $('[name=status]').val(status)

    let exportUrl = $('#btn-export').attr('href')

    $('#btn-export').attr('href',exportUrl+'?status='+status)

</script>

@stack('js')

</body>

</html>