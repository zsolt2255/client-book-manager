import { Methods } from './methods.js'

const EventHandling = {
    handleEventClick: (start, end) => {
        Swal.fire({
            html: '<div class="mb-7"><h1>Create new event?</h1></div><div class="fw-bold mt-3 mb-3">Event Name:</div><input type="text" class="form-control" id="event_name" name="event_name"/>',
            icon: "info",
            showCancelButton: true,
            buttonsStyling: false,
            customClass: {
                confirmButton: "btn btn-primary",
                cancelButton: "btn btn-active-light"
            }
        }).then(result => {
            if (result.value) {
                Methods.createClickEvent(start, end);
            }
        });
    },

    handleEventDrop: function(event) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                Methods.deleteEvent(event);
                Swal.fire(
                    'Deleted!',
                    'The date has been cancelled.',
                    'success'
                )
            }
        })
     },
};

export { EventHandling };
