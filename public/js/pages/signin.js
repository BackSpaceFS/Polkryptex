import Cookies from "js-cookie";
import Request from "./../components/request.js";
import Toast from "./../components/toast.js";


Request.register("#signin", function (status, response) {
  if (response.status === "S01") {
    Cookies.set('user', response.content.token, { expires: 7, path: '/', secure: true, sameSite: 'Lax' });
    window.location.href = app.props.baseUrl + app.props.dashboard;
  } else {
    Toast.send(
      "Login failed",
      "The provided username or password is incorrect.",
      "alert"
    );
  }
});
