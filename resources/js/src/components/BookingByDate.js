import { height } from 'dom-helpers';
import { useImperativeHandle } from 'preact/hooks';
import React, { useEffect, useState } from 'react';
import { Button, Modal } from 'react-bootstrap';
import { BsFillArrowLeftSquareFill } from 'react-icons/bs';
import { FaHome } from 'react-icons/fa';

import {
    Link
} from 'react-router-dom';
const  BookingByDate = () =>{

    return (
        <div className="vh-100 vw-100" style={{ backgroundColor: "#1885f5ad",overflowY:"auto" }}>
            <div className="row justify-content-center align-items-center p-5">
                <div >
                    <div className="col-md-12 col-sm-12">
                        <h2 className="text-center"><Link to={'/taxi-care/booking'} className="text-dark pr-2"><BsFillArrowLeftSquareFill /></Link><Link to={'/taxi-care'} className="text-dark pr-1"><FaHome /></Link>Booking Calendar By Date</h2>
                        <div className="row" >

                            <div className="col-md-12 bg-white" >
                                <table className="table table-striped bg-white table-bordered p-1 ">
                                    <thead>
                                        <tr>
                                            <th style={{ width: '10%' }}>Time</th> 
                                            <th>Status</th>
                                            <th>Comment</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style={{ width: '10%' }}>6:00</td> <td></td>
                                        </tr>    
                                        <tr>
                                            <td>6:30</td> <td></td>
                                        </tr>
                                        <tr>
                                            <td>7:00</td> <td></td>
                                        </tr>
                                        <tr>
                                            <td>7:30</td> <td></td>
                                        </tr>
                                        <tr>
                                            <td>8:00</td> <td></td>
                                        </tr>
                                        <tr>
                                            <td>8:30</td> <td></td>
                                        </tr>
                                        <tr>
                                            <td>9:00</td> <td></td>
                                        </tr>
                                        <tr>
                                            <td>9:30</td> <td></td>
                                        </tr>
                                        <tr>
                                            <td>10:00</td> <td></td>
                                        </tr>
                                        <tr>
                                            <td>10:30</td> <td></td>
                                        </tr>
                                        <tr>
                                            <td>11:00</td> <td></td>
                                        </tr>
                                        <tr>
                                            <td>11:30</td> <td></td>
                                        </tr>
                                        <tr>
                                            <td>12:00</td> <td></td>
                                        </tr>
                                        <tr>
                                            <td>12:30</td> <td></td>
                                        </tr>
                                        <tr>
                                            <td>13:00</td> <td></td>
                                        </tr>
                                        <tr>
                                            <td>13:30</td> <td></td>
                                        </tr>
                                        <tr>
                                            <td>14:00</td> <td></td>
                                        </tr>
                                        <tr>
                                            <td>14:30</td> <td></td>
                                        </tr>
                                        <tr>
                                            <td>15:00</td> <td></td>
                                        </tr>
                                        <tr>
                                            <td>15:30</td> <td></td>
                                        </tr>
                                        <tr>
                                            <td>16:00</td> <td></td>
                                        </tr>
                                        <tr>
                                            <td>16:00</td> <td></td>
                                        </tr>
                                        <tr>
                                            <td>16:30</td> <td></td>
                                        </tr>
                                        <tr>
                                            <td>17:00</td> <td></td>
                                        </tr>
                                        <tr>
                                            <td>17:30</td> <td></td>
                                        </tr>
                                        <tr>
                                            <td>18:00</td> <td></td>
                                        </tr>
                                        <tr>
                                            <td>18:30</td> <td></td>
                                        </tr>
                                       
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    );

}

export default BookingByDate;