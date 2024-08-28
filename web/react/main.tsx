import React from "react";
import ReactDOM from "react-dom/client";
import App from "./App";
import { BrowserRouter } from "react-router-dom";
import StudentState from "./context/student/StudentState";

const rootElement = document.getElementById("root")!;
const root = ReactDOM.createRoot(rootElement);

root.render(
  <React.StrictMode>
    <BrowserRouter>
      <StudentState>
        <App />
      </StudentState>
    </BrowserRouter>
  </React.StrictMode>
);
