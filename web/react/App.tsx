// web/react/App.tsx
import React from "react";
import { BrowserRouter as Router, Route, Routes, Link } from "react-router-dom";
import Calculator from "./components/Calculator";
import Students from "./components/Students";

const App: React.FC = () => {
  return (
    <Router>
      <div>
        <nav>
          <ul>
            <li>
              <Link to="/calculator">Calculator</Link>
            </li>
            <li>
              <Link to="/students">Students</Link>
            </li>
          </ul>
        </nav>

        <Routes>
          <Route path="/calculator" element={<Calculator />} />
          <Route path="/students" element={<Students />} />
          <Route path="/" element={<h1>Welcome to the App!</h1>} />
        </Routes>
      </div>
    </Router>
  );
};

export default App;
