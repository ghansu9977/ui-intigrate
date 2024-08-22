// web/react/main.tsx
import React from "react";
import ReactDOM from "react-dom/client"; // Use 'react-dom/client' for React 18
import App from "./App";
import { BrowserRouter } from "react-router-dom";
import StudentState from "./context/student/StudentState";

const rootElement = document.getElementById("root");
const root = ReactDOM.createRoot(rootElement!); // Create a root

root.render(
  <React.StrictMode>
     <BrowserRouter>
    <StudentState>
      <App />
    </StudentState>
    </BrowserRouter>
  </React.StrictMode>
);
