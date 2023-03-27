import axios from 'axios';

const axiosBase = axios.create({
  baseURL: 'http://localhost:85',
  timeout: 10000,
  headers: {
    'Content-Type': 'application/json',
  },
});

export default axiosBase
