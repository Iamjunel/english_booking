import React from 'react';

const DeleteCompany = () =>{

    return (
        <div className="vh-100 vw-100" style={{backgroundColor:"#ffff004a"}}>
            <div className="row justify-content-center align-items-center p-5">
                <div className="container">
                    
                    <div className="col-md-12 clearfix">
                    <h2 className="float-left">Company List</h2>
                    <a href="#" className="btn btn-primary float-right">Add Company</a>
                        <table className="table table-striped bg-white table-bordered ">
                        <tr className="text-center">
                            <th>Company Name</th>
                            <th>ID</th>
                            <th>Password</th>
                            <th>Actions</th>
                        </tr>
                        <tr>
                            <td>Genno Company</td>
                            <td>GEnno The grear</td>
                            <td>alalang</td>
                            <td><button className="btn btn-danger">Delete</button></td>
                        </tr>
                        <tr>
                            <td>Genno Company</td>
                            <td>GEnno The grear</td>
                            <td>alalang</td>
                            <td><button className="btn btn-danger">Delete</button></td>
                        </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    );

}

export default DeleteCompany;