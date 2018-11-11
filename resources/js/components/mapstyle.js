import { fromJS } from 'immutable';
import MAP_STYLE from '../map-style/style.json';

// const MAP_STYLE = "mapbox://styles/jakemox99/cjo4t22t8012s2sp2xwb0e0j5";

// For more information on data-driven styles, see https://www.mapbox.com/help/gl-dds-ref/
export const dataLayer = fromJS({
  id: 'done-fills',
  source: 'states',
  type: 'fill',
  interactive: true,
  paint: {
          "fill-color": "#ffd294",
          "fill-opacity": ["case",
              ["boolean", ["feature-state", "click"], false],
              0,
              1
          ]
      }
});

export const defaultMapStyle = fromJS(MAP_STYLE);
