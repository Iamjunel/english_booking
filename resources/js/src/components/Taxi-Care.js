import React from 'react';
import {
    Link
} from 'react-router-dom';
const TaxiCare= () =>{
    return (
        <div className="vh-100 flex " style={{backgroundColor:"#1885f5ad"}}>
            <div className="row justify-content-center pt-5" style={{height:"100%"}}>
                <div className="col-md-3 m-3">
                    <Link to={"/care-taxi/booking"} className=" p-3 btn btn-lg btn-secondary text-dark btn-block border-dark">利用可能なスロット/登録</Link>
                    <Link to={"/care-taxi/company/edit"} className=" p-3 btn btn-lg btn-secondary text-dark btn-block border-dark">会社情報/編集</Link>
                </div>
            </div>
        </div>
    );

}

export default TaxiCare;