import './global'
import Country from './country'
import './search/search'
import './slider'
import './mapbox'   
import CityPage from './components/./city_page.jsx'

class App extends React.Component {
    render(city) {
        render(<CityPage />)
        // return <h1>Hello!</h1>;
        // return(<City cityName={city} />);
    };
}

render(<App />, document.getElementById('app-city'));

