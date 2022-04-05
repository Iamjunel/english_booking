
import React, { useEffect, useState } from 'react';
import { Form, Button, FormGroup, FormControl, ControlLabel, Modal } from "react-bootstrap";
import { BsFillArrowLeftSquareFill } from 'react-icons/bs';
import { FaHome } from 'react-icons/fa';

import {
    Link
} from 'react-router-dom';
import CalendarBooking from './calendar/calendar';
const UserAvailableSlotDetail = () => {


    return (
        <div className="vh-100 vw-100">
            <div className="row justify-content-center align-items-center m-1 pt-5" style={{ overflow: "auto" }}>
                <div >
                    <div className="col-md-12 col-sm-12">
                        <h2 className="text-center"><Link to={'/'} className="text-dark pr-2"><BsFillArrowLeftSquareFill /></Link>Available Slot</h2>
                        <div className="row justify-content-center align-items-center">
                            <Form>
                                {['checkbox'].map((type) => (
                                    <div key={`inline-${type}`} className="mt-4
                                    mb-3">
                                        <Form.Check
                                            inline
                                            label="Nursing/caregiving"
                                            name="group1"
                                            type={type}
                                            id={`inline-${type}-1`}
                                        />
                                        <Form.Check
                                            inline
                                            label="helper"
                                            name="group1"
                                            type={type}
                                            id={`inline-${type}-2`}
                                        />
                                        <Form.Check
                                            inline
                                            label="ventilator"
                                            type={type}
                                            id={`inline-${type}-3`}
                                        />
                                        <Form.Check
                                            inline
                                            label="oxygen"
                                            type={type}
                                            id={`inline-${type}-3`}
                                        />
                                    </div>
                                ))}
                            </Form>
                        </div>
                        <div className="row">
                            <CalendarBooking user="user"/>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    );

}

export default UserAvailableSlotDetail;