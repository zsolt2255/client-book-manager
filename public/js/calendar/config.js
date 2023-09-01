export const calendarConfig = {
    editable: false,
    allDaySlot: false,
    events: config.routes.index,
    displayEventTime: false,
    header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay'
    },
    selectable: true,
    selectHelper: true
};
