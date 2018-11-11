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

export const hoverLayer = fromJS({
  "id": "hover-fills",
    "type": "fill",
      "source": "states",
        "layout": { },
  "paint": {
    "fill-color": "#A80000",
      "fill-opacity": ["case",
        ["boolean", ["feature-state", "hover"], false],
        1,
        0
      ]
  }
})

export const borderLayer = fromJS({
  "id": "state-borders",
  "type": "line",
  "source": "states",
  "layout": {},
  "paint": {
    "line-color": "#fff3df",
    "line-width": 0.3,
    "line-opacity": ["case",
      ["boolean", ["feature-state", "click"], false],
      0,
      1
    ]
  }

})

export const defaultMapStyle = fromJS(MAP_STYLE);
