var today = new Date();

$("#dateFrom").flatpickr(

    {
        enableTime: true,
        dateFormat: "d.m.Y H:i",
        allowInput: true,
        minDate: today,
        locale: 'sk',

    }
);

$("#dateTo").flatpickr(
    {
        enableTime: true,
        dateFormat: "d.m.Y H:i",
        allowInput: true,
        locale: 'sk',
        minDate: today,

    }
);


