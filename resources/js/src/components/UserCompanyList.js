
import { useEffect, useState } from 'react';
import { Button, Modal } from 'react-bootstrap';
import { BsFillArrowLeftSquareFill } from 'react-icons/bs';
import {
    Link
} from 'react-router-dom';
import Alert from 'react-bootstrap/Alert';
import config from '../config';

const UserCompanyList = () => {
    const [data, setData] = useState([]);

    const [show, setShow] = useState(false);
    const [showAlert, setShowAlert] = useState(false);

    const [message, setMessage] = useState("");
    const [current, setCurrent] = useState([]);
    const [isBusy, setBusy] = useState(false);
    const handleClose = () => setShow(false);
    const handleShow = () => setShow(true);
    useEffect(() => {
        setBusy(true);
        window.addEventListener('mousemove', () => { });
        config.getAllCompany()
            .then(res => {
                console.log(res);
                setData(res.data.data);
            })
        return () => {
            // componentWillUnmount events
        }
    }, []);






    function setDelete(is_delete, data) {
        setShow(is_delete);
        setCurrent(data);
        console.log(data);
    }

    async function handleDelete(id) {
        config.deleteCompanyById(id)
            .then(res => {
                console.log(res);
                setData(res.data.data);
                setShow(false);
                setShowAlert(true);
                setMessage("Company deleted successfully.");
                const timer = setTimeout(() => {
                    setShowAlert(false);
                }, 2000);
                return () => clearTimeout(timer);

            })
            .catch(error => console.log("error: ", error));

    }

    function DeleteModal(props) {
        return (
            <Modal
                {...props}
                size="sm"
                aria-labelledby="contained-modal-title-vcenter"
                centered
            >
                <Modal.Header closeButton>
                    <Modal.Title id="contained-modal-title-vcenter">
                        Delete {props.data.name} Company
                    </Modal.Title>
                </Modal.Header>
                <Modal.Body>
                    <h4>Are you sure you want to delete this company?</h4>
                </Modal.Body>
                <Modal.Footer style={{
                    display: "flex",
                    justifyContent: "center",
                }}>
                    <Button className="px-4 mr-5" variant="light" onClick={props.onHide}>No</Button>
                    <Button className="px-4" onClick={() => handleDelete(props.data.id)}>Yes</Button>
                </Modal.Footer>
            </Modal>
        );
    }
    return (

        <div className="vh-100 vw-100" style={{ backgroundColor: "rgb(231 226 190 / 38%)" }}>
            <div className="row justify-content-center align-items-center m-1 pt-5" style={{ overflow: "auto" }}>
                <div >
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

                        <h2 className="float-left"><Link to={'/'} className="text-dark"><BsFillArrowLeftSquareFill /></Link>Company List</h2>
                        <table className="table table-striped bg-white table-bordered ">
                            <thead>
                                <tr className="text-center">
                                    <th>Company Name</th>
                                    <th>ID</th>
                                    <th>Password</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                {data.map(item => (
                                    <tr key={item.id}>
                                        <td>{item.name}</td>
                                        <td>{item.cid}</td>
                                        <td>{item.cpass}</td>
                                        <td>
                                            <Link to={'/company/details/'+ item.id} className="btn btn-danger">Details</Link>
                                        </td>
                                     </tr>
                                    ))
                                }
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    );

}

export default UserCompanyList;