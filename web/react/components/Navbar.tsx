import React from "react";
import { Link, useNavigate } from "react-router-dom";
interface User{
  id: number,
  user_name: string,
  user_email: string
}
const Navbar: React.FC = () => {
  const host = "http://localhost:8080"
  const userString = localStorage.getItem('user');
  const user: User | null = userString ? JSON.parse(userString) : null;
  const navigate = useNavigate();
  const handleLogout = ()=>{
    // clear localStorage
    localStorage.removeItem('user');
    localStorage.removeItem('token');

    // Redirect to Yii2
    // navigate('users/login');
  };
return (
    <div className="m-5">
      <nav className="navbar navbar-expand-lg navbar-dark bg-dark fixed-top px-5">
        <a className="navbar-brand ps-4 ms-5" href={`${host}/users/dashboard`}>
          School
        </a>
        <button
          className="navbar-toggler"
          type="button"
          data-toggle="collapse"
          data-target="/navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span className="navbar-toggler-icon"></span>
        </button>

        <div className="collapse navbar-collapse" id="navbarSupportedContent">
          <ul className="navbar-nav mr-auto">
            <li className="nav-item active">
              <a className="nav-link" href={`${host}/teachers/index`}>
                Teacher
              </a>
            </li>
            <li className="nav-item">
              <a className="nav-link" href={`${host}/stu/index`}>
                Student
              </a>
            </li>
            <li className="nav-item">
              <Link className="nav-link" to="/stu/students">
                React Students
              </Link>
            </li>
            <li className="nav-item">
              <Link className="nav-link" to="/stu/calculator">
              React Calculator
              </Link>
            </li>
            <li className="nav-item">
              <Link className="nav-link" to="/">
                About
              </Link>
            </li>
            </ul>
            <ul className="navbar-nav ms-auto">
            <li className="nav-item px-5 me-4">
              <a className="nav-link" onClick={handleLogout} href={`${host}/users/logout`}>
                Logout {user && `(${user.user_name})`}
              </a>
            </li>
          </ul>
        </div>
      </nav>
    </div>
  );
};

export default Navbar;
