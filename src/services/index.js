import axios from "axios";

const api = axios.create({
    baseURL: `${appLocalizer.apiUrl}/grm/v1/`
})

export default api