require('./bootstrap');
window.Swal = require('sweetalert2');
window.$ = window.jQuery = require('jquery');

module.exports = delete_action = (e) => {
    e.preventDefault();

    Swal.fire({
        title: 'Estas seguro!',
        text: 'Estas eguro de eliminar este registro ?',
        type: 'info',
        showCancelButton: true,
        confirmButtonColor: 'hsl(120, 50%, 50%, 1)',
        cancelButtonColor: 'hsl(0, 50%, 50%, 1)',
        confirmButtonText: 'Yes !! '
    }).then(({value}) => {
        if (value) {
            e.target.form.submit()
        }
    })
};
