import { useEffect, useState } from 'react';
import { BsFillArrowLeftSquareFill } from 'react-icons/bs';
import {
    Link
} from 'react-router-dom';
import config from '../../config';
import Alert from 'react-bootstrap/Alert';
const CompanyRegistration = () => {

    const [fields, setFields] = useState({
        name: "",
        cid: "",
        password: "",

    });
    const [message, setMessage] = useState("");
    const [showAlert, setShowAlert] = useState(false);
    function onChangeCompanyName(e) {
        setFields(prev => ({ ...prev, name: e.target.value }))
    }

    function onChangeCid(e) {
        setFields(prev => ({ ...prev, cid: e.target.value }))
    }

    function onChangePassword(e) {
        setFields(prev => ({ ...prev, password: e.target.value }))
    }

    /* useEffect(() => {
        setFields({
            name: "",
            cid: "",
            password: "",

        });
        console.log(fields);
    }, []); */

    async function handleSubmit(e) {
        e.preventDefault();
       
        try {
            //setLoading("saving");

            let formData = new FormData();
            formData.append("name", fields.name);
            formData.append("cid", fields.cid);
            formData.append("password", fields.password);
            console.log(formData);
            const res = await config.addCompany(formData);
            console.log(res);
            if (res?.status == 200) {
                setFields({
                    name: "",
                    cid: "",
                    password: "",

                });
                setShowAlert(true);
                setMessage(res.data.message);
                    const timer = setTimeout(() => {
                        setShowAlert(false);
                    }, 2000);
                    return () => clearTimeout(timer);
            }else{
                setMessage(res.data.message);
            } 
        } catch (error) {
           console.log("error:", error);
       }
 } 
  //  
    return (
        <div className="vh-100 vw-100" style={{ backgroundColor: "rgb(231 226 190 / 38%)" }}>
            <div className="row justify-content-center align-items-center m-1 pt-5" style={{ overflow: "auto" }}>
                <div>
                    <div className="container">
                        {showAlert &&
                            <Alert variant="success">
                                <p>
                                    {message}
                                </p>
                            </Alert>
                        }
                    </div>
                    <div className="col-md-12 col-sm-12 clearfix">
                        <h2><Link to={'/admin'} className="text-dark mr-1"><BsFillArrowLeftSquareFill /></Link>会社を登録する</h2>
                        <form onSubmit={handleSubmit}>
                            <div className="mb-2">
                                <label className="form-label">会社名:</label>
                                <input type="text" name="company_name" className="form-control" id="exampleInputEmail1" onChange={onChangeCompanyName} value={fields.name}/>
                            </div>
                            <div className="mb-2">
                                <label className="form-label">ID:</label>
                                <input type="type" name="id" className="form-control" id="exampleInputEmail2" onChange={onChangeCid} value={fields.cid}/>
                            </div>
                            <div className="mb-2">
                                <label className="form-label">パスワード:</label>
                                <input type="password" className="form-control" id="exampleInputPassword1" onChange={onChangePassword} value={fields.password}/>
                            </div>
                            <div className="mb-2">
                                <input type="submit" className="btn btn-block btn-secondary text-center" value="登録" />
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
            
        </div>
        
    );

}

export default CompanyRegistration;