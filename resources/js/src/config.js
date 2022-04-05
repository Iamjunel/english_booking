const axios = window.axios;
export const BASE_API_URL = 'http://localhost:8000/api';
export default {
    getAllCompany: () => axios.get(`${BASE_API_URL}/company`),
    deleteCompanyById: id =>
        axios.delete(`${BASE_API_URL}/company/${id}`),
    addCompany: payload => 
        axios.post(`${BASE_API_URL}/company`, payload),
    getCompanyById: id => 
        axios.get(`${BASE_API_URL}/company/details/${id}`),
    updateCompanyById: (id, payload) =>
        axios.patch(`${BASE_API_URL}/company/${id}`,payload),
};