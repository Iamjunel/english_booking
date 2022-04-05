

import React from 'react';
import {
    Link
} from 'react-router-dom';
const Admin= () =>{

    return (
        <div className="vh-100 flex " style={{ backgroundColor:"rgb(231 226 190 / 38%)"}}>
            <div className="row justify-content-center pt-5" style={{height:"100%"}}>
                <div className="col-md-3 m-3">
                    <Link to={"/admin/company/register"} className=" p-3 btn btn-lg btn-outline  text-dark btn-block border-dark">新規登録</Link>
                    <Link to={"/admin/company"} className=" p-3 btn btn-lg btn-outline text-dark  btn-block border-dark">会社リスト</Link>
                </div>
            </div>
        </div>  
    );

}

export default Admin;
 