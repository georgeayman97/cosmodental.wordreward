<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $('.processed').each((index, span) => {
        span.className += ' badge-primary'
    })
    $('.rejected').each((index, span) => {
        span.className += ' badge-danger'
    })
    $('.accepted').each((index, span) => {
        span.className += ' badge-success'
    })
    $('.pending').each((index, span) => {
        span.className += ' badge-warning'
    })

    const yesOrNo = () => {
        return new Promise(resolve => {
            Swal.fire({
                title: 'Are you sure?',
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!'
            }).then((result) => {
                if (result.isConfirmed)
                    resolve()
            })
        })
    }

    const postAccept = id => fetch("{{ route('transactions.accept') }}", {
        method: 'POST',
        body: new URLSearchParams({
            "id": id,
            "_token": "{{ csrf_token() }}"
        })
    })

    const postReject = id => fetch("{{ route('transactions.reject') }}", {
        method: 'POST',
        body: new URLSearchParams({
            "id": id,
            "_token": "{{ csrf_token() }}"
        })
    })

    document.querySelectorAll('.acceptTransaction').forEach(button => {
        button.addEventListener('click', async () => {
            await yesOrNo()
            await postAccept(button.value)
            location.reload()
        })
    })
    document.querySelectorAll('.rejectTransaction').forEach(button => {
        button.addEventListener('click', async () => {
            await yesOrNo()
            await postReject(button.value)
            location.reload()
        })
    })
</script>