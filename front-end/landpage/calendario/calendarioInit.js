calendar = new Calendar("calendarContainer", "small", [ "Domingo", "1" ], [ "#ffc107", "#ffa000", "#ffffff", "#ffecb3" ]); // calendar container, size, array of first day of the week, and the number of letters for the week days ( max of 3 min of 1 ), colors... i would suggest using materialpalette.com
organizer = new Organizer("organizerContainer", calendar); // organizer container and the calendar object to associate it to

currentDay = calendar.date.getDate(); // used this in order to make anyday today depending on the current today

// my best way of organizing data, maybe that can be the outcome of joining multiple tables in the database and then parsing them in such a manner, easier for the person to push use a date and the events of it
data = {
years: [
{
int: 1999,
months: [
    {
    int: 4,
    days: [
        {
        int: 28,
        events: [
            {
            startTime: "6:00",
            endTime: "6:30",
            mTime: "pm",
            text: "Weirdo was born"
            }
        ]
        }
    ]
    }
]
},
{
int: (new Date().getFullYear()),
months: [
    {
    int: (new Date().getMonth() + 1),
    days: [
        {
        int: (new Date().getDate()),
        events: [
            {
            startTime: "6:00",
            endTime: "7:00",
            mTime: "am",
            text: "This is scheduled to show today, anyday."
            },
            {
            startTime: "5:45",
            endTime: "7:15",
            mTime: "pm",
            text: "WIP Library"
            },
            {
            startTime: "10:00",
            endTime: "11:00",
            mTime: "pm",
            text: "Probably won't fix that (time width)"
            },
            {
            startTime: "8:00",
            endTime: "9:00",
            mTime: "pm",
            text: "Next spam is for demonstration purposes only"
            },
            {
            startTime: "5:45",
            endTime: "7:15",
            mTime: "pm",
            text: "WIP Library"
            },
            {
            startTime: "10:00",
            endTime: "11:00",
            mTime: "pm",
            text: "Probably won't fix that (time width)"
            },
            {
            startTime: "5:45",
            endTime: "7:15",
            mTime: "pm",
            text: "WIP Library"
            },
            {
            startTime: "10:00",
            endTime: "11:00",
            mTime: "pm",
            text: "Probably won't fix that (time width)"
            },
            {
            startTime: "5:45",
            endTime: "7:15",
            mTime: "pm",
            text: "WIP Library"
            },
            {
            startTime: "10:00",
            endTime: "11:00",
            mTime: "pm",
            text: "Probably won't fix that (time width)"
            },
            {
            startTime: "5:45",
            endTime: "7:15",
            mTime: "pm",
            text: "WIP Library"
            },
            {
            startTime: "10:00",
            endTime: "11:00",
            mTime: "pm",
            text: "Probably won't fix that (time width)"
            },
            {
            startTime: "5:45",
            endTime: "7:15",
            mTime: "pm",
            text: "WIP Library"
            },
            {
            startTime: "10:00",
            endTime: "11:00",
            mTime: "pm",
            text: "Probably won't fix that (time width)"
            }
        ]
        }
    ]
    }
]
}
]
};

showEvents(); // list events of today, when calendar loads

callback = function () {
showEvents();
}

organizer.setOnClickListener('day-slider', callback, callback); // first callback is for the back slider, second is for the next slider
organizer.setOnClickListener('days-blocks', callback, null); // only needed callback is the first, no back or next, last parameter is ignored
organizer.setOnClickListener('month-slider', callback, callback); // first callback is for the back slider, second is for the next slider
organizer.setOnClickListener('year-slider', callback, callback); // first callback is for the back slider, second is for the next slider

// a way to show the events of a date after retrieving the data from the database
function showEvents() {
theYear = -1, theMonth = -1, theDay = -1;

for (i = 0; i < data.years.length; i++) {
if (calendar.date.getFullYear() == data.years[i].int) {
theYear = i;
break;
}
}

if (theYear == -1) return;

for (i = 0; i < data.years[theYear].months.length; i++) {
if ((calendar.date.getMonth() + 1) == data.years[theYear].months[i].int) {
theMonth = i;
break;
}
}

if (theMonth == -1) return;

for (i = 0; i < data.years[theYear].months[theMonth].days.length; i++) {
if (calendar.date.getDate() == data.years[theYear].months[theMonth].days[i].int) {
theDay = i;
break;
}
}

if (theDay == -1) return;

theEvents = data.years[theYear].months[theMonth].days[theDay].events;  

organizer.list(theEvents);
}
