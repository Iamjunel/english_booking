import 'react-app-polyfill/ie11';
import 'core-js/es7/reflect';
import "regenerator-runtime/runtime";
import 'core-js/modules/es6.symbol';
import React from 'react';
import ReactDOM from 'react-dom';
import {
    BrowserRouter as Router,
    Switch,
    Route,
    Link
} from 'react-router-dom';
import Admin from './components/Admin';
import TaxiCare from './components/Taxi-Care';
import User from './components/User';
import Company from './components/Company';
import CompanyRegistration from './components/forms/CompanyRegistration';
import DeleteCompany from './components/modals/DeleteCompany';
import CompanyUpdate from './components/forms/CompanyUpdate';
import Booking from './components/Booking';
import BookingByDate from './components/BookingByDate';
import BookingUpdate from './components/forms/BookingUpdate';
import UserCompanyList from './components/UserCompanyList';
import UserCompanyDetails from './components/UserCompanyDetails';
import UserAvailableSlotDetail from './components/UserAvailableSlotDetail';
import UserAvailableSlotByDate from './components/UserAvailableSlotByDate';
import NotFound404 from './components/NotFound';
const App = () =>{
    return (
        <Router>
            <Switch>
                <Route exact path= "/">
                    <User/>
                </Route>
                <Route exact path="/slot">
                    <UserAvailableSlotDetail />
                </Route>
                <Route exact path="/slot/date">
                    <UserAvailableSlotByDate />
                </Route>
                <Route exact path="/company">
                    <UserCompanyList />
                </Route>
                <Route exact path="/company/details/:id">
                    <UserCompanyDetails />
                </Route>
                <Route exact path="/company/slot">
                    <UserAvailableSlotDetail />
                </Route>
                
                <Route exact path= "/admin">
                    <Admin/>
                </Route>
                <Route exact path= "/admin/company">
                    <Company/>
                </Route>
                <Route exact path= "/admin/company/register">
                    <CompanyRegistration/>
                </Route>
                <Route exact path= "/admin/company/deleteCompany">
                    <DeleteCompany/>
                </Route>

                <Route exact path= "/taxi-care">
                    <TaxiCare/>
                </Route>
                <Route exact path= "/taxi-care/company/edit">
                    <CompanyUpdate/>
                </Route>
                <Route exact path= "/taxi-care/booking">
                    <Booking/>
                </Route>
                <Route exact path= "/taxi-care/booking/date">
                    <BookingByDate/>
                </Route>
                <Route exact path="/taxi-care/booking/edit">
                    <BookingUpdate />
                </Route>
                <Route path="*">
                    <NotFound404/>
                </Route>
            </Switch>
        </Router>
    );

}

export default App;
ReactDOM.render(<App/>,document.getElementById('app'));