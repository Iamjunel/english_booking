
import { format } from 'date-fns';
import React, { useEffect, useState } from 'react';
import { useHistory } from "react-router-dom";
import Calendar from 'react-calendar';
import 'react-calendar/dist/Calendar.css';

const CalendarBooking = (props) => {
    let history = useHistory();
    const [pointerEvent, setPointerEvent] = useState(false);
    const [date, setDate] = useState(new Date());
    const [user, setUser] = useState(props.user);
    
   /*  const disabledDates = [in3Days, in5Days];

    function tileDisabled({ date, view }) {
        // Disable tiles in month view only
        if (view === 'month') {
            // Check if a date React-Calendar wants to check is on the list of disabled dates
            return disabledDates.find(dDate => isSameDay(dDate, date));
        }
    } */
    function routeChange(date){
       // if(pointerEvent){
            console.log(date.getDate());
            console.log(user);
        ///}
        var $this_date = format(new Date(), 'yyyy-MM-dd');
        if(user == 'taxi'){
            history.push(`/taxi-care/booking/date`);
        }else{
            history.push(`/slot/date/` + $this_date);
        }
    }
    
    return (
        <div className="col-md-12 col-sm-12" >
            
            <div className='calendar-container'>
                <Calendar         onChange={routeChange}
                                  value={date}
                                  minDate = {new Date()}
                                  minDetail='month'
                                  prev2Label = {null}
                                  next2Label={null}
                                 />
                    </div>
        </div>
    );

}

export default CalendarBooking;