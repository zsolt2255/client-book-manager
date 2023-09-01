import { CalendarManager } from "./init.js";

const Methods = {
    createClickEvent: function(start, end) {
        const startDate = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
        const endDate = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
        const title = $('#event_name').val();

        $.ajax({
            url: config.routes.store,
            data: {
                title: title,
                start: startDate,
                end: endDate
            },
            type: "POST",
            success: function (data) {
                Methods.displaySuccessMessage('Event Created Successfully!');

                CalendarManager.calendar.fullCalendar('renderEvent', {
                    id: data.id,
                    title: title,
                    start: start,
                    end: end
                }, true);

                CalendarManager.calendar.fullCalendar('unselect');
            },
            error: function (request, status, error) {
                let response = JSON.parse(request.responseText);

                Methods.displayErrorMessage(response.message);
            }
        });
    },
    deleteEvent: function(event) {
        const startDate = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
        const endDate = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
        const url = config.routes.destroy.replace('null', event.id);

        $.ajax({
            url: url,
            data: {
                title: event.title,
                start: startDate,
                end: endDate,
                id: event.id,
            },
            type: "DELETE",
            success: function (data) {
                CalendarManager.calendar.fullCalendar('removeEvents', event.id);
            },
            error: function (data) {
                Methods.displayErrorMessage('Error during deletion!');
            }
        });
    },
    displaySuccessMessage: function (message) {
        toastr.success(message, 'System');
    },
    displayErrorMessage: function (message) {
        toastr.error(message, 'System');
    }
};

export { Methods };
