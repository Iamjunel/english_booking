import { height } from 'dom-helpers';
import { useImperativeHandle } from 'preact/hooks';
import React, { useEffect, useState } from 'react';
import { Button, Modal } from 'react-bootstrap';
import { BsFillArrowLeftSquareFill } from 'react-icons/bs';
import {
    Link
} from 'react-router-dom';
import CalendarBooking from './calendar/calendar';
const Booking = () =>{

    const [show, setShow] = useState(false);

    const handleClose = () => setShow(false);
    const handleShow = () => setShow(true);
    const [date, setDate] = useState(new Date());
    return (
        <div className="vh-100 vw-100" style={{ backgroundColor: "#1885f5ad" }}>
            <div className="row justify-content-center align-items-center p-5">
                <div >
                    <CalendarBooking user='taxi'/>
                </div>
            </div>
        </div>
    );

}

export default Booking;