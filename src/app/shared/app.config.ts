const apiBaseUrl = 'http://covidtest.monbuz.net:8088/api';
export const routesName = {
  login: {s : '/login',p:'login'},
  logout: {s : '/logout',p:'logout'},
  signup: {s : '/signup',p:'signup'},
  home: {s : '/home',p:'home'},
  about: {s : '/about',p:'about'},
  started: {s : '/started',p:'started'},
};
export const apiEndPoint = {
  login: apiBaseUrl + '/login',
  logout: apiBaseUrl + '/logout',
  register: apiBaseUrl + '/register',
  user: apiBaseUrl + '/register/',
};
