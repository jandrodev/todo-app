import axios from 'axios';

export default function postRequest(endpoint, data, contentType = 'application/json') {
    const headers = {
        'Content-Type': contentType,
        'Accept': 'application/json'
    }

    return axios.post('/' + endpoint, data, {headers: headers})
}
