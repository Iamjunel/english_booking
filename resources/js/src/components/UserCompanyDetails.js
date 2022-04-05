
import React, { useEffect, useState } from 'react';
import { Button, Modal } from 'react-bootstrap';
import { BsFillArrowLeftSquareFill } from 'react-icons/bs';
import { FaHome } from 'react-icons/fa';
import { useParams } from 'react-router-dom';
import { Zoom } from 'react-slideshow-image';
import 'react-slideshow-image/dist/styles.css'
import config from '../config';
import {
    Link
} from 'react-router-dom';

const UserCompanyDetails = () => {
    const { id } = useParams();
    const [data, setData] = useState([]);
    const images = [
        'images/slide_2.jpg',
        'images/slide_3.jpg',
        'images/slide_4.jpg',
        'images/slide_5.jpg',
        'images/slide_6.jpg',
        'images/slide_7.jpg'
    ];
    useEffect(() => {
        window.addEventListener('mousemove', () => { });
        config.getCompanyById(id)
            .then(res => {
                console.log(res);
                setData(res.data.data);
            })
        return () => {
            // componentWillUnmount events
        }
    }, []);


    return (
        <div className="vh-100 vw-100">
            <div className="row justify-content-center align-items-center m-1 pt-5" style={{ overflow: "auto" }}>
                <div className="container mb-5" >

                    <div className="col-md-12 col-sm-12 ">
                        <div className="container">
                        <Link to={'/company/slot'} className="btn btn-primary float-right">Available Slot</Link>
                        <h2 className=""><Link to={'/company'} className="text-dark pr-2"><BsFillArrowLeftSquareFill /></Link><Link to={'/'} className="text-dark pr-1"><FaHome /></Link>Company Name</h2>
                        
                        </div>
                        <div className="container  float-none bg-info">
                            <div className=" row align-items-center clearfix  " style={{ width: "300px", height: "400px" }}>
                                <div className="slide-container">
                                    <Zoom scale={0.4}>
                                        {
                                            images.map((each, index) => <img key={index} style={{ width: "100%" }} src={each} />)
                                        }
                                    </Zoom>
                                </div>
                            </div>

                        </div>
                        
                        <table className="table table-striped bg-white table-bordered p-1 mt-2 ">
                            
                            <tbody>
                                <tr>
                                    <td colSpan="2" className="text-center">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</td>


                                </tr>
                                <tr>
                                    <th>ID</th>
                                    <th>{data.cid}</th>


                                </tr>
                                <tr>
                                    <td>PW</td>
                                    <td>{data.cpass}</td>

                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>{data.email}</td>

                                </tr>
                                <tr>
                                    <td>Phone number</td>
                                    <td>{data.phone}</td>

                                </tr>
                                <tr>
                                    <td>Cab Name</td>
                                    <td>{data.name}</td>
                                </tr>
                                <tr>
                                    <td>Holidays</td>
                                    <td>{data.holidays}</td>

                                </tr>
                                <tr>
                                    <td>Page</td>
                                    <td>{data.hp}</td>

                                </tr>
                                <tr className="p-5">
                                    
                                    <td colSpan="2"><p>{data.email}</p></td>

                                </tr>


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    );

}

export default UserCompanyDetails;