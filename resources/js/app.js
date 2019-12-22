require('./bootstrap');
window.Swal = require('sweetalert2');
window.$ = window.jQuery = require('jquery');
window.toastr = require("toastr");
window.jsPDF = require('jspdf'); 

toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": false,
    "progressBar": false,
    "positionClass": "toast-top-right",
    "preventDuplicates": false,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
}

window.notification = (type, message) => {
    switch(type){
        case 'info':
            //toastr["success"]("My name is Inigo Montoya. You killed my father. Prepare to die!", "hi carlos")
            toastr.info(message);
            break;

        case 'warning':
            toastr.warning(message);
            break;

        case 'success':
            toastr.success(message);
            break;

        case 'error':
            toastr.error(message);
            break;
    }
}


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
