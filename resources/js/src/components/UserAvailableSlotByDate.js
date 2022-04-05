
import React, { useEffect, useState } from 'react';
import { Button, Modal } from 'react-bootstrap';
import { BsFillArrowLeftSquareFill } from 'react-icons/bs';
import { FaHome } from 'react-icons/fa';

import {
    Link
} from 'react-router-dom';
const UserAvailableSlotByDate = () => {


    return (
        <div className="vh-100 vw-100">
            <div className="row justify-content-center align-items-center m-1 pt-5" style={{ overflow: "auto" }}>
                <div>
                    <div className="col-md-12 col-sm-12">
                        <h2 className="text-center"><Link to={'/slot'} className="text-dark pr-2"><BsFillArrowLeftSquareFill /></Link>Available Slot By Date</h2>
                        <div className="row">
                            <div className="col-md-12 bg-primary">
                                <Link to={'/slot/contact'} className="text-dark pr-2">Contact Detail Page</Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );

}

export default UserAvailableSlotByDate;