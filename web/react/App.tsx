// web/react/App.tsx
import React from "react";
import { Route, Routes, Link } from "react-router-dom";
import Calculator from "./components/Calculator";
import Students from "./components/Students";
import Navbar from "./components/Navbar";

const App: React.FC = () => {
  return (
    <div className="d-flex flex-column h-100">
      <Navbar/>
      <div>
        <Routes>
          <Route path="/stu/calculator" element={<Calculator />} />
          <Route path="/stu/students" element={<Students />} />
          <Route path="/" element={<h1>Welcome to the App!</h1>} />
        </Routes>
      </div>
    </div>
  );
};

export default App;
