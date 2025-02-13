
@props(['name', 'reload' => false, 'dashboard' => 'administrator'])

<script>
    function confirmDestroy(id, reference) {
        Swal.fire({
            title: 'هل انت متاكد؟',
            text: "انت تريد حذف هذا العنصر!",
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'الغاء',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'حذف'
        }).then((result) => {
            if (result.isConfirmed) {
                destroy(id, reference);
            }
        })
    }

    function destroy(id, reference) {
        axios.delete('/{{ $dashboard }}/{{ $name }}/' + id)
            .then(function(response) {
                // handle success
                console.log(response);
                if(reference.closest('tr')){
                    reference.closest('tr').remove();
                }
                showMessage(response.data)
                setTimeout(() => {
                    @if($reload)
                window.location.reload();
                @endif
                }, 1500);
            })
            .catch(function(error) {
                // handle error
                console.log(error);
                showMessage(error.response.data);
            })
            .then(function() {
                // always executed
            });
    }

    function showMessage(data) {
        Swal.fire({
            icon: data.icon,
            title: data.title,
            showConfirmButton: false,
            timer: 1000
        })
    }
</script>
