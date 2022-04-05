import React, { useEffect, useState } from 'react';
import { Button, Modal } from 'react-bootstrap';
import { BsFillArrowLeftSquareFill } from 'react-icons/bs';
import {
    Link
} from 'react-router-dom';
import DatePicker, { DateObject } from "react-multi-date-picker";
import DatePanel from "react-multi-date-picker/plugins/date_panel";
import config from '../../config';
import TimeSelect from './TimeSelect';

const CompanyUpdate= () =>{
    const [show, setShow] = useState(false);

    const handleClose = () => setShow(false);
    const handleShow = () => setShow(true);
    const [data, setData] = useState([]);
    const [holiday, setHolidays] = useState([]);
    const  id = 5;
    const [fields, setFields] = useState({
        name: "",
        cid: "",
        holidays: holiday,
        mon_start:"",
        cpass:"",
        email:"",
        fax:"",
        has_helper:"",
        has_nursing:"",
        has_oxygen:"",
        has_ventilator:"",
        phone:"",
        notes:"",
        hp:"",

    });

    
    useEffect(() => {
        window.addEventListener('mousemove', () => { });
        config.getCompanyById(id)
            .then(res => {
                console.log(res);
                setFields(res.data.data);
            })
        return () => {
            // componentWillUnmount events
        }
    }, []);

    function handleTimeChange(e, field_name) {
       /*  if(field_name == "mon_start"){
            fields.mon_start = e.target.value;
        }
        console.log(); */
            //setFields({ mon_start : e.target.value});
        //console.log(fields);
    }
    function handleHpChange(e) {
    
        setFields({ hp: e.target.value });
        //setFields({ mon_start : e.target.value});
        //console.log(fields);
    }
    function handleEmailChange(e) {

        setFields({ email: e.target.value });
        //setFields({ mon_start : e.target.value});
        console.log(fields);
    }
    function handlePhoneChange(e) {

        setFields({ phone: e.target.value });
        //setFields({ mon_start : e.target.value});
        console.log(fields);
    }
    function handleNameChange(e) {

        setFields({ name: e.target.value });
        //console.log(fields);
    }

    async function handleSubmit(e) {
        e.preventDefault();

        try {
            //setLoading("saving");

            let formData = new FormData();
            formData.append("name", fields.name);
            formData.append("cid", fields.cid);
            formData.append("cpass", fields.cpass);
            formData.append("email", fields.email);
            formData.append("phone", fields.phone);
            formData.append("hp", fields.hp);
            formData.append("holidays", holiday);
            formData.append("mon_start", fields.mon_start);
            console.log(formData);
            const res = await config.updateCompanyById(id,formData);
            console.log(res);
            /* if (res?.status == 200) {
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
            } else {
                setMessage(res.data.message);
            } */
        } catch (error) {
            console.log("error:", error);
        }
    }
    return (
        <div className="vh-100 vw-100" style={{backgroundColor:"#1885f5ad",overflow:"auto"}}>
            <div className="row justify-content-center align-items-center p-5">
                <div >
                    <div className="col-md-12 col-sm-12 clearfix">
                        <h2 className="float-left"><Link to={'/taxi-care'} className="text-dark pr-2"><BsFillArrowLeftSquareFill /></Link>会社情報</h2>
                        <form onSubmit={handleSubmit}>
                            <input type="submit" className="btn btn-primary float-right" value="アップデート" />
                        <table className="table table-striped bg-white table-bordered p-1 ">
                            <thead>
                               
                            </thead>
                            <tbody>
                                <tr>
                                    <th>ID</th>
                                    <th><input type="text" value={fields.cid} /></th>
                                </tr>
                                <tr>
                                    <td>パスワード</td>
                                        <td><input type="password" value={fields.cpass} /></td>
                                </tr>
                                <tr>
                                    <td>電子メールアドレス</td>
                                        <td><input type="text" value={fields.email} onChange={handleEmailChange} /></td>

                                </tr>
                                <tr>
                                    <td>電話番号</td>
                                        <td><input type="text" value={fields.phone} onChange={handlePhoneChange}/></td>

                                </tr>
                                <tr>
                                    <td>キャブ名</td>
                                        <td><input type="text" value={fields.name} onChange={handleNameChange} /></td>

                                </tr>
                                <tr>
                                    <td>休日</td>
                                        <td><DatePicker
                                            value={fields.holidays}
                                            onChange={setHolidays}
                                            format="MM/DD/YYYY"
                                            multiple
                                            plugins={[
                                                <DatePanel markFocused />
                                            ]}
                                        />
                                        </td>

                                </tr>
                                <tr>
                                    <td>ページ</td>
                                        <td><input type="text" value={fields.hp} onChange={handleHpChange} /></td>

                                </tr>
                                <tr>
                                        <td className="align-middle">営業時間</td>
                                        <td className="p-1 m-0 pb-2" style={{ width: "400px" }}>
                                            <tr>
                                                <td style={{width:"100px"}}>月曜日</td>
                                                <td></td> <td>~</td> 
                                                <td>
                                                    <select name="mon_end" >
                                                        
                                                        
                                                </select></td>
                                            </tr>
                                            <tr>
                                                <td>火曜日</td>
                                                <td><input type="time" /></td> <td>~</td> <td><input type="time" /></td>
                                            </tr>
                                            <tr>
                                                <td>結婚した</td>
                                                <td><input type="time" /></td> <td>~</td> <td><input type="time" /></td>
                                            </tr>
                                            <tr>
                                                <td>木曜</td>
                                                <td><input type="time" /></td> <td>~</td> <td><input type="time" /></td>
                                            </tr>
                                            <tr>
                                                <td>金</td>
                                                <td><input type="time" /></td> <td>~</td> <td><input type="time" /></td>
                                            </tr>
                                            <tr>
                                                <td>土</td>
                                                <td><input type="time" /></td> <td>~</td> <td><input type="time" /></td>
                                            </tr>
                                            <tr>
                                                <td>太陽</td>
                                                <td><input type="time" /></td> <td>~</td> <td><input type="time" /></td>
                                            </tr>
                                        </td>

                                </tr>

                                
                            </tbody>
                        </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    );

}

export default CompanyUpdate;