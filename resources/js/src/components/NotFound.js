import React from 'react';
import ReactDOM from 'react-dom';
import {
    Link
} from 'react-router-dom';
function NotFound404() {
    return (

        <div className="vh-100 flex " style={{ backgroundColor:"#696969"}} >
            <div className="row justify-content-center align-items-center pt-5" style={{ height: "100%" }}>
                <div className="col-md-12 px-5 text-center ">
                    <h1 className="text-center display-4">Got Lost ?</h1>
                    <h6 className="text-center">Theres nothing here ...</h6>
                    
                    <Link to={"/"} className=" p-3 btn btn-lg btn-secondary  border-dark">Go Back To Homepage</Link>
                </div>
            </div>
        </div>
    );
}

export default NotFound404;
