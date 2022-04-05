
import { useEffect, useState } from 'react';
import { Button, Modal } from 'react-bootstrap';
import { BsFillArrowLeftSquareFill } from 'react-icons/bs';
import { Link } from 'react-router-dom';
import Alert from 'react-bootstrap/Alert';
import config from '../config';

const Company= () =>{
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
                        消去 {props.data.name}
                    </Modal.Title>
                </Modal.Header>
                <Modal.Body>
                    <h4>この会社を削除してもよろしいですか？</h4>
                </Modal.Body>
                <Modal.Footer style={{
                    display: "flex",
                    justifyContent: "center",
                }}>
                    <Button className="px-4 mr-5" variant="light" onClick={props.onHide}>番号</Button>
                    <Button className="px-4" onClick={() => handleDelete(props.data.id)}>はい</Button>
                </Modal.Footer>
            </Modal>
        );
    }
    return (
        
        <div className="vh-100 vw-100" style={{backgroundColor: "rgb(231 226 190 / 38%)"}}>
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

                        <h2 className="float-left"><Link to={'/admin'} className="text-dark"><BsFillArrowLeftSquareFill /></Link>会社リスト</h2>
                   {/*  <a href="#" className="btn btn-primary float-right">Add Company</a> */}
                        <table className="table table-striped bg-white table-bordered ">
                        <thead>
                        <tr className="text-center">
                            <th>会社名</th>
                            <th>ID</th>
                            <th>パスワード</th>
                            <th>行動</th>
                        </tr>
                        </thead>
                        <tbody>
                                {data.map(item =>(
                            <tr key={item.id}>
                                <td>{item.name}</td>
                                <td>{item.cid}</td>
                                <td>{item.cpass}</td>
                                <td><Button variant="danger" onClick={()=>setDelete(true,item)}>
                                            消去
                                </Button></td>
                            </tr>
                        ))
                        }
                
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <DeleteModal
                show={show}
                onHide={handleClose}
                backdrop="static"
                keyboard={false}
                data = {current}

            />
                
        </div>
    );

}

export default Company;