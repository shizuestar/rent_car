function showAlert(type, message, callback = null) {
    if (type === 'success') {
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });

        return Toast.fire({
            icon: "success",
            title: message
        });
    } 
    else if (type === 'error') {
        return Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: message || 'Terjadi kesalahan!',
            confirmButtonColor: '#3f51b5'
        });
    }
    else if (type === 'delete-confirm') {
        return Swal.fire({
            title: "Apakah Anda yakin ingin hapus data ini?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, lanjutkan",
            cancelButtonText: "Batal",
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                const formId = `#delete-${message}`;
                document.querySelector(formId).submit();
            }
        });
    }
}