const API_KEY = 'your_api_key';
const BASE_URL = 'https://api.themoviedb.org/3';
const ENDPOINT = '/movie/popular';

async function fetchMovies() {
    try {
        const response = await fetch(`${BASE_URL}${ENDPOINT}?api_key=${API_KEY}`);
        const data = await response.json();
        console.log(data);
    } catch (error) {
        console.error('Error fetching data:', error);
    }
}

fetchMovies();