import { height } from 'dom-helpers';
import { useImperativeHandle } from 'preact/hooks';
import React, { useEffect, useState } from 'react';
import { Button, Modal } from 'react-bootstrap';
import { BsFillArrowLeftSquareFill } from 'react-icons/bs';
import { FaHome } from 'react-icons/fa';

import {
    Link
} from 'react-router-dom';


const BookingUpdate= () =>{

    return (
        <div className="vh-100 vw-100" style={{backgroundColor:"#1885f5ad"}}>
            <div className="row justify-content-center align-items-center p-5">
                <div >
                    <div className="col-md-12 col-sm-12">
                        <h2 className="text-center"><Link to={'/taxi-care/booking/date'} className="text-dark pr-2"><BsFillArrowLeftSquareFill /></Link><Link to={'/taxi-care'} className="text-dark pr-1"><FaHome /></Link>Booking Calendar By Date</h2>
                        <div className="row">

                            <div className="col-md-12 bg-white">
                                Update successfully
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    );

}

export default BookingUpdate;