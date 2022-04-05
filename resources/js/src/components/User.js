import React from 'react';
import ReactDOM from 'react-dom';
import {
    Link
} from 'react-router-dom';
function User() {
    return (

        <div className="vh-100 flex " >
            <div className="row justify-content-center pt-5" style={{height:"100%"}}>
                <div className="col-md-3 m-3">
                    <Link to={"/slot"} className=" p-3 btn btn-lg btn-secondary text-dark btn-block border-dark">To check available slots</Link>
                    <Link to={"/company"} className=" p-3 btn btn-lg btn-secondary text-dark btn-block border-dark">Company List</Link>
                </div>
            </div>
        </div>
    );
}

export default User;
