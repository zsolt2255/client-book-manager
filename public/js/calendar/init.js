import { calendarConfig } from "./config.js";
import { EventHandling } from "./event_handling.js";

export const CalendarManager = {
    calendar: null,

    initCalendar: function() {
        this.calendar = $('#calendar').fullCalendar(calendarConfig);

        this.calendar.fullCalendar('option', 'eventClick', EventHandling.handleEventDrop);
        this.calendar.fullCalendar('option', 'select', EventHandling.handleEventClick);
    },
};
