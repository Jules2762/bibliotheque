 // axios-config.js
import axios from 'axios';

const api = axios.create({
  baseURL: 'http://localhost:8000' // Vous pouvez définir votre URL de base ici
});

export default api;
